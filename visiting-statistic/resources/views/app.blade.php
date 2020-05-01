<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Visiting Statistic') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="container">
        <visiting-statistic
                total-all-visits="{{ $totalVisitingStatistic->getTotalVisitsNumber() }}"
                total-unique-visits="{{ $totalVisitingStatistic->getTotalUniqueVisitsNumber() }}"
                total-undefined-ip="{{ $totalVisitingStatistic->getUndefinedIpsNumber() }}"
                today-all-visits="{{ $todayVisitingStatistic->getTotalVisitsNumber() }}"
                today-unique-visits="{{ $todayVisitingStatistic->getTotalUniqueVisitsNumber() }}"
                today-undefined-ip="{{ $todayVisitingStatistic->getUndefinedIpsNumber() }}"
        >
        </visiting-statistic>
    </div>
</body>
<!-- Scripts -->
<script src="{{ url('js/app.js') }}" defer></script>
</html>
