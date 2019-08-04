<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */


Route::prefix('photo')
    ->namespace('Woisks\Photo\Http\Controllers')
    ->group(function () {

        Route::get('/{account_uid}', 'GetController@get')->where(['account_uid' => '[0-9]+']);

        Route::middleware(['token', 'throttle:20,1'])->group(function () {
            
            Route::post('/', 'CreateController@create');
        });


    });
