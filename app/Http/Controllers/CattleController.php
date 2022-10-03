<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cattle;
use Illuminate\Support\Facades\Validator;

class CattleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cattle::all();
        return response()->json($data);
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
            'date_of_birth' => 'required',
            'cattle_image' => 'required',
            'cattle_image.*' => 'image|mimes:jpg,jpeg,png',
            'description' => 'required',
            'gender' => 'required',
            'cattle_breed_id' => 'required',
        ]);
        $files = $request->file('cattle_image');
        if (!$validator->fails()) {
            $cattle = new Cattle();
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

            $files->storeAs("public/product_images/{$request->user()->id}/small_thumbnail", $smallthumbnail);

            $smallthumbnailpath = "storage/product_images/{$request->user()->id}/small_thumbnail/" . $smallthumbnail;
            $cattle->name = $request->name;
            $cattle->tag_no = $request->tag_no;
            $cattle->weight = $request->weight;
            $cattle->date_of_birth = $request->date_of_birth;
            $cattle->cattle_image = $smallthumbnailpath;
            $cattle->description = $request->description;
            $cattle->gender = $request->gender;
            $cattle->cattle_breed_id = $request->cattle_breed_id;
            $cattle->save();
            return response()->json(['message' => 'Cattle Added Successfully'], 200);
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
