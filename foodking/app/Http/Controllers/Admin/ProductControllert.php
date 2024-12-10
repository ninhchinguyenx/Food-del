<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Event\TestSuite\Loaded;

class ProductControllert extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_ROOT = 'admin.product.';


    public function index()
    {
        // $products = Product::orderBy('id', 'desc')->paginate(15);
        $products = Product::with(['category', 'tags'])->orderBy('id', 'desc')->paginate(15);
        return view(self::PATH_ROOT . 'index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_ROOT . 'create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $slug = $request->name . '-' .$request->sku;
                $dataProduct = [
                    'name' => $request->name,
                    'price_regular' => $request->price_regular,
                    'price_sale' => $request->price_sale,
                    'quantity' => $request->quantity,
                    'sku' => $request->sku,
                    'detail' => $request->detail,
                    'description' => $request->description,
                    'more_details' => $request->more_details,
                    'slug' => $slug,
                    'category_id' => $request->category,
                ];
                if ($request->hasFile('img_thumbnail')) {
                    $dataProduct['img_thumbnail'] = Storage::put('admin/product/thumbnail', $request->file('img_thumbnail'));
                }
                $product = Product::query()->create($dataProduct);
                if ($request->hasFile('img_gallery')) {
                    foreach ($request->img_gallery as $img) {
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'img' => Storage::put('admin/product/galleries', $img)
                        ]);
                    }
                }
                $product->tags()->attach($request->tags);
            });
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load(['category','tags', 'product_gallery']);
        $categories = Category::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        $productTags = $product->tags->pluck('id')->all();
        return view(self::PATH_ROOT . 'edit', compact('categories','tags', 'product','productTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {
                $slug = $request->name . '-' .$request->sku;
                $dataProduct = [
                    'name' => $request->name,
                    'price_regular' => $request->price_regular,
                    'price_sale' => $request->price_sale,
                    'quantity' => $request->quantity,
                    'sku' => $request->sku,
                    'detail' => $request->detail,
                    'description' => $request->description,
                    'more_details' => $request->more_details,
                    'slug' => $slug,
                    'category_id' => $request->category,
                ];
                if ($request->hasFile('img_thumbnail')) {
                    Storage::delete($product->img_thumbnail);
                    $dataProduct['img_thumbnail'] = Storage::put('admin/product/thumbnail', $request->file('img_thumbnail'));
                }
                $product->update($dataProduct);
                if ($request->hasFile('img_gallery')) {
                    foreach ($request->img_gallery ?? [] as $id => $img) {
                        $gallery = Gallery::findOrFail($id);
                        Storage::delete($img);
                        $gallery->update([
                            'img' => Storage::put('admin/product/galleries', $img)
                        ]);
                    }
                }
                $product->tags()->sync($request->tags);
            });
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
