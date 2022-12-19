<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Tag::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($tag) {
                    $actionBtn = '
                    <div class="flex item-center justify-center">
                        <a href="' . route('tags.edit', $tag->id) . '" class="mr-2 transform hover:text-indigo-500 hover:scale-110">
                            <span class="bx bx-pencil text-lg"></span>
                        </a>
                        <button data-val="' . route('tags.destroy', $tag->id) . '" class="btn_empty mr-2 transform hover:text-indigo-500 hover:scale-110 text-red-600">
                            <span class="bx bx-trash text-lg"></span>
                        </button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.tags.index');
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'color' => $request->color,
            'background' => $request->background,
        ];
        if (Tag::create($data)) {
            return redirect()->route('tags.index')
                ->withInput()
                ->with('success', 'Tag created successfully');
        }
        return redirect()->route('tags.index')
            ->withInput()
            ->with('error', "Can't create tag.");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'color' => $request->color,
            'background' => $request->background,
        ];
        if (Tag::find($id)->update($data)) {
            return redirect()->route('tags.index')
                ->withInput()
                ->with('success', 'Tag updated successfully');
        }
        return redirect()->route('tags.index')
            ->withInput()
            ->with('error', "Can't update tag.");
    }

    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect()->route('tags.index')->with('success', 'Tag data has been removed');
    }
}
