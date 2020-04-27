<?php
namespace App\Contracts;

interface CategoryContract {



  public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

  public function findCategoryById(int $id);

  public function createCategory(array $attributes);

  public function updateCategory(array $attributes);

  public function deleteCategory(int $id);
}