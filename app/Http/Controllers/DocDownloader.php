<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientDoc;

class DocDownloader extends Controller
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
        $file_path = public_path('docs/client/'.$doc->client_doc);
        return response()->download($file_path);
    }
}
