<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DevDept;
use Illuminate\Support\Facades\DB;

class DevDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DevDept::with('dev')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project_id = DB::table('projects')->where('slag', $request['project_slag'])->value('project_id');

        return DevDept::create([
            'project_id' => $project_id,
            'dev_id' => $request['id'],
            'dev_username' => $request['username'],
            'dev_name' => $request['name'],
            'dev_email' => $request['email'],
            'dev_type' => $request['devType'],
            'dev_image' => $request['image'],
            'group' => $request['group'],
            'tasks' => 0
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
        $define_dev = DevDept::findOrFail($id);

        $define_dev->delete();
    }
}
