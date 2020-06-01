<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Categories;
use Illuminate\Http\Request;
use App\Model\Blogs;

class BlogController extends Controller
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
        return Blogs::with( 'author', 'category')->latest()->paginate(10);
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
            'title' => 'required|min:10|string|unique:blog_models',
            'category' => 'required',
            'status' => 'required|string',
            'description' => 'required|min:150'
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


        return Blogs::create([
            'title' => $request['title'],
            'slag' => $slag,
            'category' => $request['category'],
            'author' => $user->id,
            'description' => $request['description'],
            'status' => $request['status'],
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
        $post = Blogs::findOrFail($id);

        $user = auth('api')->user();

        $this->validate($request, [
            'title' => 'required|min:10|string|unique:blog_models,title,'.$post->id,
            'category' => 'required',
            'status' => 'required|string',
            'description' => 'required|min:150'
        ]);

        $title = $request['title'];
        $slag = strtolower(str_replace(' ', '-', $title));


        $post->update([
                'title' => $request['title'],
                'slag' => $slag,
                'category' => $request['category'],
                'author' => $user->id,
                'description' => $request['description'],
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
        $post = Blogs::findOrFail($id);
        $post->delete();

    }
}
