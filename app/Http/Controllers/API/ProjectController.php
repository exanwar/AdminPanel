<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Projects::with('category', 'customer', 'referal', 'devs')->latest()->paginate(100);
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
            'name' => 'required|string|min:5|max:100',
            'category_id' => 'required',
            'customer_id' => 'required',
            'reference_id' => 'required',
            'invoice' => 'required',
            'ammount' => 'required',
            'starting_date' => 'required',
            'deadline' => 'required',
            'status' => 'required',
            'privacy' => 'required'
        ]);

        $name = $request['name'];
        $slag = strtolower(str_replace(' ', '-', $name));

        if($request['logo']){
            $imageName = substr(strtolower(str_replace(' ','', preg_replace('/[_\.]/', '', $slag))), 0, 10);
            $imgExt = explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
            $image = $imageName.'.'.$imgExt;
            \Image::make($request->logo)->resize(300,300)->save(public_path('images/projects/logo/').$image);
            $imagePath = '/images/projects/logo/' . $image;
        }else{
            $imagePath = '';
        }

        function dateDiffInDays($date1, $date2)
        {
            // Calulating the difference in timestamps
            $diff = strtotime($date2) - strtotime($date1);

            // 1 day = 24 hours
            // 24 * 60 * 60 = 86400 seconds
            return abs(round($diff / 86400));
        }

        $date1 = $request['starting_date'];
        $date2 = $request['deadline'];

        $dateDiff = dateDiffInDays($date1, $date2);



        return Projects::create([
            'name' => $name,
            'slag' => $slag,
            'category_id' => $request['category_id'],
            'customer_id' => $request['customer_id'],
            'reference_id' => $request['reference_id'],
            'invoice' => $request['invoice'],
            'ammount' => $request['ammount'],
            'starting_date' => $request['starting_date'],
            'deadline' => $request['deadline'],
            'status' =>  $request['status'],
            'privacy' =>  $request['privacy'],
            'description' => $request['description'],
            'duration' => $dateDiff,
            'logo' => $imagePath
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slag)
    {
        return Projects::with('category', 'customer', 'referal', 'todos', 'devs')->where('slag', $slag)->get();
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
        $project = DB::table('projects')->where('project_id', $id);

        $this->validate($request, [
            'name' => 'required|string|min:5|max:100',
            'category_id' => 'required',
            'customer_id' => 'required',
            'reference_id' => 'required',
            'invoice' => 'required',
            'ammount' => 'required',
            'starting_date' => 'required',
            'deadline' => 'required',
            'status' => 'required',
            'privacy' => 'required'
        ]);

        $name = $request['name'];
        $slag = strtolower(str_replace(' ', '-', $name));


        function dateDiffInDays($date1, $date2)
        {
            // Calulating the difference in timestamps
            $diff = strtotime($date2) - strtotime($date1);

            // 1 day = 24 hours
            // 24 * 60 * 60 = 86400 seconds
            return abs(round($diff / 86400));
        }

        $date1 = $request['starting_date'];
        $date2 = $request['deadline'];

        $dateDiff = dateDiffInDays($date1, $date2);


        $project->update([
            'name' => $name,
            'slag' => $slag,
            'category_id' => $request['category_id'],
            'customer_id' => $request['customer_id'],
            'reference_id' => $request['reference_id'],
            'invoice' => $request['invoice'],
            'ammount' => $request['ammount'],
            'starting_date' => $request['starting_date'],
            'deadline' => $request['deadline'],
            'status' => $request['status'],
            'privacy' => $request['privacy'],
            'description' => $request['description'],
            'duration' => $dateDiff
        ]);

    }

    public function updateLogo(Request $request, $id)
    {
        $project = DB::table('projects')->where('project_id', $id);
        $name = DB::table('projects')->where('project_id', $id)->value('name');

        $slag = strtolower(str_replace(' ', '-', $name));

        if($request['newLogo']){
            $imageName = substr(strtolower(str_replace(' ','', preg_replace('/[_\.]/', '', $slag))), 0, 10);
            $imgExt = explode('/', explode(':', substr($request['newLogo'], 0, strpos($request['newLogo'], ';')))[1])[1];
            $image = $imageName.'.'.$imgExt;
            \Image::make($request['newLogo'])->resize(300,300)->save(public_path('images/projects/logo/').$image);
            $imagePath = '/images/projects/logo/'.$image;
        }else{
            $imagePath = '';
        }

        $project->update([
            'logo' => $imagePath
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = DB::table('projects')->where('project_id', $id);
        $project->delete();
    }
}
