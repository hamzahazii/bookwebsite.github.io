<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\media;
use File;

class MediaController extends Controller
{

    public function index()
    {
        // $medias = Media::get(); // get all record without pagination
        $searchTerm = request()->get('s');
        $medias = Media::latest()->when($searchTerm,function($query) use($searchTerm){
        $query->where('title', 'LIKE', '%' .$searchTerm. '%');
        })->paginate(15);
    	return view('admin/media/index')
            ->with(compact('medias'));
    }

    public function create()
    {
    	return view('admin/media/create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
        'title' => 'required',
        'slug' => 'required',
        'media_type' => 'required|not_in:none',
        ]);

        $fileName = null;
        if (request()->hasFile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads', $fileName);
        }


    	Media::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'media_type' => request()->get('media_type'),
            'description' => request()->get('description'),
            'media_img' => $fileName,
            'status' => 'DEACTIVE',
        ]);

        return redirect()->to('/admin/media');
    }

    public function edit($id)
    {
        $media = Media::find($id);
    	return view('admin/media/edit')
            ->with(compact('media'));
    }

    public function update(Request $request, $id)
    {
        $media = Media::find($id);
        $currentImage = $media->media_img;

        $fileName = null;
        if (request()->hasFile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }
        $media->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'media_type' => request()->get('media_type'),
            'description' => request()->get('description'),
            'media_img' => ($fileName) ? $fileName : $currentImage,
        ]);

        if ($fileName) 
            File::delete('./uploads/' . $currentImage);
        
        return redirect()->to('admin/media');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax())
        {
    	$media = Media::find($id);
        $currentImage = $media->media_img;
        $media->delete();
        File::delete('./uploads/' . $currentImage);
        return 'true';
            
        }
    }

    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax())
        {
        $media = Media::find($id);
        $newStatus = ($media->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $media->update([
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
                Media::where('id', $value)->update(['status' => 'ACTIVE']);
            }
            $record = Media::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Media::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Media::find($request->statusAll);
            return $record;
        }
    }

     public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Media::where('id', $value)->delete();
            }
            $record = Media::find($request->statusAll);
            return $record;
        }
    }
}
