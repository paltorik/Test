<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrdersRepository $ordersRepository;
    public function __constructor(OrdersRepository $ordersRepository){
        $this->ordersRepository=$ordersRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(StoreOrderRequest $request)
    {
        $order=$this->ordersRepository->createByProduct($request);
        if ($order){
            return redirect('/');
        }else{
            return redirect()->with(['error'=>'Ошибка оформления заказа']);
        }

    }






}
