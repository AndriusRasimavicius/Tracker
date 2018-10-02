<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Validator;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addProjects');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
        ],
            [
                'title.required' => 'Nebuk molis, irasyk pavadinima'
            ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $project = New Project();
        $project->title  = $request->title;
        $project->user_id = Auth()->user()->id;
        $project->save();

        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('editProjects', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
        ],
            [
                'title.required' => 'Nebuk molis, irasyk pavadinima'
            ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $project->title=$request->title;
        $project->save();
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
