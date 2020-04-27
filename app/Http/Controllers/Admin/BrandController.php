<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    

protected $brandRepository;


public function __construct(BrandContract $brandRepository) {
  $this->brandRepository = $brandRepository;
}


public function index() {

  $brands = $this->brandRepository->all();

  $this->setPageTitle('Brands', 'List of all brands');

  
  return view('admin.Brand.index', ['brands'=>$brands]);

}


public function create() {



  $this->setPageTitle('Brands', 'Create Brand');

  return view('admin.Brand.create');
}


public function store(Request $request) {

  $this->validate($request, [
    'name' => 'required',
    'image' => 'mime:jpg,jpeg,png|max:1000'
  ]);

  $attributes = $request->except('_token');

  $brand = $this->brandRepository->createBrand($attributes);

  if(!$brand) {
    return $this->responseRedirectBack('Error occured while creating brand', 'error');
  }

  return $this->responseRedirect('admin.brand.index', 'Brand Added Successfully', 'success', false, false);
}



public function edit($id) {

$brand = $this->brandRepository->findBrandById($id);
$this->setPageTitle('Brands', 'Edit Brand');

return view('admin.Brand.edit', ['brand' => $brand]);
}


public function update(Request $request) {

  $this->validate($request, [
      'name' => 'required',
      'logo' => 'mimes:png,jpg,jpeg|max:1000'
  ]);


  $attributes = $request->except('_token');

  $brand = $this->brandRepository->updateBrand($attributes);

  if(!$brand) {
      return $this->responseRedirectBack('Error occured while updating brand ' , 'error');
  } 

  return $this->responseRedirect('admin.brand.index', 'Successfully Updated Brand', 'success', false, false);
}



public function delete($id) {
  
  $brand = $this->brandRepository->deleteBrand($id);


  if(!$brand) {
    return $this->responseRedirectBack('Error occured while deleting brand ' , 'error');
  } 
  return $this->responseRedirect('admin.brand.index', 'Successfully Updated Brand', 'success', false, false);

} 

}
