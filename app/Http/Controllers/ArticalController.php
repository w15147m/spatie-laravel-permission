<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ArticalController extends Controller implements HasMiddleware
 {
    public static function  middleware(): array
    {
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create', ['article' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'string',  // Ensure text is also validated
            'author' => 'required', // Ensure author is validated
        ]);
        if ($validate->passes()) {
            $article = Article::create([
                'title' => $request->title,
                'text' => $request->text,
                'author' => $request->author
            ]);
            return redirect()->route('articles.index')->with('success', 'Article add successfully.');
        } else {
            dd($request->all());
            return redirect()->back()->withErrors($validate)->withInput();
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
        $article = Article::findOrFail($id);
        return view('article.create', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'string',
            'author' => 'required',
        ]);
        if ($validate->passes()) {
            $article = Article::findOrFail($id);
            $article->update([
                'title' => $request->title,
                'text' => $request->text,
                'author' => $request->author
            ]);
            return redirect()->route('articles.index')->with('success', 'Article update successfully.');
        } else {
            dd($request->all());
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $article = Article::findOrFail($id); // Ensure the article exists
            $article->delete(); // Perform deletion
            return redirect()->route('articles.index')->with('success', 'article deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Failed to delete article.');
        }
    }
}
