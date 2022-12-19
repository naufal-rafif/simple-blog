<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        // pakai db raw
        if (request()->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($tag) {
                    $actionBtn = '
                    <div class="flex item-center justify-center">
                        <a href="' . route('categories.edit', $tag->id) . '" class="mr-2 transform hover:text-indigo-500 hover:scale-110">
                            <span class="bx bx-pencil text-lg"></span>
                        </a>
                        <button data-val="' . route('categories.destroy', $tag->id) . '" class="btn_empty mr-2 transform hover:text-indigo-500 hover:scale-110 text-red-600">
                            <span class="bx bx-trash text-lg"></span>
                        </button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.index');
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
