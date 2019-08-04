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
 * Class UserEntity.
 *
 * @package Woisks\Photo\Models\Entity
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 9:44
 */
class UserEntity extends Models
{
    /**
     * table.  2019/8/4 9:44.
     *
     * @var  string
     */
    protected $table = 'photo_user_count';

    /**
     * fillable.  2019/8/4 9:44.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'type',
        'count'
    ];

    /**
     * timestamps.  2019/8/4 9:44.
     *
     * @var  bool
     */
    public $timestamps = false;
}
