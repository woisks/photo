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
 * Class PhotoEntity.
 *
 * @package Woisks\Photo\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 23:41
 */
class PhotoEntity extends Models
{
    /**
     * table.  2019/6/10 23:41.
     *
     * @var  string
     */
    protected $table = 'Photo';
    /**
     * fillable.  2019/6/10 23:41.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'type',
        'title',
        'readme',
        'created_at',
        'updated_at',
        'status'
    ];
}