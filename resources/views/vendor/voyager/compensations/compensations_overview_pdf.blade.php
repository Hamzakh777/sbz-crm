@extends('layouts.pdf')

@section('content')
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .heading {
            color: red;
        }
    </style>
    <h1 class="heading">{{ __('voyager::compensations.sales_compensation_for') }}</h1>
    <table>
        <thead>
            <td>
                test 1
            </td>
            <td>
                test 3
            </td>
        </thead>
    </table>
@endsection
