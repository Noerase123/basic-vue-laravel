<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\StudentModel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = StudentModel::paginate(3);

        $count = $all->count();

        return response()->json([
            'data' => $all
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required',
            'studentYear' => 'required',
            'course' => 'required'
        ]);

        $stud = new StudentModel;
        $stud->name = $request->name;
        $stud->age = $request->age;
        $stud->studentYear = $request->studentYear;
        $stud->course = $request->course;
        $stud->save();

        return response()->json([
            'message' => 'student enrolled'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = StudentModel::find($id);

        if (is_null($model)) {
            return response()->json([
                'data' => 'Not Found'
            ],404);
        }
        else {
            return response()->json($model, 200);
        }
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
        $model = new StudentModel;

        $getID = $model->where('id', $id)->first();
    
        if (is_null($getID)) {
            return response()->json([
                'message' => 'Data Not Found'
            ],404);
        }

        $data = [
            'name' => $request->name,
            'age' => $request->age,
            'studentYear' => $request->studentYear,
            'course' => $request->course
        ];
        $getID->update($data);

        return response()->json([
            'message' => 'Data Updated',
            'data' => $getID
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentModel::destroy($id);

        return response()->json([
            'message' => 'Student Removed'
        ],200);
    }
}
