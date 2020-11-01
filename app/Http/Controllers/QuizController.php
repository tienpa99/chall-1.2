<?php

namespace App\Http\Controllers;
use App\Quiz;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\DB;
use Auth;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quiz.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('quiz.create');
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
        if($request->hasFile('File')){
            $path = $request->file('File')->storeAs('public/quizzes', $request->file('File')->getClientOriginalName());
            $url = Storage::url($path);
            $data = [
                'name'=>$request->name,
                'hint'=>$request->hint,
                'path'=>$url
            ];
            Quiz::create($data);
            return redirect()->route('quizzes.index')->with('create-ok','successfully');
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
        $quiz = Quiz::find($id);
        return view('quiz.show',compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        // $quiz = Quiz::find($id);
        // echo Storage::getMetaData($quiz->);

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
        Quiz::where('id',$id)->delete();
        return redirect()->back()->with('success',"Deleted");
    }

    public function answer(Request $request, $id){
        $quizz = Quiz::find($id);
        $path = 'public/quizzes/'.$request->name.'.txt';
        if($answer = Storage::exists($path)){
            $content = Storage::get($path);
            return redirect()->back()->with('alert-suc','Correct!!!')->with('content',$content);
        }
        else{
            return redirect()->back()->with('alert-fail','Incorrect!!!');
        }
    }
}
