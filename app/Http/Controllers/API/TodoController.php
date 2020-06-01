<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\DevDept;
use App\Model\Projects;
use App\Model\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::with('project')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project_slag = $request['project_slag'];

        $project_id = DB::table('projects')->where('slag', $project_slag)->value('project_id');

        $this->validate($request, [
           'todo' => 'required| min:3|max:52'
        ]);

        return Todo::create([
           'todo' => $request['todo'],
           'project_id' => $project_id,
            'category' => $request['category'],
            'status' => 'undo'
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
        $todo = Todo::findOrFail($id);

        $this->validate($request, [
            'todo' => 'required| min:3|max:52'
        ]);

        $todo->update([
            'todo' => $request['todo']
        ]);
    }

    public function undo(Request $request, $id)
    {
        $project_id = DB::table('projects')->where('slag', $request['slag'])->value('project_id');
        $todo = Todo::findOrFail($id);
        $todoDoneBy = DB::table('todos')->where([
            ['project_id', '=', $project_id],
            ['id', '=', $id]
        ])->value('done_by');

        $update['todo'] =$todo->update([
            'status' => 'undo',
            'done_by' => null
        ]);

        $taskDoneByThisDev = DB::table('dev_depts')->where([
            ['project_id', '=', $project_id],
            ['dev_id', '=', $todoDoneBy]
        ])->value('tasks');

        $update['dev_dept'] = DB::table('dev_depts')
            ->where('dev_id', $todoDoneBy)
            ->update(['tasks' => $taskDoneByThisDev-1])
        ;

        return $update;
    }

    public function do(Request $request, $id)
    {
        $user = auth('api')->user();
        $project_id = DB::table('projects')->where('slag', $request['slag'])->value('project_id');
        $taskDoneByThisDev = DB::table('dev_depts')->where([
            ['project_id', '=', $project_id],
            ['dev_id', '=', $user->id]
        ])->value('tasks');
        $dev = DB::table('dev_depts')->where([
            ['project_id', '=', $project_id],
            ['dev_id', '=', $user->id]
        ])->value('id');

        $todo = Todo::findOrFail($id);

        $update['todo'] = $todo->update([
            'status' => 'done',
            'done_by' => $user->id,
        ]);

        $update['dev_dept'] = DB::table('dev_depts')
            ->where('id', $dev)
            ->update(['tasks' => $taskDoneByThisDev+1])
        ;

        return $update;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
    }
}
