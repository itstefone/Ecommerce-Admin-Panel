<?php
namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Models\Product;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class ProductRepository extends BaseRepository implements ProductContract {

use UploadAble;

protected $model;

public function __construct(Product $model)
{
  parent::__construct($model);
  $this->model = $model;
}

  public function listProducts(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc') {
        return $this->all($columns, $orderBy, $sortBy);
  }


  public function findProductById(int $id) {
    try {

      return $this->findOneOrFail($id);
    } catch(ModelNotFoundException $e) {
      throw new ModelNotFoundException($e);
    }
  }

  public function createProduct(array $attributes) {
        try {
          $collection = collect($attributes);

          $featured = $collection->has('featured') ? 1 : 0;
          $status = $collection->has('status') ? 1 : 0;

          $merge = $collection->merge(compact('featured', 'status'));

          $product = new Product($merge->all());

          $product->save();
          if($collection->has('categories')) {
            $product->categories()->sync($attributes['categories']);
          }
          return $product;
         } catch(QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
  }
  public function updateProduct(array $attributes) {

    $product = $this->findProductById($attributes['id']);

    $collection = collect($attributes)->except('_token');

    $featured = $collection->has('featured') ? 1 : 0;
    $status = $collection->has('status') ? 1 : 0;

    $merge = $collection->merge(compact('status', 'featured'));

    $product->update($merge->all());

    if($collection->has('categories')) {
      $product->categories()->sync($attributes['categories']);
    }


    return $product;

  }
  public function deleteProduct(int $id) {
      $product = $this->findProductById($id);

      $product->delete();

      return $product;
  }
}