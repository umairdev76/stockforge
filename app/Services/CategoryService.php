<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class CategoryService{
    public function __construct()
    {
        //
    }
    
    public function createCategory(array $data, User $user){
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }
    public function UpdateCategory(Category $category, array $data){
        $data['slug'] = Str::slug($data['name']);
        return $category->update($data);    
    }
    public function deleteCategory(Category $category){
        return $category->delete();
    }
}