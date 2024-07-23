<?php

namespace App\CQRS\Http;

use App\CQRS\FactoryInterface;

interface RequestFactoryInterface extends FactoryInterface
{
    public function create(array $args): RequestInterface;
}