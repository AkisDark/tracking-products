<?php

namespace App\Http\Controllers\Dashboard\Products;

use Exception;
use App\Models\State;
use App\Traits\Upload;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PriceProductState;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Requests\SubCategories\UpdateSubCategoryRequest;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        //
        $products = Product::with('category:id,name')
            ->with('subcategory:id,name')
            ->orderByDesc('id')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('delivery_company', 'like', '%' . $search . '%')
                    ->orWhere('wholesale_price', 'like', '%' . $search . '%')
                    ->orWhere('retail_price', 'like', '%' . $search . '%')
                    ->orWhere('weight', 'like', '%' . $search . '%')
                    ->orWhere('barcode', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('subcategory', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(15)
            ->withQueryString();
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderByDesc('id')->limit(100)->get();
        $subcategories = SubCategory::select('id', 'name')->orderByDesc('id')->limit(100)->get();
        $states = State::get();
        return view('pages.products.create', compact('categories', 'subcategories', 'states'));
    }


    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            //
            $product = Product::create([
                'name' => $request->input('name'),
                'delivery_company' => $request->input('delivery_company'),
                'wholesale_price' => $request->input('wholesale_price', 0),
                'retail_price' => $request->input('retail_price', 0),
                'weight' => $request->input('weight', 0),
                'barcode' => $request->input('barcode', Str::random(10)),
                'category_id' => $request->input('category_id'),
                'subcategory_id' => $request->input('subcategory_id'),
                'image' => Upload::image($request->file('image'), 'products')
            ]);
            //
            if ($product) {
                //
                $data = [];
                foreach (range(1, 58) as $index) {
                    $data[] = [
                        'product_id' => $product->id,
                        'state_id' => $index,
                        //
                        'wholesale_price' => $request->input('wholesale_prices')[$index] ?? $request->input('wholesale_price', 0),
                        'retail_price' => $request->input('retail_prices')[$index] ?? $request->input('retail_price', 0),
                    ];
                }
                //
                PriceProductState::insert($data);
            }
            DB::commit();
            //
            return redirect()->route('products.index', ['search' => $product->name]);
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function edit(Product $product)
    {
        $prices = PriceProductState::where('product_id', $product->id)->with('state')->get();
        $categories = Category::select('id', 'name')->orderByDesc('id')->limit(100)->get();
        $subcategories = SubCategory::select('id', 'name')->orderByDesc('id')->limit(100)->get();
        $states = State::get();
        return view('pages.products.edit', compact('categories', 'subcategories', 'prices', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            //
            if ($request->has('delivery_company')) {
                $product->delivery_company = $request->input('delivery_company');
            }
            //
            if ($request->has('name')) {
                $product->name = $request->input('name');
            }
            //
            if ($request->has('category_id')) {
                $product->category_id = $request->input('category_id');
            }
            //
            if ($request->has('subcategory_id')) {
                $product->subcategory_id = $request->input('subcategory_id');
            }
            //
            if ($request->has('wholesale_price')) {
                $product->wholesale_price = $request->input('wholesale_price');
            }
            //
            if ($request->has('retail_price')) {
                $product->retail_price = $request->input('retail_price');
            }
            //
            if ($request->has('barcode')) {
                $product->barcode = $request->input('barcode');
            }
            //
            if ($request->has('price_per_state')) {
                $product->price_per_state = $request->input('price_per_state');
            }
            //
            if ($request->has('image')) {
                //
                $product->image = Upload::image($request->file('image'), 'products');
            }
            //
            $product->save();
            //
            if ($product && $request->has('wholesale_prices') && $request->has('retail_prices')) {
                //
                $data = [];
                foreach (range(1, 58) as $index) {
                    $data[] = [
                        'product_id' => $product->id,
                        'state_id' => $index,
                        //
                        'wholesale_price' => $request->input('wholesale_prices')[$index] ?? $request->input('wholesale_price', 0),
                        'retail_price' => $request->input('retail_prices')[$index] ?? $request->input('retail_price', 0),
                    ];
                }
                //
                PriceProductState::where('product_id', $product->id)->delete();
                PriceProductState::insert($data);
            }
            DB::commit();
            //
            return redirect()->route('products.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        //
        $product->delete();
        //
        return redirect()->route('products.index');
    }
}
