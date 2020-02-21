<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Student;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Mockery\Matcher\Subset;

class StudentController extends Controller
{
    private $student;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        //dd(Student::paginate(10)->toArray());
        return $this->student->getAllStundent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        try {
            return $this->student->createStudent($request);
        } catch (ValidationException $e) {
            return $e->errors();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->student->getStudentById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return bool
     */
    public function update(Request $request,$id)
    {
        return $this->student->updateStudent($id,$request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->student->deleteStudentById($id);
    }
}

