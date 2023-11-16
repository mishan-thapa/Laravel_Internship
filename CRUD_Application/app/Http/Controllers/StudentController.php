<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return view('student.index', ['students' => $students]);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name'=>'required',
                'city'=>'required',
                'marks'=>'required',
            ]
        );
        $newStudent = Student::create($data);
        return redirect(route('student.index'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $student = Student::find($id);
        return view('student.edit', ['student' => $student]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name'=>'required',
                'city'=>'required',
                'marks'=>'required',
            ]
        );

        $student = Student::find($id);
        if($student){
            $student->name = $request->name;
            $student->city = $request->city;
            $student->marks = $request->marks;
            $student->save();
            return redirect(route('student.index'));
        }else{
            //asko lagi xuttai view banauna xa
        }
        
    }

    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect(route('student.index'));
    }
}
