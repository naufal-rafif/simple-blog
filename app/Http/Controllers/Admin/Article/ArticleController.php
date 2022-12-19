<?php

namespace App\Http\Controllers\Admin\Article;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->articles = new Article();
        $this->articleService = new ArticleService();
    }

    public function index()
    {
        //     if (request()->ajax()) {
        //         $model = Article::with('tags');
        //         return DataTables::of($model)
        //             ->addColumn('tags', function (Article $article) {
        //                 return $article->tags->name;
        //             })
        //             ->toJson();
        //     }
        //     return view('admin/articles/index');
        // if (request()->ajax()) {
        //     return datatables()->of(Article::select('*'))
        //         ->addColumn('action', 'companies.action')
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->make(true);
        // }
        $articles = $this->articles->showDeletedArticle(false);
        // return response()->json($articles, 201);
        return view('admin/articles/index', compact('articles'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin/articles/create', compact('tags', 'categories'));
    }

    public function store(ArticleStoreRequest $request)
    {
        $validated = $request->validated();
        $imageName = $this->articleService->storeImage($request->file('image'));
        $id = Article::create([
            'image' => $imageName,
            'title' => $request->title,
            'slug' => $this->articleService->generateSlug($request->title),
            'writer' => Auth::user()->name,
            'content' => $request->content,
            'status' => $request->status,
            'delete' => 0,
            'category_id' => $request->category_id,
        ])->id;
        $article = Article::find($id);

        $tag = Tag::find(explode(",", $request->tag));
        $article->tags()->attach($tag);

        return redirect()->route('articles.index')->with('success', 'Article created');
    }

    public function show($slug)
    {
        $article = Article::where('slug', '=', $slug)
            ->with('tags')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->first();
        return view('admin.articles.details', compact('article'));
    }

    public function edit($slug)
    {
        $article = Article::with('tags')
            ->where('articles.slug', '=', $slug)
            ->first();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function temp()
    {
        $articles = $this->articles->showDeletedArticle(true);
        return view('admin/articles/temp', compact('articles'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {

        $validated = $request->validated();
        $imageName = $this->articleService->updateImage($request->file('image'), $request->old_image);
        Article::find($id)->update([
            'image' => $imageName,
            'title' => $request->title,
            'slug' => $this->articleService->generateSlug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'delete' => 0,
            'category_id' => $request->category_id,
        ]);
        $article = Article::find($id);

        $tags  = explode(",", $request->tag);
        $article->tags()->sync($tags);

        return redirect()->route('articles.index')->with('success', 'Article successfully changed');
    }

    public function updateStatus(Request $request, $id)
    {
        $article = Article::find($id);
        $article->update(['status' => $request->status]);
        return redirect()->route('articles.index')->with('success', 'Status successfully changed');
    }

    public function delete($id)
    {
        if (Article::find($id)->update([
            'delete' => 1,
            'status' => 0,
        ])) {
            return redirect()->route('articles.index')->with('success', 'Article has ben removed to the trash');
        }
        return redirect()->route('articles.index')->with('error', 'Failed to remove into trash');
    }

    public function deleteMultiple(Request $request)
    {
        if ($request->input('ids') != null) {
            if (Article::whereIn('id', explode(",", $request->input('ids')))->update([
                'delete' => 1,
                'status' => 0
            ])) {
                return redirect()->route('articles.index')->with('success', 'All article has been removed to the trash.');
            }
        }
        return redirect()->route('articles.index')->with('error', 'Failed to remove into trash');
    }

    public function recover($id)
    {
        if (Article::find($id)->update([
            'delete' => 0,
        ])) {
            return redirect()->route('dashboard.articles.temp')->with('success', 'Article recover successfully');
        }
        return redirect()->route('dashboard.articles.temp')->with('error', 'Recover article failed');
    }

    public function recoverMultiple(Request $request)
    {
        if ($request->input('ids') != null) {
            $data = [
                'delete' => 0,
            ];
            if (Article::whereIn('id', explode(",", $request->input('ids')))->update($data)) {
                return redirect()->route('dashboard.articles.temp')->with('success', 'All data recovered successfully.');
            }
        }
        return redirect()->route('dashboard.articles.temp')->with('error', 'Recover all selected data failed.');
    }


    public function destroy($id)
    {
        $article = Article::find($id);
        $this->articleService->destroyImage($article->image);
        $article->delete();
        return redirect()->route('dashboard.articles.temp')->with('success', 'Article removed permanently');
    }

    public function destroyMultiple(Request $request)
    {
        if ($request->input('ids') != null) {
            $array = explode(",", $request->input('ids'));
            foreach ($array as $id) {
                $article = Article::find($id);
                $this->articleService->destroyImage($article->image);
                $article->delete();
            }
            return redirect()->route('dashboard.articles.temp')->with('success', 'All data deleted successfullty');
        }
        return redirect()->route('dashboard.articles.temp')->with('error', 'Failed to delete data');
    }
}
