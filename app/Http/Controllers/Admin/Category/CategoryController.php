<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // pakai db raw
        $categories = Category::select('name', 'category_id', 'categories.id')
            ->leftJoin('articles', 'categories.id', '=', 'articles.category_id')
            ->whereNULL('category_id')
            ->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        Category::create(['name' => $request->name]) ? $msg = ['success', 'Category created successfully'] : $msg = ['error', 'Failed to create category'];
        return redirect()->route('categories.index')
            ->withInput()
            ->with($msg[0], $msg[1]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        Category::find($id)->update(['name' => $request->name]) ? $msg = ['success', 'Category updated successfully'] : $msg = ['error', 'Failed to update category'];
        return redirect()->route('categories.index')
            ->withInput()
            ->with($msg[0], $msg[1]);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category data has been removed');
    }
}
