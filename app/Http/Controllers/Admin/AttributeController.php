<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttributeContract;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeController extends BaseController
{
    

    protected $attributeRepository;


    public function __construct(AttributeContract $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }


    public function index() {
        $attributes = $this->attributeRepository->listAttributes();

        $this->setPageTitle('Attributes', 'List of all attributes');


        return view('admin.Attribute.index', ['attributes' => $attributes]);
    }


    public function create() {

        $this->setPageTitle('Attributes', 'Create Attribute');

        return view('admin.Attribute.create');
    }



    public function store(Request $request) {

        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'frontend_type' => 'required'
        ]);
        $attributes = $request->except('_token');
        $attribute = $this->attributeRepository->createAttribute($attributes);
        if(!$attribute) {
            $this->responseRedirectBack('Error occured while creating attribute');
        } 
        return $this->responseRedirect('admin.attribute.index', 'Attribute Added Successfully', 'success', false, false);
    }


    public function edit($id) {
        $attribute = $this->attributeRepository->findAttributeById($id);

        $this->setPageTitle('Attributes', 'Edit Attribute : '.$attribute->name);
        return view('admin.Attribute.edit', compact('attribute'));
    }
    public function update(Request $request) {  
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'frontend_type' => 'required'
        ]);
        
        $attributes = $request->except('_token');
        $updatedAttribute =  $this->attributeRepository->updateAttribute($attributes);
        if(!$updatedAttribute) {
           return     $this->responseRedirectBack('Error occur while updating attribute','error');
        }

        return $this->responseRedirect('admin.attribute.index', 'Attribute successfully updated!', 'success', false, false);
    }



    public function delete($id) {


        $this->attributeRepository->delete($id);

        return $this->responseRedirect('admin.attribute.index','Attribute Successfully Deleted', 'success', false, false);
    }
}
