<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $postRepositroy;
    public function __construct(PostRepositoryInterface $postRepositroy)
    {
        $this->postRepositroy = $postRepositroy;
    }
    public function index()
    {
        $posts = $this->postRepositroy->index();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Posts.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('title','body','image');
        $this->postRepositroy->createpost($data);
        return redirect('posts')->with('status','Record is Added Successfully');
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
        $post = $this->postRepositroy->editpost($id);
        return view('Posts.Edit',compact('post'));
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
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body  = $request->input('body');
        if($request->hasFile('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').".".$file->getClientOriginalExtension();
            $file->move(public_path('public/Image'), $filename);
            $post['image']= $filename;
        }
        $post->update();

        return redirect('posts')->with('status','Record is updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepositroy->deletepost($id);
        return redirect('posts')->with('status','Record is Deleted Successfully');
    }
}
