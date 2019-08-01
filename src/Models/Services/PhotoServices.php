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


use Woisks\Jwt\Services\JwtService;
use Woisks\Photo\Models\Entity\PhotoEntity;

/**
 * Class PhotoServices.
 *
 * @package Woisks\Photo\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 17:18
 */
class PhotoServices
{


    /**
     * exists. 2019/7/30 23:14.
     *
     * @param $id
     *
     * @return bool
     */
    public static function exists($id)
    {
        $db = PhotoEntity::where('id', $id)->first();
        if ($db) {
            return $db->account_uid == JwtService::jwt_account_uid() ? true : false;
        }
        return false;
    }


    /**
     * transUrl. 2019/7/30 23:14.
     *
     * @param  $id
     *
     * @return mixed|string
     */
    public static function transUrl($id)
    {
        $suffix = (int)substr((string)$id, -1, 1);

        if (in_array($suffix, [1, 3, 5, 7, 9])) {
            return config('filesystems.disks.qiniu.access_url') . '/' . $id;
        } else {
            return env('PHOTO_NOT_EXISTS_URL');
        }
    }
}
