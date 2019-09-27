@extends('layouts.pdf')

@section('content')
    <style>
        /* -------- Global -------- */
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .heading {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            font-size: 10px;
            font-weight: 400;
            margin-bottom: 60px;
        }

        .table tr {
            border-top: 1px solid #ddd;
        }
        .table>thead>tr>th {
            background-color: #f8fafc;
            padding: 12px 20px;
            color: #4e73df;
        }

        .table>tbody>tr>td {
            padding: 6px 20px;
        }

        /* agents table */
    </style>

    {{-- sales agents info --}}
    <h1 class="heading">{{ __('voyager::compensations.sales_compensation_for') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>
                    {{ __('voyager::compensations.sales_compensation_creator') }}
                </th>
                <th>
                    {{ __('voyager::compensations.sales_compensation_receiver') }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> test</td>
                <td> @if(isset($salesAgent)) {{$salesAgent->first_name . ' ' . $salesAgent->last_name}} @endif </td>
            </tr>
            <tr>
                <td></td>
                <td><b>{{ __('voyager::generic.bank_IBAN') }}</b>@if(isset($salesAgent)) {{$salesAgent->bank_IBAN}} @endif</td>
            </tr>
        </tbody>
    </table>

    {{-- sales compensations details --}}
    <h1 class="heading">{{ __('voyager::compensations.sales_compensation_details') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th> {{ __('voyager::sales_orders.sales_order_id') }} </th>
                <th> {{ __('voyager::sales_orders.contract_person') }} </th>
                <th> {{ __('voyager::insurance.insurance') }} </th>
                <th> {{ __('voyager::sales_orders.contract_duration_VVG') }} </th>
                <th> {{ __('voyager::sales_orders.contract_duration_KVG') }} </th>
                <th> {{ __('voyager::sales_orders.sold_date') }} </th>
                <th> {{ __('voyager::compensations.compensation_rate') }} </th>
                <th> {{ __('voyager::compensations.compensation_payout_value') }} </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesOrders as $salesOrder)
                <tr>
                    <td> {{ $salesOrder->id }} </td>
                    <td>{{ $salesOrder->owner_full_name }}</td>
                    <td>{{ $salesOrder->id }}</td>
                    <td>{{ $salesOrder->contract_duration_VVG }}</td>
                    <td>{{ $salesOrder->contract_duration_KVG }}</td>
                    <td>{{ $salesOrder->contract_sign_date->format('m/d/Y') }}</td>
                    <td>{{ $salesOrder->compensation->sales_compensations_payout_rate }}%</td>
                    <td>{{ ($salesOrder->compensation->sales_compensations_total * $salesOrder->compensation->sales_compensations_payout_rate) / 100 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
