<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;

class BookController extends Controller
{
    public function show($slug)
    {
    	$book = Book::where('slug', $slug)->first();
    	
    	$books = Book::where('slug', '=', $slug)->limit(3)->get();
        
        $categories = Category::all();

        $related = Book::where('category_id', '=', $book->category->id)
            ->where('id', '!=', $book->id)
            ->get();
            //dd($related);
        return view('book/detail')
        	->with(compact('book', 'books', 'categories', 'related'));

    }

    public function related_post($slug)
    {
        $book = Book::where('slug', '=', $slug)->first();
        $tags = Tag::all();
        $categories = Category::all();

        $related = Book::where('category_id', '=', $book->category->id)
            ->where('id', '!=', $book->id)
            ->get();
            //dd($related);
        return view('blog.show')
            ->withPost($book)
            ->withTags($tags)
            ->withCategories($categories)
            ->withRelated($related);

    }
}
