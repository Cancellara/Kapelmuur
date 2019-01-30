@extends('layouts.app')

@section('content')
    <h1>{{ __('shop/typeSelection.header') }}</h1>

        @foreach ($errors->all() as $error)

            <strong>{{ $error }} </strong>

        @endforeach
    @if ($errors->has('shopType'))
        <strong>{{ $error }} </strong>
    @endif


        <table>
            <th>{{ __('shop/typeSelection.typeName') }}</th>
            <th>{{ __('shop/typeSelection.initialFee') }}</th>
            <th>{{ __('shop/typeSelection.monthlyFee') }}</th>
            <th>{{ __('shop/typeSelection.maxActiveArt') }}</th>
            <th>{{ __('shop/typeSelection.salesPercentage') }}</th>
            <th>{{ __('shop/typeSelection.choose') }}</th>
            @foreach ($shopTypes as $shopType)
                <tr>
                    <td>{{ $shopType->description }}</td>
                    <td>{{ $shopType->initial_fee }}</td>
                    <td>{{ $shopType->montly_fee }}</td>
                    <td>{{ $shopType->max_active_articles }}</td>
                    <td>
                        @if ( $shopType->initial_fee <= 0)
                            <form method="POST" id="payment-form" action="{{ route('shop.selection.free') }}">
                                {{ csrf_field() }}
                                <input type="text" name = "shopType" style="visibility:hidden" value="{{ $shopType->id }}">
                                <button type="submit" class="btn btn-primary">{{ __('shop/typeSelection.choose') }}</button>
                            </form>
                        @else
                            <form method="POST" id="payment-form" action="{{ route('shop.selection.paying') }}">
                                {{ csrf_field() }}
                                <input type="text" name = "shopType" style="visibility:hidden" value="{{ $shopType->id }}">
                                <button type="submit" class="btn btn-primary">{{ __('shop/typeSelection.choose') }}</button>
                            </form>
                        @endif
                    </td>
                    <td>Click! pending</td>
                </tr>
            @endforeach
        </table>
@endsection