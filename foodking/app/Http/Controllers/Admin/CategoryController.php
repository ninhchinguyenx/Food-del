<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_ROOT = 'admin.category.';
    public function index()
    {
        $categories = Category::all();
        return view(self::PATH_ROOT . 'index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_ROOT . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $dataCategory = [
                    'name' => $request->name,
                ];
                if ($request->hasFile('img')) {
                    $dataCategory['img'] = Storage::put('admin/categories', $request->file('img'));
                }
                Category::query()->create($dataCategory);
            });
            return redirect()->route('categories.index');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view(self::PATH_ROOT. 'edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $category = Category::findOrFail($id);
                $is_active= $request->is_active == 'on' ? true : false;
                $dataCategory = [
                    'name' => $request->name,
                    'is_active' => $is_active,
                ];
                if ($request->hasFile('img')) {
                    Storage::delete($category->img);
                    $dataCategory['img'] = Storage::put('admin/categories', $request->file('img'));
                }      
                $category->update($dataCategory);
            });
            return redirect()->route('categories.index');
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
