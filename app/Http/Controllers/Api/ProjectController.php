<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    // create project api
    public function createProject(Request $request)
    {
        //validation
        $request->validate([
            "name" => "required",
            "description" => "required",
            "duration" => "required",

        ]);
        //student id + create data
        $student_id = auth()->user()->id;

        // create instance of project
        $project = new Project();

        $project->student_id = $student_id;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->duration = $request->duration;

        $project->save();
        //send response

        return response()->json([
            "status" => 1,
            "message" => "Project has been created"
        ]);
    }

    //LIST PROJECT API
    public function listProject()
    {
        $student_id = auth()->user()->id;

        $projects = Project::where("student_id", $student_id)->get();

        return response()->json([
            "status" => 1,
            "message" => "Projects",
            "data" => $projects
        ]);
    }

    //SINGLE PROJECT API
    public function singleProject($id)
    {
        $student_id = auth()->user()->id;

        if (Project::where([

            "id" => $id,
            "student_id" => $student_id
        ])->exists()) {

            $details = Project::where([

                "id" => $id,
                "student_id" => $student_id
            ])->first();

            return response()->json([
                "status" => 1,
                "message" => "Project detail",
                "data" => $details
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Project not detail"
            ]);
        }
    }

    //DELETE PROJECT API
    public function deleteProject($id)
    {
        $student_id = auth()->user()->id;

        if (Project::where([
            "id" => $id,
            "student_id" => $student_id
        ])->exists()) {

            $project = Project::where([
                "id" => $id,
                "student_id" => $student_id
            ])->first();

            $project->delete();

            return response()->json([
                "status" => 1,
                "messaje" => "Project successfully deleted"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Project not found"
            ]);
        }
    }
}
