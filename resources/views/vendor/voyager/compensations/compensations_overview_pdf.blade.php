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
            border-collapse: collapse;
        }

        .table>thead>tr>th {
            background-color: #f8fafc;
            padding: 12px 20px;
            color: #4e73df;
        }

        .table>tbody>tr>td {
            padding: 3px 20px 6px 20px;
        }

        .table.table-bordered>tbody>tr>td {
            border-top: 1px solid #eaeaea;
        }

        /* agents table */
    </style>

    {{-- sales agents info --}}
    <h1 class="heading">{{ __('voyager::compensations.sales_compensation_for') . ' ' . $periodPlanMonth . '/' . $periodPlanYear}}</h1>
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
            {{-- street and number = bank iban --}}
            <tr>
                <td>{{ $companyName !== 'null'? $companyName : '' }}</td>
                <td>{{ __('voyager::generic.bank_IBAN') }}: @if(isset($salesAgent)) {{$salesAgent->bank_IBAN}} @endif</td>
            </tr>

            {{-- zip code city - compensation period from --}}
            <tr>
                <td>{{ $zipcode !== 'null' ? $zipcode : '' }} {{ $city !== 'null' ? $city : '' }}</td>
                <td></td>
            </tr>

            {{-- country - compensation period from--}}
            <tr>
                <td>{{ $country !== 'null' ? $country : '' }}</td>
                <td>compensation period from</td>
            </tr>

            {{-- compensation period to --}}
            <tr>
                <td></td>
                <td>compensation period to</td>
            </tr>

            {{-- created user - compensation total volume --}}
            <tr>
                <td>{{ $creator->first_name . ' ' . $creator->last_name }}</td>
                <td>
                    @php
                        $compensationTotalVolume = 0;
                        foreach($salesOrders as $key => $salesOrder) {
                            $compensationTotalVolume += ($salesOrder->compensation->sales_compensations_total * $salesOrder->compensation->sales_compensations_payout_rate) / 100;
                        }
                    @endphp
                    {{ $compensationTotalVolume }}
                </td>
            </tr>

            {{-- created at - compensation payout date --}}
            <tr>
                <td>{{ now()->format('m/d/Y') }}</td>
                <td>{{ $payoutDate }}</td>
            </tr>
        </tbody>
    </table>

    {{-- sales compensations details --}}
    <h1 class="heading">{{ __('voyager::compensations.sales_compensation_details') }}</h1>
    <table class="table table-bordered">
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
                    <td>{{ $salesOrder->new_insurance_name }}</td>
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
