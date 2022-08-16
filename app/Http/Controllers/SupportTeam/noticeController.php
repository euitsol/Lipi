<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Model
use App\Models\notice;

// helper
use App\Helpers\Qs;

// illuminate
use Illuminate\Support\Facades\Storage;

class noticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = notice::all();
        return view("pages.support_team.notice.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = new notice;

        $insert->notice_title = $request->notice_title;
        // $insert->notice_file = $request->notice_file;

        // $data['code'] = strtoupper(Str::random(10));
        if($request->hasFile('notice_file')) {
            $notice_file = $request->file('notice_file');
            $f = Qs::getFileMetaData($notice_file);
            $f['name_notice_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_notice_file'] = $notice_file->storeAs(Qs::getUploadPath('notice'), $f['name_notice_file']);
            // $insert->notice_file = $request->notice_file;
            $insert->notice_file = asset('storage/' . $f['path_notice_file']);
        }

        $insert->save();
        return  Qs::jsonStoreOk();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = notice::find($id);
      return view("pages.support_team.notice.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = notice::find($id);
        $update->notice_title = $request->notice_title;
        $path = $update->notice_file;
        Storage::exists($path)?Storage::deleteDirectory($path): false ;
        if($request->hasFile('notice_file')) {
            $notice_file = $request->file('notice_file');
            $f = Qs::getFileMetaData($notice_file);
            $f['name_notice_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_notice_file'] = $notice_file->storeAs(Qs::getUploadPath('notice'), $f['name_notice_file']);
            // $insert->notice_file = $request->notice_file;
            $update->notice_file = asset('storage/' . $f['path_notice_file']);
        }
        $update->save();
        return Qs::jsonUpdateOk();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $delete= notice::find($id);
       $path = $delete->notice_file;
       Storage::exists($path)?Storage::deleteDirectory($path): false ;

       $delete->delete();
        return back()->with('flash_success', __('msg.del_ok'));
    }
}
