<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Blog;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.blog");
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
        $validate = $request->validate([
            'title' => 'required|unique:App\Blog,title',
            'category' => 'required',
            'description' => 'required'
        ]);
        $file = $request->file('image');
        $destinationPath = "uploads";
        $imageName = $file->getClientOriginalName();
        $file->move($destinationPath, $file->getClientOriginalName());
        $blog = App\Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'date' => Carbon::now()->format('Y-m-d'),
            'description' => $request->description,
            'status' => 1,
            'file' => $imageName
        ]);
        return back()->with('status', 'Blog sucessfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogs = App\Blog::find($id);
        return view("dashboard.single-blog")->with('blog', $blogs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = App\Blog::find($id);
        return json_encode($blog);
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
        dd($request->file('image'));
        if ($request->file('image') != NULL) {
            $file = $request->file('image');
            $destinationPath = "uploads";
            $imageName = $file->getClientOriginalName();
            $file->move($destinationPath, $file->getClientOriginalName());
            App\Blog::where('id', $request->id)->update([
                'title' => $request->title,
                'file' => $request->image,
                'category' => $request->category,
                'description' => $request->des
            ]);
        } else {
            App\Blog::where('id', $request->id)->update([
                'title' => $request->title,
                'category' => $request->category,
                'description' => $request->des
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = App\Blog::find($id)->delete($id);
        return "Delete Succesffuly";
    }
    public function allBlog()
    {
        $blog = App\Blog::all();
        $i = 1;
        foreach ($blog as $blogs) {
            if ($blogs->status == 1) {
                $status = '<div class="custom-control custom-switch">
                <input onclick=status(' . $blogs->id . ') type="checkbox" class="custom-control-input" id="customSwitch_' . $blogs->id . '" checked>
                <label class="custom-control-label" for="customSwitch_' . $blogs->id . '">Active</label>
              </div>';
            } else {
                $status = '<div class="custom-control custom-switch">
                <input onclick=status(' . $blogs->id . ') type="checkbox" class="custom-control-input" id="customSwitch_' . $blogs->id . '">
                <label class="custom-control-label" for="customSwitch_' . $blogs->id . '">Inactive</label>
              </div>';
            }
            $array[] = array(
                "no" => $i,
                "title" => $blogs->title,
                "category" => $blogs->category,
                "date" => $blogs->date,
                "status" => $status,
                "action" => "<a onclick='editBlog(" . $blogs->id . ")'><i class='fas fa-edit' style='color:green;'></i></a><a onclick='deleteBlog(" . $blogs->id . ")'><i class='fas fa-trash' style='margin-left:20px; color:red;'></i></a><a href='/blog/single/" . $blogs->id . "'><i class='fas fa-eye' style='margin-left:20px; color:blue;'></i></a>"
            );
            $i++;
        }
        $data = array("data" => $array);
        return json_encode($data);
    }

    public function status(Request $request)
    {
        $id = $request->Id;
        $blog = App\Blog::find($id);
        if ($blog->status == 1) {
            $blog->status = 0;
            $blog->save();
        } else {
            $blog->status = 1;
            $blog->save();
        }
        return "Status Changed Sucessfully";
    }
}
