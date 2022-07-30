<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // categories = Category::get(); // get all record without pagination
       $searchTerm = request()->get('s');
        $categories = Category::latest()->orWhere('title', 'LIKE', "%$searchTerm%")->paginate(15);
        return view('admin/category/index')
            ->with(compact('categories'));
    }
    public function create()
    {
    	return view('admin/category/create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
        'title' => 'required',
        'slug' => 'required',
        ]);

        Category::create([
    	'title' => request()->get('title'),
        'slug' => request()->get('slug'),
        'description' => request()->get('description'),
        'status' => 'DEACTIVE',
        ]);

        return redirect()->to('/admin/category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
    	return view('admin/category/edit')
            ->with(compact('category'));
    }

    public function update($id)
    {
        $category = Category::find($id);
        $category->update([
        'title' => request()->get('title'),
        'slug' => request()->get('slug'),
        'description' => request()->get('description'),
        ]);
        return redirect()->to('/admin/category');
    }
    
    public function destroy(Request $request, $id)
    {
        if ($request->ajax())
        {
    	$category = Category::find($id);
        $category->delete();
        return 'true';
            
        }
    }

    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax()) {
            
            $category = Category::find($id);
            $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
            $category->update([
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
                Category::where('id', $value)->update(['status' => 'ACTIVE']);
            }
            $record = Category::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Category::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Category::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Category::where('id', $value)->delete();
            }
            $record = Category::find($request->statusAll);
            return $record;
        }
    }




}
