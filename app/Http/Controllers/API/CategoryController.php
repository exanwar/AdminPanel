<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        return Categories::with('author')->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|min:3|string|unique:categories',
            'status' => 'required|string'
        ]);

        $name = $request['name'];
        $slag = strtolower(str_replace(' ', '-', $name));

        return Categories::create([
            'name' => $request['name'],
            'slag' => $slag,
            'author' => $user->id,
            'status' => $request['status']
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
        $category = Categories::findOrFail($id);

        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|min:4|string',
            'status' => 'required|string'
        ]);

        $name = $request['name'];
        $slag = strtolower(str_replace(' ', '-', $name));


        $category->update([
            'name' => $request['name'],
            'slag' => $slag,
            'author' => $user->id,
            'status' => $request['status']
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
        $category = Categories::findOrFail($id);
        $category->delete();
    }
}
