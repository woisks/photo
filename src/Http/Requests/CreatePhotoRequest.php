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

namespace Woisks\Photo\Http\Requests;


class CreatePhotoRequest extends Requests
{
    public function rules()
    {
        return [
            'upload' => 'required|image',
            'type'   => 'required|string|max:20',
            'title'  => 'sometimes|required|string|max:18',
            'readme' => 'sometimes|required|string|max:118'
        ];
    }

}