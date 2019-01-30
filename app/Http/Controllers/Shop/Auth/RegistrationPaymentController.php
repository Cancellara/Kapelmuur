<?php

namespace App\Http\Controllers\Shop\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopTypeSelectionRequest;
use App\Model\Shop\ShopType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class RegistrationPaymentController extends Controller
{
    public function __construct()
    {

        //Inicializamos paypal tomando los datos de .env
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    /**
     * Realiza el pago de la tarifa inicial con Paypal
     *
     * @param ShopTypeSelectionRequest
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function initialFeePayment(ShopTypeSelectionRequest $request)
    {
        //Validamos la petición
        $request->validated();
        //obtenemos los datos del tipo de tienda
        $shopType = ShopType::find($request['shopType']);

        //Proceso PayPal: ToDo: Refactorizar en un treat
        //PCreamos un pagador.
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        //Creamos un item con los datos de la tarifa
        $item_1 = new Item();
        $item_1->setName($shopType->description)
        ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($shopType->initial_fee);
        //Lista de items
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        //precio total
        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($shopType->initial_fee);
        //Creamos la transacción
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        //Redirecciones
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
        ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return view('/paypal/donePaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return view('/paypal/donePaypal');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return view('/paypal/donePaypal');
    }
    /**
     * Comprueba el estado de la transacción de paypal
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return view('/paypal/donePaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            return view('/paypal/donePaypal');
        }
        \Session::put('error', 'Payment failed');
        return view('/paypal/donePaypal');
    }
}
