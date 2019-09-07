<?php

Route::group([
      'prefix' => '/',
      'namespace' => 'Avl\AdminLogger\Http\Controllers\Admin',
      'middleware' => config('adminlogger.middleware'),
      'as' => 'adminlogger::'
], function () {

  Route::get('logger', 'LoggerController@index')->name('index');
  Route::get('logger/{id}', 'LoggerController@show')->name('show');

});
