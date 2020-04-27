<?php
namespace App\Contracts;


interface ProductContract {
 
  

  public function listProducts(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc');

  public function findProductById(int $id);
  public function createProduct(array $attributes);
  public function updateProduct(array $attributes);
  public function deleteProduct(int $id);
}