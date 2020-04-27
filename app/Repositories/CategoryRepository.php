<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryContract;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class CategoryRepository extends BaseRepository implements CategoryContract {

  use UploadAble;


  public function __construct(Category $model)
  {
    parent::__construct($model);
    $this->model = $model;
  }


  public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']) {

    return $this->all($columns, $order, $sort);
  }

  public function findCategoryById(int $id) {
    try {
      return $this->findOneOrFail($id);
    } catch(ModelNotFoundException $e) {
        throw new ModelNotFoundException($e);
    }
  }
  public function createCategory(array $attributes) {
    try {
      $collection = collect($attributes);

      $image = null;

      if($collection->has('image') && ($attributes['image'] instanceof UploadedFile)) {
        $image = $this->uploadOne($attributes['image'],  'categories');
      }

      $featured = $collection->has('features') ? 1 : 0;
      $menu = $collection->has('menu') ? 1 : 0;
      $merge = $collection->merge(compact('menu', 'image', 'featured'));

      $category = new Category($merge->all());
      $category->save();
      return $category; 
    } catch(QueryException $e) {
      throw new InvalidArgumentException($e->getMessage());
    }
  }

  public function updateCategory(array $attributes) {
      $category = $this->findCategoryById($attributes['id']);

      $collection = collect($attributes)->except('_token');

      if($collection->has('image') && ($attributes['image'] instanceof UploadedFile)) {

        if($category->image != null) {
          $this->deleteOne($category->image);
         
        }

        $image = $this->uploadOne($attributes['image'], 'categories');
      } else {
        $image = $category->image;
      }

      $featured = $collection->has('featured') ? 1 : 0;
      $menu = $collection->has('menu') ? 1 : 0;


        
      
      $merge = $collection->merge(compact('image', 'featured', 'menu'));


      $category->update($merge->all());

      return $category;
  }

  public function deleteCategory(int $id) {
    $category = $this->findCategoryById($id);

    if($category->image != null) {
      $this->deleteOne($category->image);
    }


    $category->delete();

    return $category;
  }

}