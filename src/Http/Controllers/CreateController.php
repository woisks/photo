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


use Illuminate\Http\JsonResponse;
use Woisks\Count\Models\Services\CountServices;
use Woisks\Jwt\Services\JwtService;
use Woisks\Photo\Http\Requests\CreateRequest;
use Woisks\Photo\Models\Repository\PhotoRepository;
use Woisks\Photo\Models\Repository\TypeRepository;
use Woisks\Photo\Models\Services\QiniuStore;


/**
 * Class CreateController.
 *
 * @package Woisks\Photo\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 16:37
 */
class CreateController extends BaseController
{

    /**
     * photoRepo.  2019/7/30 22:03.
     *
     * @var  PhotoRepository
     */
    private $photoRepo;
    /**
     * typeRepo.  2019/7/30 22:03.
     *
     * @var  TypeRepository
     */
    private $typeRepo;


    /**
     * CreateController constructor. 2019/7/30 22:03.
     *
     * @param PhotoRepository $photoRepo
     * @param TypeRepository $typeRepo
     *
     * @return void
     */
    public function __construct(PhotoRepository $photoRepo, TypeRepository $typeRepo)
    {
        $this->photoRepo = $photoRepo;
        $this->typeRepo  = $typeRepo;
    }


    /**
     * create. 2019/8/1 18:39.
     *
     * @param CreateRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function create(CreateRequest $request)
    {
        $file     = $request->file('upload');
        $type     = $request->input('type');
        $title    = $request->input('title', '');
        $descript = $request->input('descript', '');

        if ($suffix = $file->extension() == 'svg') {
            return res(422, 'image not supported svg  ');
        }

        if (!$type_db = $this->typeRepo->first($type)) {
            return res(404, 'type not exists ');
        }

        if ($this->qiniu($id = create_photo_id() . create_photo_type(), $file, $suffix)) {
            $account_uid = JwtService::jwt_account_uid();
            try {
                \DB::beginTransaction();

                $type_db->increment('count');

                CountServices::increment('user', 'photo', $account_uid);
                $this->photoRepo->created($account_uid, $id, $type, $title, $descript);

            } catch (\Throwable $e) {

                \DB::rollBack();
                return res(500, 'Come back later');
            }

            \DB::commit();
            return res(200, 'success', [
                'uploaded' => true,
                'id'       => $id,
                'url'      => config('filesystems.disks.qiniu.access_url') . '/' . $id
            ]);

        }
        return res(500, 'Come back later');
    }

    /**
     * qiniu. 2019/7/30 22:03.
     *
     * @param $id
     * @param $file
     * @param $suffix
     *
     * @return bool
     */
    public function qiniu($id, $file, $suffix)
    {
        if ($suffix == 'gif' || $suffix == 'bmp') {

            return QiniuStore::disk('qiniu')->put($id, $file) ? true : false;
        }

        return QiniuStore::disk('qiniu')->put($id, \Image::make($file)->encode($file->extension(), 70)) ? true : false;

    }


}
