<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\Upload;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        //
        $categories = Category::orderByDesc('id')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(15)
            ->withQueryString();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }


    public function store(StoreCategoryRequest $request)
    {

        Category::create([
            'name' => $request->input('name'),
            'image' => Upload::image($request->file('image'), 'categories'),
        ]);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {

        return view('pages.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        if ($request->has('name')) {
            $category->name = $request->input('name');
        }
        //
        if ($request->has('image')) {
            //
            $category->image = Upload::image($request->file('image'), 'categories');
        }
        //
        $category->save();
        //
        return redirect()->route('categories.index', ['search' => $category->name]);
    }

    public function destroy(Category $category)
    {
        //
        $category->delete();
        //
        return redirect()->route('categories.index');
    }
}
