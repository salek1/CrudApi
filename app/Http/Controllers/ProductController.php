<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;

class ProductController extends Controller
{

    private Product $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){
        $products = $this->product->with('category')->get();
        if(empty($products)){
            return response([], 404);
        }
        return $products;
    }

    public function show(int $id){
        $product = $this->product->with('category')->find($id);
        if(empty($product)){
            return response([], 404);
        }
        return $product;
    }

    public function store(Request $request){
        $this->product->fill($request->all());
        $this->product->categoryId = $request->get('categoryId');
        $this->product->save();
        return response($this->product, 201);
    }

    public function update(int $id, Request $request){
        $this->product = $this->product->find($id);
        $this->product->fill($request->all());
        $this->product->categoryId = $request->get('categoryId');
        $this->product->save();
        return response($this->product);
    }

    public function destroy(int $id){
        $this->product = $this->product->find($id);
        $this->product->delete();
        return response([], 204);
    }
}
