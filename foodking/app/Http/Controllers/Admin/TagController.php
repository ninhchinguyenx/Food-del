<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_ROOT = 'admin.tag.';
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->paginate(15);
        return view(self::PATH_ROOT . 'index', compact('tags'));
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
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $dataTag = [
                    'name' => $request->name,
                ];
                Tag::query()->create($dataTag);
            });
            return redirect()->route('tags.index')->with('success', 'Tạo thành công!');
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
        $tag = Tag::findOrFail($id);
        return view(self::PATH_ROOT. 'edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $tag = Tag::findOrFail($id);
                $is_active= $request->is_active == 'on' ? 1 : 0;
                $dataTag = [
                    'name' => $request->name,
                    'is_active' => $is_active,
                ];      
                $tag->update($dataTag);
            });
            return redirect()->route('tags.index')->with('success','Sửa thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $tag = Tag::findOrFail($id);
                $tag->update(['is_active' => 0]);
            });
            return redirect()->route('tags.index')->with('success','Sưa thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
