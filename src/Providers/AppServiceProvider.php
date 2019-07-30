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

namespace Woisks\Photo\Providers;


use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Overtrue\Flysystem\Qiniu\Plugins\FetchFile;
use Overtrue\Flysystem\Qiniu\Plugins\FileUrl;
use Overtrue\Flysystem\Qiniu\Plugins\PrivateDownloadUrl;
use Overtrue\Flysystem\Qiniu\Plugins\RefreshFile;
use Overtrue\Flysystem\Qiniu\Plugins\UploadToken;
use Overtrue\Flysystem\Qiniu\QiniuAdapter;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {

        app('filesystem')->extend('qiniu', function ($app, $config) {
            $adapter = new QiniuAdapter(
                $config['access_key'], $config['secret_key'],
                $config['bucket'], $config['domain']
            );

            $flysystem = new Filesystem($adapter);

            $flysystem->addPlugin(new FetchFile());
            $flysystem->addPlugin(new UploadToken());
            $flysystem->addPlugin(new FileUrl());
            $flysystem->addPlugin(new PrivateDownloadUrl());
            $flysystem->addPlugin(new RefreshFile());


            return $flysystem;
        });


        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }

}
