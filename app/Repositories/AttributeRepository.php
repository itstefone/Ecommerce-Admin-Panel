<?php
namespace App\Repositories;

use App\Models\Attribute;
use App\Contracts\AttributeContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class AttributeRepository extends BaseRepository implements AttributeContract {

  protected $model;

  public function __construct(Attribute $model)
  {
    parent::__construct($model);
    $this->model = $model;
  }



  public function listAttributes(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc') {

  return  $this->all($columns, $orderBy, $sortBy);
  }
public function findAttributeById(int $id) {
  try {
    return $this->findOneOrFail($id);
  }catch(ModelNotFoundException $e) {
    throw new ModelNotFoundException($e);
  }
}
public function createAttribute(array $attributes) {
  
try {
  $collection = collect($attributes);
  $is_filterable = $collection->has('is_filterable') ? 1 : 0;
  $is_required = $collection->has('is_required') ? 1 : 0;
  $merge = $collection->merge(compact('is_filterable', 'is_required'));
  $attribute = new Attribute($merge->all());
  $attribute->save();
  return $attribute;
} catch(QueryException $e) {
  throw new InvalidArgumentException($e->getMessage());
}

}
public function updateAttribute(array $attributes) {
 $attribute = $this->findAttributeById($attributes['id']);

 $collection = collect($attributes)->except('_token');

 $is_filterable = $collection->has('is_filterable') ? 1 : 0;
 $is_required = $collection->has('is_required') ? 1 : 0;
 $merge = $collection->merge(compact('is_required', 'is_filterable'));
 $attribute->update($merge->all());
 return $attribute;
}
public function deleteAttribute(int $id) {

  $attribute = $this->findAttributeById($id);

  $attribute->delete();

  return $attribute;
}

}