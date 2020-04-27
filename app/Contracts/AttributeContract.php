<?php

namespace App\Contracts;


interface AttributeContract {


public function listAttributes(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc');


public function findAttributeById(int $id);
public function createAttribute(array $attributes);
public function updateAttribute(array $attributes);

public function deleteAttribute(int $id);
}