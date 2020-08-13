<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute;
use App\Http\Requests\InstituteRequest;
use JsValidator;

class InstituteController extends Controller
{

    public function index()
    {
        $institutes=Institute::orderBy('inst_id','desc')->get();
        $rules = new InstituteRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Backend.Pages.Institute.index',compact('institutes','validator'));
    }



    public function store(InstituteRequest $request)
    {
        $institute=New Institute;
        $institute->fill($request->all())->save();
        $notification = array(
            'title' => 'Institute',
            'message' => 'Successfully! Institute Information Saved.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }



    public function edit($id)
    {
        $institute = Institute::findOrFail($id);
        return response()->json($institute);
    }



    public function update(InstituteRequest $request, $id)
    {
        $institute=Institute::find($id);
        $institute->fill($request->all())->save();
        $notification = array(
            'title' => 'Institute',
            'message' => 'Successfully! Institute Information Updated.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }



    public function destroy($id)
    {
        $institute = Institute::findOrFail($id);

        $delete=$institute->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Institute',
                'message' => 'Successfully! Institute Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Institute',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}
