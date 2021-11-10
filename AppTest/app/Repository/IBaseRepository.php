<?php

namespace App\Repository;

use Illuminate\Support\Collection;


interface IBaseRepository
{

    public function create(array $parameters):?Collection;
    public function findByField(array $fields):?Collection;
}
