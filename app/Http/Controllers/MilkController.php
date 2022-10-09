<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Milk;
use Illuminate\Support\Facades\Notification;

class MilkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Milk::with('cattle.breed')->get()], 200);
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
            'milking_date' => 'required',
            'total_milk' => 'required',
            'description' => 'required',
            'cattle_id' => 'required',
        ]);
        if (!$validator->fails()) {
            $milk = new Milk();
            $milk->milking_date = $request->milking_date;
            $milk->total_milk = $request->total_milk;
            $milk->description = $request->description;
            $milk->cattle_id = $request->cattle_id;
            $milk->save();
            Notification::route('mail', env('MANAGER_EMAIL'))->notify(new \App\Notifications\NewRecordNotification("New Milk Record", "A milk record has been added by farm manager", "Please Login to the application for details"));
            return response()->json(['message' => 'Milk Added Successfully'], 200);
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
