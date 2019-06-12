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


use Woisks\Photo\Models\Entity\PhotoEntity;

/**
 * Class PhotoHelpers.
 *
 * @package Woisks\Photo\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 17:18
 */
class PhotoHelpers
{
    /**
     * exists. 2019/6/12 17:18.
     *
     * @param int $id
     *
     * @return mixed
     */
    public static function exists(int $id)
    {
        return PhotoEntity::where('id', $id)->exists();
    }

    /**
     * transUrl. 2019/6/12 17:18.
     *
     * @param $type
     * @param $id
     *
     * @return array|string
     */
    public static function transUrl($type, $id)
    {
        if (is_array($id)) {

            $url = [];
            foreach ($id as $value) {
                $url[] = config('filesystems.disks.' . $type . '.access_url') . '/' . $type . '/_' . $value;
            }

            return $url;
        }

        return config('filesystems.disks.' . $type . '.access_url') . '/' . $type . '/_' . $id;
    }
}