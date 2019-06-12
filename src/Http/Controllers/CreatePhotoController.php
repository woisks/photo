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

namespace Woisks\Photo\Http\Controllers;


use Image;
use Woisks\Jwt\Services\JwtService;
use Woisks\Photo\Http\Requests\CreatePhotoRequest;
use Woisks\Photo\Models\Services\PhotoService;


/**
 * Class CreatePhotoController.
 *
 * @package Woisks\Photo\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 16:37
 */
class CreatePhotoController extends BaseController
{
    /**
     * photoService.  2019/6/12 16:37.
     *
     * @var  \Woisks\Photo\Models\Services\PhotoService
     */
    private $photoService;

    /**
     * CreatePhotoController constructor. 2019/6/12 16:37.
     *
     * @param \Woisks\Photo\Models\Services\PhotoService $photoService
     *
     * @return void
     */
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }


    /**
     * create. 2019/6/12 16:37.
     *
     * @param \Woisks\Photo\Http\Requests\CreatePhotoRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreatePhotoRequest $request)
    {
        $file = $request->file('upload');

        if ($file->getSize() / 1024 >= config('woisk.photo.size') * 1024) {
            return res(422, 'upload photo oversize, max 4M ');
        }

        $id = create_numeric_id();
        $image = Image::make($file)->encode($file->extension(), 75)->save($id . '.' . $file->extension());

        $type = $request->input('type');

        $this->photoService->create($id, $type, JwtService::jwt_account_uid(), $request->input('title', ''), $request->input('readme', ''));
        $this->photoService->typeCount($type);

        \Storage::disk($type)->put($type . '/_' . $id, $image);

        unlink($image->basePath());

        return res(200, 'success', [
            'uploaded' => true,
            'url'      => config('filesystems.disks.' . $type . '.access_url') . '/' . $type . '/_' . $id
        ]);
    }


}