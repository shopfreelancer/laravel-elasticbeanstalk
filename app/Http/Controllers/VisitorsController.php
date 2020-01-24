<?php

namespace App\Http\Controllers;

use App\Services\RedisService;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    protected RedisService $redisService;

    /**
     * VisitorsController constructor.
     * @param RedisService $redisService
     */
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }


    public function showCounter(){
        return response()->json($this->redisService->getVisitorCounter());
    }

}
