<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\RedisService;


class ProductsController extends Controller
{
    protected RedisService $redisService;

    /**
     * ProductsController constructor.
     * @param RedisService $redisService
     */
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    public function index(){
        $this->redisService->incrVisitorCounter();
        return response()->json(Product::all());
    }

}
