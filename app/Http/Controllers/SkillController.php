<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.skill');
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

        $validavalidatedDatate = $request->validate([
            "skill" => 'required|unique:App\Skill,name',
            "Percentage" => 'required|digits_between:1,100'
        ]);
        $skill = App\Skill::create([
            'name' => $request->skill,
            'percentage' => $request->Percentage,
            'status' => 1
        ]);
        return back()->with("status", "Skill Added sucessfully");
    }

    public function allSkills()
    {

        $skills = App\Skill::all();
        $i = 1;
        foreach ($skills as $skill) {
            if ($skill->status == 1) {
                $status = '<div class="custom-control custom-switch">
                <input onclick=status(' . $skill->id . ') type="checkbox" class="custom-control-input" id="customSwitch_' . $skill->id . '" checked>
                <label class="custom-control-label" for="customSwitch_' . $skill->id . '">Active</label>
              </div>';
            } else {
                $status = '<div class="custom-control custom-switch">
                <input onclick=status(' . $skill->id . ') type="checkbox" class="custom-control-input" id="customSwitch_' . $skill->id . '">
                <label class="custom-control-label" for="customSwitch_' . $skill->id . '">Inactive</label>
              </div>';
            }
            $skillArray[] = array(
                "no" => $i,
                "name" => $skill->name,
                "percentage" => $skill->percentage,
                "status" => $status,
                "action" => "<a onclick='editSkill(" . $skill->id . ")'><i class='fas fa-edit' style='color:green;'></i></a><a onclick='deleteSkill(" . $skill->id . ")'><i class='fas fa-trash' style='margin-left:20px; color:red;'></i></a>"
            );
            $i++;
        }
        $data = array("data" => $skillArray);
        return json_encode($data);
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
        $skill = App\Skill::find($id);
        return json_encode($skill);
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
        App\Skill::where('id',$request->Id)->update([
            'name' => $request->Name,
            'percentage' => $request->per
        ]);
        return "Skill Successfully updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->skillId;
        $skill = App\Skill::find($id)->delete();
        return "Delete Sucessfull";
    }

    public function status(Request $request)
    {
        $id = $request->skillId;
        $skill = App\Skill::find($id);
        if ($skill->status == 1) {
            $skill->status = 0;
            $skill->save();
        } else {
            $skill->status = 1;
            $skill->save();
        }
        return "Status Changed Sucessfully";
    }
}
