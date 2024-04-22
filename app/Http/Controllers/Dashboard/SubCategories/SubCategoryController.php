<?php

namespace App\Http\Controllers\Dashboard\SubCategories;

use App\Traits\Upload;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategories\StoreSubCategoryRequest;
use App\Http\Requests\SubCategories\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        //
        $subcategories = SubCategory::with('category:id,name')
            ->orderByDesc('id')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(15)
            ->withQueryString();
        return view('pages.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderByDesc('id')->limit(100)->get();
        return view('pages.subcategories.create', compact('categories'));
    }


    public function store(StoreSubCategoryRequest $request)
    {
        //
        SubCategory::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'image' => Upload::image($request->file('image'), 'subcategories'),
        ]);
        //
        return redirect()->route('subcategories.index');
    }

    public function edit(SubCategory $subcategory)
    {
        $categories = Category::select('id', 'name')->orderByDesc('id')->limit(100)->get();
        return view('pages.subcategories.edit', compact('categories', 'subcategory'));
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subcategory)
    {
        //
        if ($request->has('name')) {
            $subcategory->name = $request->input('name');
        }
        //
        if ($request->has('category_id')) {
            $subcategory->category_id = $request->input('category_id');
        }
        //
        if ($request->has('image')) {
            //
            $subcategory->image = Upload::image($request->file('image'), 'subcategories');
        }
        //
        $subcategory->save();
        //
        return redirect()->route('subcategories.index', ['search' => $subcategory->name]);
    }

    public function destroy(SubCategory $subcategory)
    {
        //
        $subcategory->delete();
        //
        return redirect()->route('subcategories.index');
    }
}
