@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-11">
            <h1>{{ __('shop/typeSelection.header') }}</h1>
        </div>

        @foreach ($errors->all() as $error)

            <strong>{{ $error }} </strong>

        @endforeach
        @if ($errors->has('shopType'))
            <strong>{{ $error }} </strong>
        @endif

        <div class="col-10">
            <table class="table">
                <thead>
                    <th scope="col" class="bg-light">{{ __('shop/typeSelection.typeName') }}</th>
                    <th scope="col" class="bg-light">{{ __('shop/typeSelection.initialFee') }}</th>
                    <th scope="col" class="bg-light">{{ __('shop/typeSelection.monthlyFee') }}</th>
                    <th scope="col" class="bg-light">{{ __('shop/typeSelection.maxActiveArt') }}</th>
                    <th scope="col" class="bg-light">{{ __('shop/typeSelection.salesPercentage') }}</th>
                    <th scope="col" class="bg-light">{{ __('shop/typeSelection.choose') }}</th>
                </thead>
                <tbody>
                    @foreach ($shopTypes as $shopType)
                        <tr>
                            <td class="bg-warning">{{ $shopType->description }}</td>
                            <td class="bg-warning">{{ $shopType->initial_fee }}</td>
                            <td class="bg-warning">{{ $shopType->montly_fee }}</td>
                            <td class="bg-warning">{{ $shopType->max_active_articles }}</td>
                            <td class="bg-warning">Click! pending</td>
                            <td class="bg-warning">
                                @if ( $shopType->initial_fee <= 0)
                                    <form method="POST" id="payment-form" action="{{ route('shop.selection.free') }}">
                                        {{ csrf_field() }}
                                        <input type="text" name = "shopType" style="visibility:hidden" value="{{ $shopType->id }}">
                                        <button type="submit" class="btn btn-light">{{ __('shop/typeSelection.choose') }}</button>
                                    </form>
                                @else
                                    <form  class="form-text" method="POST" id="payment-form" action="{{ route('shop.selection.paying') }}">
                                        {{ csrf_field() }}
                                        <input type="text" name = "shopType" style="visibility:hidden" value="{{ $shopType->id }}">
                                        <button type="submit" class="btn btn-light">{{ __('shop/typeSelection.choose') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection