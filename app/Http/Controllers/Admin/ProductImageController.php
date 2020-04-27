<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Traits\UploadAble;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    use UploadAble;

   

    protected $productRepository;
    public function __construct(ProductContract $productRepository) 
    {
        $this->productRepository = $productRepository;
    }


    public function uplaod(Request $request) {

        $product = $this->productRepository->findProductById($request->product_id);


        if($request->has('image')) {
            $image = $this->uploadOne($request->image, 'products');
        }

        $productImage = new ProductImage([
            'full' => $image,
            'thumbnail' => 'adspoiasidasd'
        ]);

        $product->images()->save($productImage);
        return response()->json(['status' => 'success']);
    }


    public function delete($id) {
        $image = ProductImage::findOrFail($id);

        if($image->full !== '') {
            $this->deleteOne($image->full);
        }
        $image->delete();
        return redirect()->back();
    }
   
}
