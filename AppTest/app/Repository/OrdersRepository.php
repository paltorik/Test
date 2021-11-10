<?php

namespace App\Repository;

use App\Http\Requests\StoreOrderRequest;
use GuzzleHttp\Client;

class OrdersRepository  extends BaseRepository
{
    private ProductRepository $productRepository;
    public function __construct(Client $client,ProductRepository $productRepository)
    {
        parent::__construct($client);
        $this->productRepository=$productRepository;
    }

    protected string $ulr='orders';

    public function createByProduct(StoreOrderRequest $request){

        $products=$this->productRepository->findByField([
            'manufacturer'=>$request->brand,
            'name'=>$request->article,
        ]);
        if (!$products) return null;
        $name=explode(' ',$request->get('full-name'));
        return $this->create([
            'items[id]'=>[$products[0]['offers'][0]['id']],
            'order[firstName]'=>$name[0],
            'order[lastName]'=>$name[1],
            'order[patronymic]'=>$name[2],
            'order[status]'=>'trouble',
            'order[number]'=>23111995,
            'order[orderMethod]'=>'test',
            'site'=>'test'
        ]);


    }
}
