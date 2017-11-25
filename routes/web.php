<?php

Route::get('/', 'StockPortfolioController@index');

Route::get('stocks/lookup', 'StocksController@lookup');

Route::post('stocks-portfolio', 'StockPortfolioController@store');

Route::get('stocks-portfolio/amounts/edit', 'StockPortfolio\AmountsController@edit');
Route::put('stocks-portfolio/amounts', 'StockPortfolio\AmountsController@update');

Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
