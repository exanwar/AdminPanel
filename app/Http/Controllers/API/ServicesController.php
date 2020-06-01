<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Services::with('category')->latest()->paginate(10);
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
            'title' => 'required|min:10|string|unique:services',
            'short_description' => 'required|string|min:20',
            'category' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'status' => 'required',
            'description' => 'required|string|min:20',
            'responsibilities_duties' => 'required|string|min:20',
            'required_things' => 'required|string|min:20',
        ]);

        $title = $request['title'];
        $slag = strtolower(str_replace(' ', '-', $title));

        if($request['image']){
            $imageName = substr(strtolower(str_replace(' ','', preg_replace('/[_\.]/', '', $username))), 0, 10);
            $imgExt = explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            $image = $imageName.'.'.$imgExt;
            \Image::make($request->image)->resize(300,300)->save(public_path('images/users/').$image);
        }else{
            $image = '';
        }

        return Services::create([
            'title' => $title,
            'slag' => $slag,
            'category' => $request['category'],
            'duration' => $request['duration'],
            'price' => $request['price'],
            'status' => $request['status'],
            'short_description' => $request['short_description'],
            'description' => $request['description'],
            'responsibilities_duties' => $request['responsibilities_duties'],
            'required_things' => $request['required_things'],
            'rating' => '5',
            'image' => $image

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
        $service = Services::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|min:10|string|unique:services,title,'.$service->id,
            'short_description' => 'required|string|min:20',
            'category' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'status' => 'required',
            'description' => 'required|string|min:20',
            'responsibilities_duties' => 'required|string|min:20',
            'required_things' => 'required|string|min:20',
        ]);

        $title = $request['title'];
        $slag = strtolower(str_replace(' ', '-', $title));


        $service->update([
            'title' => $title,
            'slag' => $slag,
            'category' => $request['category'],
            'duration' => $request['duration'],
            'price' => $request['price'],
            'status' => $request['status'],
            'short_description' => $request['short_description'],
            'description' => $request['description'],
            'responsibilities_duties' => $request['responsibilities_duties'],
            'required_things' => $request['required_things'],
            'rating' => '5'

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
        $service = Services::findOrFail($id);
        $service->delete();
    }
}
