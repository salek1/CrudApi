<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private Category $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function index(){
        $categories = $this->category->all();
        if (empty($categories)){
            return response([], 404);
        }
        return $categories;
    }

    public function show(int $id){
        $category = $this->category->find($id);
        if (empty($category)){
            return response([], 404);
        }
        return $category;
    }

    public function store(Request $request){
        $this->category->fill($request->all());
        $this->category->save();
        return response($this->category, 201);
    }

    public function update(int $id, Request $request){
        $this->category = $this->category->find($id);
        $this->category->fill($request->all());
        $this->category->save();
        return response($this->category);
    }

    public function destroy(int $id){
        $this->category = $this->category->find($id);
        $this->category->delete();
        return response([], 204);
    }
}
