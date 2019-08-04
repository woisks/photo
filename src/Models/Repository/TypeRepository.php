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


use Woisks\Photo\Models\Entity\TypeEntity;

/**
 * Class TypeRepository.
 *
 * @package Woisks\Photo\Models\Repository
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/7/28 22:35
 */
class TypeRepository
{
    /**
     * model.  2019/7/28 22:35.
     *
     * @var static TypeEntity
     */
    private static $model;

    /**
     * TypeRepository constructor. 2019/7/28 22:35.
     *
     * @param TypeEntity $photo
     *
     * @return void
     */
    public function __construct(TypeEntity $photo)
    {
        self::$model = $photo;
    }

    /**
     * first. 2019/8/3 23:50.
     *
     * @param $type
     *
     * @return mixed
     */
    public function first($type)
    {
        return self::$model->where('type', $type)->first();
    }
}
