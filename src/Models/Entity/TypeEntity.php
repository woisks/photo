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

namespace Woisks\Photo\Models\Entity;


/**
 * Class TypeEntity.
 *
 * @package Woisks\Photo\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 23:42
 */
class TypeEntity extends Models
{
    /**
     * table.  2019/6/10 23:42.
     *
     * @var  string
     */
    protected $table = 'photo_type_count';
    /**
     * fillable.  2019/6/10 23:42.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'type',
        'name',
        'readme',
        'count',
    ];

    public $timestamps = false;
}
