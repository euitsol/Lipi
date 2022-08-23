<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\Section\SectionCreate;
use App\Http\Requests\Section\SectionUpdate;
use App\Repositories\MyClassRepo;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use App\Models\Section;
// use Request;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        // $d['my_classes'] = $this->my_class->all();
        // $d['sections'] = $this->my_class->getAllSections();
        // $d['teachers'] = $this->user->getUserByType('teacher');
        $d['sections'] = Section::all();

        return view('pages.support_team.sections.index', $d);
    }

    public function store(Request $req)
    {
        $insert=new Section; 
        $insert->name = $req->name;
        $insert->save();

        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $id = Qs::decodeHash($id);
        
        // $d['s'] = $s = $this->my_class->findSection($id);
        $d['sections'] = Section::find($id);

        return view('pages.support_team.sections.edit', $d);
    }

    public function update(Request $req, $id)
    {
        $id = Qs::decodeHash($id);
        $update = Section::find($id);
        $update->name =  $req->name;
        $update->save();

        return redirect()->route('sections.index')->with('msg',"Successfully updated");
    }

    public function destroy($id)
    {
        $id = Qs::decodeHash($id);
        $delete = Section::find($id);
        $delete->delete();
        return back()->with('msg', __('Successfully deleted'));
    }

}