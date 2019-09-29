<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="voyager">


<div class="app-container">
    <div class="row content-container">
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('content')
            </div>
        </div>
    </div>
</div>

</body>
</html>
