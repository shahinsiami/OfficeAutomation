<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script>window.Laravel = {csrfToken: '<?php echo e(csrf_token()); ?>'}</script>
    
    <link rel="stylesheet" type="text/css" href="css/panel/panel.css">
    <link rel="stylesheet" type="text/css" href="font/files/font.css">
    
    <title>Vira</title>
</head>
<body>
<div id="panel">
        <router-multi-view view-name="adminpanel"/>
        <router-multi-view view-name="login"/>
</div>
</body>
<script src="js/automation/automation.js"></script>
<script >
</script>
</html>
<?php /**PATH C:\Users\shahin\Desktop\Vira\Automation\resources\views/automation/automation.blade.php ENDPATH**/ ?>