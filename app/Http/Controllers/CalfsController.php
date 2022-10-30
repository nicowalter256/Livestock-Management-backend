<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calfs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class CalfsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Calfs::with('cattle')->get();
        return response()->json(['data' => $data]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tag_no' => 'required',
            'weight' => 'required',
            'cattle_id' => 'required',
            'date_of_birth' => 'required',
            'cattle_image' => 'required',
            'cattle_image.*' => 'image|mimes:jpg,jpeg,png',
            'description' => 'required',
            'gender' => 'required',
            'cattle_breed_id' => 'required',
        ]);
        $files = $request->file('cattle_image');
        if (!$validator->fails()) {
            $cattle = new Calfs();
            //get filename with extension
            $filenamewithextension = $files->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $files->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //small thumbnail name
            $smallthumbnail = $filename . '_small_' . time() . '.' . $extension;

            $files->storeAs("public/calf_images/{$request->user()->id}/small_thumbnail", $smallthumbnail);

            $smallthumbnailpath = "storage/calf_images/{$request->user()->id}/small_thumbnail/" . $smallthumbnail;
            $cattle->name = $request->name;
            $cattle->tag_no = $request->tag_no;
            $cattle->weight = $request->weight;
            $cattle->date_of_birth = $request->date_of_birth;
            $cattle->cattle_image = $smallthumbnailpath;
            $cattle->description = $request->description;
            $cattle->gender = $request->gender;
            $cattle->cattle_id = $request->cattle_id;
            $cattle->cattle_breed_id = $request->cattle_breed_id;
            $cattle->save();
            Notification::route('mail', env('MANAGER_EMAIL'))->notify(new \App\Notifications\NewRecordNotification("New Cow Added", "A new cow has been added by farm manager", "Please Login to the application for details"));
            return response()->json(['message' => 'Calf Added Successfully'], 200);
        } else {
            return $validator->errors();
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
