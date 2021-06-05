<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function update_info_teacher(Request $request)
    {
        $data = $request->only("user_id", "bio", "introduce");
        $teacher = Teachers::create($data);
        return response()->json([
            "msg" => "cập nhập thông tin thành công",
            "data" => $teacher
        ]);
    }

    public function instructor_profile(Request $request)
    {
        return $request;
    }
}