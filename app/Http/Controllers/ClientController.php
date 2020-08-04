<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use JsValidator;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Crypt;

class ClientController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        return view('Backend.Pages.Client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = new ClientRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Backend.Pages.Client.create', compact('validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $formData['image'] = $this->VerifyStore($request, 'user', 'image');
        Client::create($formData);
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
        $client=Client::findOrFail($id);
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rules = new ClientRequest;
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        $id=Crypt::decryptString($id);
        $clients=Client::findOrFail($id);
        return view("Backend.Pages.Client.edit",compact('clients','validator'));
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
        $user=Client::find($id);
        if($request->hasFile('image'))
        {
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
        $client = Client::findOrFail($id);
        $image_path = public_path("images/client/{$client->image}");
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $delete=$client->delete();
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
