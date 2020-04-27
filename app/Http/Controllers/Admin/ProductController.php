<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    
        protected $brandRepository;
        protected $categoryRepository;
        protected $productRepository;

    public function __construct(BrandContract $brandRepository, CategoryContract $categoryRepository, ProductContract $productRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }


    public function index() {


        $products = $this->productRepository->all();

        $this->setPageTitle('Products', 'Products List');


        return view('admin.products.index', ['products'=>$products]);
    }


    public function create() {
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Create Product');

        return view('admin.Products.create', ['brands' => $brands, 'categories' => $categories]);
    }


    public function store(StoreProductRequest $request) {

        $attributes = $request->except('_token');
        
        $product = $this->productRepository->createProduct($attributes);

        if(!$product) {
            $this->responseRedirectBack('Error occur while creating product', 'error');
        }

        return $this->responseRedirect('admin.product.index','Created Product Successfully', 'success', false, false);
    }



    public function edit($id) {

        $product = $this->productRepository->findProductById($id);

        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');


        $this->setPageTitle('Products', 'Edit Product');

        return view('admin.Products.edit', ['product'=>$product, 'categories' => $categories, 'brands' =>$brands]);
    }


    public function update(StoreProductRequest $request) {
        $attributes = $request->except('_token');
       $product =  $this->productRepository->updateProduct($attributes);

       if(!$product) {
           return $this->responseRedirectBack('Error occured while updating Product', 'error');
           
       }

       return $this->responseRedirect('admin.product.index', 'Updated Product Successfully', 'success', false, false);

    }
}
