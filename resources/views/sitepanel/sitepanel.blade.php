<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>window.Laravel = {csrfToken: '{{csrf_token()}}'}</script>
    {{--css--}}
    <link rel="stylesheet" type="text/css" href="css/sitepanel/panel.css">
    <link rel="stylesheet" type="text/css" href="font/files/font.css">
    {{--css--}}
    <title>Vira</title>
</head>
<body>
<div id="panel">
        <router-multi-view view-name="adminpanel"/>
        <router-multi-view view-name="login"/>
</div>
</body>
<script src="js/sitepanel/sitepanel.js"></script>
</html>
