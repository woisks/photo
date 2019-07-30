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

namespace Woisks\Photo\Models\Repository;


use Woisks\Photo\Models\Entity\PhotoEntity;

/**
 * Class PhotoRepository.
 *
 * @package Woisks\Photo\Models\Repository
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/7/28 22:35
 */
class PhotoRepository
{
    /**
     * model.  2019/7/28 22:35.
     *
     * @var static PhotoEntity
     */
    private static $model;

    /**
     * PhotoRepository constructor. 2019/7/28 22:35.
     *
     * @param PhotoEntity $photo
     *
     * @return void
     */
    public function __construct(PhotoEntity $photo)
    {
        self::$model = $photo;
    }

    /**
     * created. 2019/7/30 22:16.
     *
     * @param $account_uid
     * @param $id
     * @param $type
     * @param $title
     * @param $descript
     *
     * @return mixed
     */
    public function created($account_uid, $id, $type, $title, $descript)
    {
        return self::$model->create([
            'id'          => $id,
            'account_uid' => $account_uid,
            'type'        => $type,
            'title'       => $title,
            'descript'    => $descript
        ]);

    }


}
