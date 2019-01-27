@extends('layouts.app')

@section('content')
    <h1>{{ __('shop/typeSelection.header') }}</h1>
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
                <td>Pending!!</td>
                <td>Click! pending</td>
            </tr>
        @endforeach
    </table>
@endsection