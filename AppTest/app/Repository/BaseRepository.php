<?php

namespace App\Repository;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

abstract class BaseRepository implements IBaseRepository
{
    protected string $ulr='';
    protected array $argument=[];
    private Client $client;
    public function __construct(Client $client)
    {
        $this->client=$client;
    }
    public function findByField(array $fields): ?Collection
    {
        return  $this->send_request($this->createUrl(),['query'=>$this->createFilter($fields)]);
    }

    public function create(array $parameters): ?Collection
    {
        return $this->send_request($this->createUrl().'/create',['form_params'=>$parameters],'POST');
    }

    protected function send_request(string $url=null,array $body=[],$method='GET'){
        try {
            $response = $this->client->request($method, $url,$body);
            if ($response->getStatusCode()==400){
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
        return $this->response($response->getBody()->getContents());
    }
    protected  function response($response): ?Collection
    {
        if ($response) {
            $collection=json_decode($response);
            if (!$collection['success']){
                return null;
            }
            return collect($collection);
        }
        return null;
    }
    protected function createUrl($parameter=null):string{
        if ($parameter){
            return $this->ulr.'/'.$parameter.'/'.implode('/',$this->argument);
        }else{
            return $this->ulr.'/'.implode('/',$this->argument);
        }

    }
    protected function createFilter(array $fields):string{
        return array_walk($fields, function($a, &$b) { $b = 'filter['.$b.']';});
    }
}
