<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::select('name', 'article_tag.article_id', 'tags.id')
            ->leftJoin('article_tag', 'tags.id', '=', 'article_tag.tag_id')
            ->whereNULL('article_tag.article_id')
            ->paginate(5);
        return view('admin.tags.index', compact('tags'));
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
