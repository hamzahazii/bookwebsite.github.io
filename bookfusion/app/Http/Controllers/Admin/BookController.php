<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use App\Country;
use File;

class BookController extends Controller
{

    public function index()
    {
        // $books = Book::get(); // get all record without pagination
        $searchTerm = request()->get('s');
        $books = Book::latest()->orWhere('title', 'LIKE', "%$searchTerm%")->paginate(15);
    	return view('admin/book/index')
          ->with(compact('books'));
    }

    public function create()
    {
        $countries = Country::get();
        return view('admin/author/create')
            ->with(compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
            'author_id' => 'required',
            'price' => 'required',
            'availability' => 'required',
            'description' => 'required',
        ]);
        $fileName = null;
        if (request()->hasFile('book_img'))
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads', $fileName);
        }

    	Book::create([
            'category_id' => request()->get('category_id'),
            'author_id' => request()->get('author_id'),
    		'title' => request()->get('title'),
    		'slug' => request()->get('slug'),
    		'availability' => request()->get('availability'),
    		'price' => request()->get('price'),
    		'rating' => request()->get('rating'),
    		'publisher' => request()->get('publisher'),
    		'country_of_publisher' => request()->get('country_of_publisher'),
    		'isbn' => request()->get('isbn'),
    		'isbn_10' => request()->get('isbn_10'),
    		'audience' => request()->get('audience'),
    		'format' => request()->get('format'),
    		'language' => request()->get('language'),
    		'description' => request()->get('description'),
    		'book_upload' => $fileName,
    		'book_img' => $fileName,
    		'total_pages' => request()->get('total_pages'),
    		'downloaded' => request()->get('downloaded'),
    		'edition_number' => request()->get('edition_number'),
    		'recomended' => request()->get('recomended'),
    		'status' => 'DEACTIVE',
    		'downloaded' => request()->get('downloaded'),
    	]);

    	return redirect()->to('/admin/book');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $countries = Country::get();
    	return view('admin/book/edit')
            ->with(compact('book', 'countries'));
    }

    public function update($id)
    {
        $book = Book::find($id);
         $book = Book::find($id);
        $currentImage = $book->book_img;

        $fileName = null;
        if (request()->hasFile('book_img'))
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }
        $book->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'price' => request()->get('price'),
            'rating' => request()->get('rating'),
            'publisher' => request()->get('publisher'),
            'country_of_publisher' => request()->get('country_of_publisher'),
            'isbn' => request()->get('isbn'),
            'isbn_10' => request()->get('isbn_10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'description' => request()->get('description'),
            'book_upload' => ($fileName) ? $fileName : $currentImage,
            'book_img' => ($fileName) ? $fileName : $currentImage,
            'total_pages' => request()->get('total_pages'),
            'downloaded' => request()->get('downloaded'),
            'edition_number' => request()->get('edition_number'),
            'recomended' => request()->get('recomended'),
            'downloaded' => request()->get('downloaded'),
        ]);

        if ($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('admin/book');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax())
        {
    	$book = Book::find($id);
        $currentImage = $book->book_img;
        $book->delete();
        File::delete('./uploads/' . $currentImage);
        return 'true';
            
        }
    }
    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax())
        {
    	$book = Book::find($id);
    	$newStatus = ($book->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
    	$book->update([
    		'status' => $newStatus
    	]);
    	return $newStatus;
        }
    }

    public function statusActive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->update(['status' => 'ACTIVE']);
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->delete();
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }
}
