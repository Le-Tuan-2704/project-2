<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Instructor;
use App\Models\Teachers;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_courses = Courses::all();
        foreach ($data_courses as $courses) {
            $instructors = Instructor::where("id_courses", $courses->id)->get();
            $teachers = array();
            foreach ($instructors as $instructor) {
                $teacher = Teachers::where("user_id", $instructor->id_teacher)->first();
                array_push($teachers, $teacher);
            }
            $courses["instructor"] = $teachers;
        }

        return response()->json([
            "data" => $data_courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_courses = $request->only("title", "introduce", "price", "thumbnail", "times");
        $courses = Courses::create($new_courses);
        $new_instructor = [
            "id_courses" => $courses->id,
            "id_teacher" => $request->user_id
        ];
        $instructor = Instructor::create($new_instructor);
        $teacher = Teachers::where("user_id", $request->user_id)->first();
        return response()->json([
            "msg" => "tạo khóa học thành công",
            "courses" => $courses,
            "instructor" => $teacher
        ]);
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