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
use Woisks\Photo\Models\Repository\UserRepository;

/**
 * Class GetController.
 *
 * @package Woisks\Photo\Http\Controllers
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 10:07
 */
class GetController extends BaseController
{
    /**
     * userRepo.  2019/8/4 10:07.
     *
     * @var  UserRepository
     */
    private $userRepo;

    /**
     * GetController constructor. 2019/8/4 10:07.
     *
     * @param UserRepository $userRepo
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * get. 2019/8/4 10:07.
     *
     * @param $account_uid
     *
     * @return JsonResponse
     */
    public function get($account_uid)
    {
        if (strlen($account_uid) != 18 && strlen($account_uid) != 19) {
            return res(422, 'param  account id error ');
        }

        $db = $this->userRepo->get($account_uid);
        if ($db->isEmpty()) {
            return res(404, 'data not exists ');
        }
        return res(200, 'success', $db);

    }


}
