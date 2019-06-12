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


use Woisks\Photo\Models\Entity\CountEntity;
use Woisks\Photo\Models\Entity\PhotoEntity;

/**
 * Class PhotoService.
 *
 * @package Woisks\Photo\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 16:52
 */
class PhotoService
{

    /**
     * create. 2019/6/12 16:52.
     *
     * @param $id
     * @param $type
     * @param $uid
     * @param $title
     * @param $readme
     *
     * @return mixed
     */
    public function create($id, $type, $uid, $title, $readme)
    {
        return PhotoEntity::create([
            'id'          => $id,
            'account_uid' => $uid,
            'type'        => $type,
            'title'       => $title,
            'readme'      => $readme,
        ]);
    }


    /**
     * typeCount. 2019/6/12 16:52.
     *
     * @param $type
     *
     * @return mixed
     */
    public function typeCount($type)
    {
        $count = CountEntity::firstOrCreate(['name' => $type], ['id' => create_numeric_id()]);
        $count->count++;
        $count->save();

        return $count;
    }

}