<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FileTrait{

    public function VerifyStore(Request $request,$directory='unknown',$fieldname='image')
    {
        if($request->hasFile($fieldname))
        {
            if (!$request->file($fieldname)->isValid()) {

                $notification = array(
                    'title' =>'User',
                    'message' => 'Careful! Only Upload Image',
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);

            }
            $ext=$request->file($fieldname)->getClientOriginalExtension();
            $path=public_path("images/{$directory}/");
            $name=$directory.'_'.time().'.'.$ext;
            $request->file($fieldname)->move($path, $name);
            return $request->image=$name;
        }
        else{
            return $request->image=null;
        }

    }

    public function MultiFile($file,$directory='unknown',$genre="unknown")
    {
            $ext=$file->getClientOriginalExtension();
            $path=public_path("{$directory}");
            $name=$genre.'_'.time().rand(1,9).'.'.$ext;
            $file->move($path, $name);
            return $name;
    }

}
