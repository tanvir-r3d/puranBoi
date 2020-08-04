<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserRequest;
use App\User;
use JsValidator;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('Backend.Pages.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = new UserRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Backend.Pages.User.create', compact('validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $formData = $request->all();
        $formData['image'] = $this->VerifyStore($request, 'user', 'image');
        $formData['password']=Hash::make($request->password);
        User::create($formData);
        $notification = array(
            'title' => 'User',
            'message' => 'Successfully! User Information Saved.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=User::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rules = new UserRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        $id=Crypt::decryptString($id);
        $user=User::findOrFail($id);
        return view("Backend.Pages.User.edit",compact('user','validator'));
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
        $user=User::find($id);
        if($request->hasFile('image'))
        {
            $image_path = public_path("images/user/{$user->image}");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $user->image=$this->VerifyStore($request, 'user', 'image');
        }
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->save();
        $notification = array(
            'title' => 'User',
            'message' => 'Successfully! User Information Updated.',
            'alert-type' => 'success',
        );

        return redirect('/user/')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $image_path = public_path("images/user/{$user->image}");
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $delete=$user->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'User',
                'message' => 'Successfully! User Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'User',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}
