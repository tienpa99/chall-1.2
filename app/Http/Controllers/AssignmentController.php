<?php

namespace App\Http\Controllers;
use App\Assignment;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\DB;
use Auth;
class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = Assignment::all();
        return view('assignment.assignment', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('assignment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        if($request->hasFile('File')){
            $path = $request->file('File')->store('public/docs');
            $url = Storage::url($path);
            // $url = $_SERVER['HTTP_HOST'].$getFileUrl;
        }
        else{
            $url = '';
        }
        $data = [
            'name'=>$request->name,
            'content'=>$request->content,
            'path'=>$url
        ];
        Assignment::create($data);
        return redirect()->route('assignments.index')->with('create-ok','successfully');
        // $path = $request->file('File')->store('public/docs');
        // echo $url = Storage::url($path);
        // echo $_SERVER['HTTP_HOST'];
        
        // $data = [

        // ];
        // dd($request);

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
        $assignment = Assignment::find($id);
        if(Auth::user()->role == 'teacher'){
            $submits = DB::table('done_assignment')->select('id','user','path')->where('id',(string)$id)->get();
        }
        if(Auth::user()->role == 'student'){
            $submits = DB::table('done_assignment')->select('id','user','path')->where('id',(string)$id)->where('user',Auth::user()->username)->get();
        }
        // dd($assignment);
        return view('assignment.show',compact('assignment','submits'));
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
        $assignment = Assignment::find($id);
        return view('assignment.edit', compact('assignment'));
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
        if($request->hasFile('File')){
            $path = $request->file('File')->store('public/docs');
            $url = Storage::url($path);
            Storage::delete(Assignment::find($id)->path);
            // $url = $_SERVER['HTTP_HOST'].$getFileUrl;
        }
        else{

            $url = Assignment::find($id)->path;
        }
        $data = [
            'name'=>$request->name,
            'content'=>$request->content,
            'path'=>$url
        ];
        Assignment::where('id',$id)->update($data);
        return redirect()->route('assignments.index')->with('edit-ok','successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Assignment::where('id',$id)->delete();
        return redirect()->route('assignments.index')->with('success',"Deleted");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentSubmit(Request $request, $id){
        if($request->hasFile('FileSend')){            
            $path = $request->file('FileSend')->store('public/studentSubmit');
            $url = Storage::url($path);
            $data = [
                'id'=>$id,
                'user'=>Auth::user()->username,
                'path'=>$url
            ];
            DB::table('done_assignment')->insert($data);
            return redirect()->back()->with('submit-ok','submit successfully!!!');
        }
        else{
            return redirect()->back()->with('erorr-file','Yout must choose file to submit');
        }        
    }
}
