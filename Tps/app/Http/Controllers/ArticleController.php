<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = DB::select('select * from articles');
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' =>'required',
            'content' =>'required',
            'author' =>'required',
        ]);

        DB::insert('insert into articles (title, content, author) values (?, ?, ?)', [
            $validated['title'],
            $validated['content'],
            $validated['author'],
            ]);
            return redirect()->route('articles.index')->with('success','article created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $this->validate($request, [
            'title' =>'required',
            'content' =>'required',
            'author' =>'required',
        ]);
        DB::update('update articles set title = ?, content = ?, author = ? where id = ?', [
        $validated['title'],
        $validated['content'],
        $validated['author'],
        $article->id
        ]);
        return redirect()->route('articles.index')->with('success','article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        DB::delete('delete from articles where id = ?', [$article->id]);
        return redirect()->route('articles.index')->with('success','article deleted successfully');
    }
}
