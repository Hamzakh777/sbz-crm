@extends('voyager::master')

@section('page_title', __('reports.reports'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-bar-chart"></i> {{ __('reports.analytics_overview') }}
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid" id='app'>
        <the-reports></the-reports>
    </div>
@stop

@section('javascript')
    <script src="{{ mix('js/pages/reports.js') }}"></script>
@stop