<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script>window.Laravel = {csrfToken: '<?php echo e(csrf_token()); ?>'}</script>
    <link rel="stylesheet" type="text/css" href="css/view/siteview.css">
    <link rel="stylesheet" type="text/css" href="font/files/font.css">
    <link rel="shortcut icon" href="img/behdashtkarfavicon.ico">
    <meta name="theme-color" content="#01BF81"/>
    <title>galaxy</title>
</head>
<body>
<div id="siteview" style="height:100vh;overflow-x:hidden">
    <faheader></faheader>
    <router-multi-view view-name="home"/>
    <fafooter></fafooter>
</div>
</body>

<script src="js/view/webfa.js"></script>

</html>
<?php /**PATH E:\Vira\Galaxy\resources\views/siteview/fa.blade.php ENDPATH**/ ?>