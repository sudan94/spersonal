<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resume = App\Resume::all();
        return view('dashboard/resume')->with('resume', $resume);
    }
    public function allResume()
    {
        $resume = App\Resume::all();
        $i = 1;
        foreach ($resume as $res) {
            if ($res->type == 0) {
                $type = "Experiance";
            } else {
                $type = "Education";
            }
            $array[] = array(
                "id" => $i,
                "name" => $res->name,
                "started" => $res->started,
                "ended" => $res->ended,
                "institution" => $res->institution,
                "description" => $res->description,
                "type" => $type,
                "action" => "<a onclick='edit(".$res->id.")'><i class='fas fa-edit' style='color:green;'></i></a><a onclick='deleteresume(".$res->id.")'><i class='fas fa-trash' style='margin-left:15px; color:red;'></i></a>"
            );
            $i++;
        }
        $resume1 = array("data" => $array);

        return json_encode($resume1);
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
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'started' => 'required',
            'ended' => 'required',
            'institution' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);
        $resume = App\Resume::create([
            'name' => $request->name,
            'started' => $request->started,
            'ended' => $request->ended,
            'institution' => $request->institution,
            'type' => $request->type,
            'description' => $request->description
        ]);
        return back()->with('status', 'successfully inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->Id;
        $resume = App\Resume::find($id);
        return json_encode($resume);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = App\Resume::find($request->Id);
        $update->name = $request->Name;
        $update->started = $request->Started;
        $update->ended = $request->Ended;
        $update->institution = $request->Ins;
        $update->description = $request->Des;
        $update->type = $request->Type;
        $update->save();
        return "Update Sucessfull";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->Id;
        $resume = App\Resume::find($id)->delete();
        return "Delete Sucessfull";
    }
}
