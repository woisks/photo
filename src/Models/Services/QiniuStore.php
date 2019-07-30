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

namespace Woisks\Photo\Models\Services;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

/**
 * Class QiniuStore.
 *
 * @package Woisks\Photo\Models\Services
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/7/30 20:45
 */
class QiniuStore
{

    /**
     * storage.  2019/7/30 20:45.
     *
     * @var  \Illuminate\Contracts\Filesystem\Filesystem|null
     */
    private $storage = null;
    /**
     * instance.  2019/7/30 20:45.
     *
     * @var static array
     */
    private static $instance = [];

    /**
     * disk. 2019/7/30 20:45.
     *
     * @param $name
     *
     * @return mixed
     */
    public static function disk($name)
    {
        if (!isset(self::$instance[$name])) {
            self::$instance[$name] = new self($name);
        }
        return self::$instance[$name];
    }

    /**
     * QiniuStore constructor. 2019/7/30 20:45.
     *
     * @param $name
     *
     * @return void
     */
    private function __construct($name)
    {
        $this->storage = \Storage::disk($name);
    }

    /**
     * 文件是否存在
     * @param $key
     * @return bool
     */
    public function exists($key)
    {
        return $this->storage->exists($key);
    }


    /**
     * get. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get($key)
    {
        return $this->storage->get($key);
    }


    /**
     * put. 2019/7/30 20:45.
     *
     * @param $path
     * @param $contents
     *
     * @return bool
     */
    public function put($path, $contents)
    {

        if ($contents instanceof File ||
            $contents instanceof UploadedFile) {

            return $this->storage->putFileAs($path, $contents, '', '');
        }


        return is_resource($contents)
            ? $this->storage->putStream($path, $contents, '')
            : $this->storage->put($path, $contents, '');
    }


    /**
     * prepend. 2019/7/30 20:45.
     *
     * @param $key
     * @param $contents
     *
     * @return bool
     */
    public function prepend($key, $contents)
    {
        return $this->storage->prepend($key, $contents);
    }

    /**
     * 附加内容到文件结尾
     * @param $key
     * @param $contents
     * @return int
     */
    public function append($key, $contents)
    {
        return $this->storage->append($key, $contents);
    }

    /**
     * 删除文件
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        return $this->storage->delete($key);
    }

    /**
     * 复制文件到新的路径
     * @param $key
     * @param $key2
     * @return bool
     */
    public function copy($key, $key2)
    {
        return $this->storage->copy($key, $key2);
    }

    /**
     * 移动文件到新的路径
     * @param $key
     * @param $key2
     * @return bool
     */
    public function move($key, $key2)
    {
        return $this->storage->move($key, $key2);
    }

    /**
     * size. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return int
     */
    public function size($key)
    {
        return $this->storage->size($key);
    }

    /**
     * lastModified. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return int
     */
    public function lastModified($key)
    {
        return $this->storage->lastModified($key);
    }

    /**
     * files. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return array
     */
    public function files($key)
    {
        return $this->storage->files($key);
    }

    /**
     * allFiles. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return array
     */
    public function allFiles($key)
    {
        return $this->storage->files($key);
    }

    /**
     * directories. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return array
     */
    public function directories($key)
    {
        return $this->storage->files($key);
    }

    /**
     * allDirectories. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return array
     */
    public function allDirectories($key)
    {
        return $this->storage->files($key);
    }

    /**
     * makeDirectory. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return bool
     */
    public function makeDirectory($key)
    {
        return $this->storage->makeDirectory($key);
    }

    /**
     * deleteDirectory. 2019/7/30 20:45.
     *
     * @param $key
     *
     * @return bool
     */
    public function deleteDirectory($key)
    {
        return $this->storage->deleteDirectory($key);
    }

    /**
     * 获取上传Token
     * @param $key
     * @param $expires
     * @param $policy
     * @param $strictPolicy
     * @return bool
     */
    public function uploadToken($key = null, $expires = 3600, $policy = null, $strictPolicy = true)
    {
        return $this->storage->getDriver()->uploadToken($key, $expires, $policy, $strictPolicy);
    }


    /**
     * withUploadToken. 2019/7/30 20:45.
     *
     * @param $token
     *
     * @return void
     */
    public function withUploadToken($token)
    {
        $this->storage->getDriver()->withUploadToken($token);
    }


    /**
     * downloadUrl. 2019/7/30 20:45.
     *
     * @param $key
     * @param string $domainType
     *
     * @return mixed
     */
    public function downloadUrl($key, $domainType = 'default')
    {
        return $this->storage->getDriver()->downloadUrl($key, $domainType);
    }

    /**
     * 获取私有bucket下载地址
     * @param $key
     * @return mixed
     */
    public function privateDownloadUrl($key, $domainType = 'default')
    {
        return $this->storage->getDriver()->privateDownloadUrl($key, $domainType);
    }

    /**
     * 获取多媒体文件信息
     * @param $key
     * @return mixed
     */
    public function avInfo($key)
    {
        return $this->storage->getDriver()->avInfo($key);
    }

    /**
     * 获取图片信息
     * @param $key
     * @return mixed
     */
    public function imageInfo($key)
    {
        return $this->storage->getDriver()->imageInfo($key);
    }

    /**
     * 获取图片EXIF信息
     * @param $key
     * @return mixed
     */
    public function imageExif($key)
    {
        return $this->storage->getDriver()->imageExif($key);
    }

    /**
     * 获取图片预览URL
     * @param $key
     * @param $opts
     * @return mixed
     */
    public function imagePreviewUrl($key, $opts)
    {
        return $this->storage->getDriver()->imagePreviewUrl($key, $opts);
    }

    /**
     * 获取私有bucket图片预览URL
     * @param $key
     * @param $opts
     * @return mixed
     */
    public function privateImagePreviewUrl($key, $opts)
    {
        return $this->storage->getDriver()->privateImagePreviewUrl($key, $opts);
    }

    /**
     * 执行持久化数据处理
     * @param $key
     * @param $opts
     * @param $pipline
     * @param $force
     * @param $notify_url
     * @return mixed
     */
    public function persistentFop($key, $opts, $pipline = null, $force = false, $notify_url = null)
    {
        return $this->storage->getDriver()->persistentFop($key, $opts, $pipline, $force, $notify_url);
    }

    /**
     * 查看持久化数据处理的状态
     * @param $id
     * @return mixed
     */
    public function persistentStatus($id)
    {
        return $this->storage->getDriver()->persistentStatus($id);
    }


    /**
     * verifyCallback. 2019/7/30 20:45.
     *
     * @param $contentType
     * @param $originAuthorization
     * @param $url
     * @param $body
     *
     * @return mixed
     */
    public function verifyCallback($contentType, $originAuthorization, $url, $body)
    {
        return $this->storage->getDriver()->verifyCallback($contentType, $originAuthorization, $url, $body);
    }

    /**
     * 调用fetch将 foo.jpg 数据以 bar.jpg 的名字储存起来。
     * @param $url
     * @param $key
     * @return bool
     */
    public function fetch($url, $key)
    {
        return $this->storage->getDriver()->fetch($url, $key);
    }

    /**
     * 得到最后一次执行 put, copy, append 等写入操作后，得到的hash值。详见 https://github.com/qiniu/qetag
     * @return string
     */
    public function qetag()
    {
        return $this->storage->getDriver()->qetag();
    }

    /**
     * 得到最后一次执行 put, copy, append 等写入操作后，得到的返回值。
     * @return array
     */
    public function lastReturn()
    {
        return $this->storage->getDriver()->getLastReturn();
    }

}
