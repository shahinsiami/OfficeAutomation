<?php
Route::get('/', function () {
    return view('siteview.en');
});
Route::get('/en', function () {
    return view('siteview.en');
});
Route::get('/sitepanel', function () {
    return view('panel.panel');
});
Route::get('/panel', function () {
    return view('panel.panel');
});
Route::get('/automation', function () {
    return view('automation.automation');
});

Route::get('/payment/{id}/{product}/{price}', 'Payment\ZarinPal@pay');
Route::get('/payAck/{id}/{product}/{price}', 'Payment\ZarinPal@payAck');
