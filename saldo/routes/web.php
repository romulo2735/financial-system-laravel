<?php


$this->group(['middleware' => 'auth' , 'namespace' => 'Admin', 'prefix' => 'admin'] ,  function(){
    $this->get('/' , 'AdminController@index')->name('admin.home');
    $this->get('balance' , 'BalanceController@index')->name('admin.balance');

    $this->get('deposit' , 'BalanceController@deposit')->name('balance.deposit');
    $this->post('deposit' , 'BalanceController@depositStore')->name('deposit.store');

    $this->get('saque' , 'BalanceController@saque')->name('balance.saque');
    $this->post('saque' , 'BalanceController@saqueStore')->name('saque.store');

    $this->get('transfer' , 'BalanceController@transfer')->name('balance.transfer');
    $this->post('transfer' , 'BalanceController@transferStore')->name('transfer.store');
});


Route::get('/', 'SiteController@index')->name('home');

Auth::routes();

