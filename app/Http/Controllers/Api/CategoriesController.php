<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoriesController extends Controller
{
    public function tree(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::with('childrenRecursive')->paginate(10));
    }
}
