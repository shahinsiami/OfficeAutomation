<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>window.Laravel = {csrfToken: '{{csrf_token()}}'}</script>
    <link rel="stylesheet" type="text/css" href="css/view/siteview.css">
    <link rel="stylesheet" type="text/css" href="font/files/font.css">
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="theme-color" content="#01BF81"/>
    <title>Iran8k</title>

</head>
<body>
<div class="loadPage" id="siteview" style="height:100vh;overflow-x:hidden">
    <enheader></enheader>
    <router-multi-view view-name="home"/>
    <enfooter></enfooter>
</div>
</body>

<script src="js/view/weben.js"></script>
<style>
    .loadPage{
        display:none;
    }
</style>
<script>
window.addEventListener('load', (event) => {
  document.querySelector('.loadPage').classList.remove('loadPage')
});
</script>
</html>
