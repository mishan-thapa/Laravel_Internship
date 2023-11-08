<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index(){
        $students = DB::table('students')->get();
        return view('home',['students'=>$students]);
    }

    public function create(Request $request){
        DB::table('students')->insert([
            'name'=> $request->name,
            'faculty'=>$request->faculty,
            'grade'=>$request->grade,
        ]);
        return redirect(route('index'))->with('status','students added!');
    }

    public function edit_form($id){
        $student = DB::table('students')->find($id);
        return view('edit_form',['student'=>$student]);
    }

    public function update(Request $request, $id){
        DB::table('students')->where('id',$id)->update([
            'name'=> $request->name,
            'faculty'=>$request->faculty,
            'grade'=>$request->grade,
        ]);
        return redirect(route('index'))->with('status','one record updated!');
    }

    public function destroy($id){
        DB::table('students')->where('id',$id)->delete();
        return redirect(route('index'))->with('status','one record deleted');
    }
}
