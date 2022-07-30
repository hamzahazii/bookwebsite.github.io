<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use File;

class TeamController extends Controller
{
    public function index()
    {
        // teams = Team::get(); // get all record without pagination
        $searchTerm = request()->get('s');
        $teams = Team::latest()->when($searchTerm,function($query) use($searchTerm){
            $query->where('fullname', 'LIKE', '%' .$searchTerm. '%');
        })->paginate(15);
    	return view('admin/team/index')
            ->with(compact('teams'));
    }

    public function create()
    {
    	return view('admin/team/create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'fullname' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'facebook_id' => 'required',
            'twitter_id' => 'required',
            'pinterest_id' => 'required',
        ]);

        $fileName = null;
        if (request()->hasFile('team_img'))
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads', $fileName);
        }

    	Team::create([
            'fullname' => request()->get('fullname'),
            'designation' => request()->get('designation'),
            'telephone' => request()->get('telephone'),
            'mobile' => request()->get('mobile'),
            'email' => request()->get('email'),
            'description' => request()->get('description'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'profile' => request()->get('profile'),
            'team_img' => $fileName,
            'status' => 'DEACTIVE',
        ]);

        return redirect()->to('/admin/team');


    }

    public function edit($id)
    {
        $team = Team::find($id);
    	return view('admin/team/edit')
            ->with(compact('team'));
    }

    public function update($id)
    {
        $team = Team::find($id);
        $currentImage = $team->team_img;

        $fileName = null;
        if (request()->hasFile('team_img'))
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $team->update([
            'fullname' => request()->get('fullname'),
            'designation' => request()->get('designation'),
            'telephone' => request()->get('telephone'),
            'mobile' => request()->get('mobile'),
            'email' => request()->get('email'),
            'description' => request()->get('description'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'profile' => request()->get('profile'),
            'team_img' => ($fileName) ? $fileName : $currentImage,
        ]);
        return redirect()->to('admin/team');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax())
        {
    	$team = Team::find($id);
        $currentImage = $team->team_img;
        $team->delete();
        File::delete('./uploads/' . $currentImage);
        return 'true';
            
        }
    }

    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax())
        {
        $team = Team::find($id);
        $newStatus = ($team->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $team->update([
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
                Team::where('id', $value)->update(['status' => 'ACTIVE']);
            }
            $record = Team::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Team::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Team::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Team::where('id', $value)->delete();
            }
            $record = Team::find($request->statusAll);
            return $record;
        }
    }
}
