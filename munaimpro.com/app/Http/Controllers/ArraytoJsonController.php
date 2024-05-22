<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ArraytoJson;

class ArraytoJsonController extends Controller
{
    //
    public function convert(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $fileNames = [];

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);
                $fileNames[] = $name; // Store the file name
            }
        }
       $fileName=json_encode($fileNames);
       ArraytoJson::create([
            'name' => $fileName,
        ]);

        return response()->json(['success' => 'Files uploaded successfully.', 'files' => $fileName]);
    }

}
