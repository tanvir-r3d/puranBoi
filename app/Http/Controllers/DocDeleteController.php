<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientDoc;
use Illuminate\Support\Facades\File;

class DocDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $doc=ClientDoc::findOrFail($id);
        if($doc->client_doc)
        {
            $path=public_path("docs/client/").$doc->client_doc;
            if (File::exists($path))
            {
                File::delete($path);
            }
        }
        $delete=$doc->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Client Document',
                'message' => 'Successfully! Client Document Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Client Document',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}
