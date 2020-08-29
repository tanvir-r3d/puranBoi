<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientDoc;
use App\Http\Requests\ClientRequest;
use App\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use JsValidator;
use App\Traits\FileTrait;
use DB;
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
        $clients = Client::with("institute","clientdoc")->get();
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
        $institutes=Institute::all();
        $validator = JsValidator::make($rules->rules(), [], $rules->name());
        return view('Backend.Pages.Client.create', compact('validator','institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        DB::beginTransaction();
        $requestedData=$request->all();
//        Client Image Insert via FileTrait
        $requestedData['client_image']=$this->VerifyStore($request,'client','client_image');
        $client=new Client();
        $client->fill($requestedData)->save();
//      Client Doc Table Multiple File Insert
        for($i=0;$i<($request->row_no);$i++)
        {
                $data[]=[
                    'client_doc'=> $this->MultiFile($request->client_doc[$i],'docs/client/','client'),
                    'client_id' => $client->client_id,
                    'doc_type'=>$request->doc_type[$i]
                    ];
        }
        ClientDoc::insert($data);
        DB::commit();
        $notification = array(
            'title' => 'Client',
            'message' => 'Successfully! Client Information Saved.',
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
        $client=Client::with("clientdoc","institute")->findOrFail($id);
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
        $client=Client::with("clientdoc","institute")->findOrFail($id);
        $institutes=Institute::all();
        return view("Backend.Pages.Client.edit",compact('client','institutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $requestedData=$request->all();
        $client=Client::findOrFail($id);
        if($request->client_image)
        {
            if ($client->client_image)
            {
                $old_path='/images/client/'.$client->client_image;
                if (File::exists($old_path))
                {
                    File::delete($old_path);
                }
            }
            $requestedData['client_image']=$this->VerifyStore($request,'client','client_image');
        }
        $client->fill($requestedData)->save();
        $data=[];
        if ($request->row_no>1)
        {
            for($i=0;$i<($request->row_no);$i++)
            {
                $data[]=[
                    'client_doc'=> $this->MultiFile($request->client_doc[$i],'docs/client/','client'),
                    'client_id' => $id,
                    'doc_type'=>$request->doc_type[$i]
                ];
            }
        } else {
            if ($request->client_doc)
            {
                $data[]=[
                    'client_doc' => $this->MultiFile($request->client_doc[0],'docs/client/','client'),
                    'client_id' => $id,
                    'doc_type'=>$request->doc_type[0]
                ];
            }
        }
        if ($data)
        {
            ClientDoc::insert($data);
        }
        DB::commit();
        $notification = array(
            'title' => 'Client',
            'message' => 'Successfully! Client Information Update.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

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
        $delete=$client->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Client',
                'message' => 'Successfully! Client Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Client',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}
