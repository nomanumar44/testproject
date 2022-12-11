<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{

    private $postRepositroy;
    public function __construct(PostRepositoryInterface $postRepositroy)
    {
        $this->postRepositroy = $postRepositroy;
    }
    public function index()
    {
        $posts =$this->postRepositroy->index();
        return view('Posts.index',compact('posts'));
    }

    public function create()
    {
        return view('Posts.Create');
    }

    public function createpost(Request $request)
    {
        $data = $request->only('title','body','image');
        $this->postRepositroy->createpost($data);
        return redirect('posts')->with('status','Record is Added Successfully');
    }
    public function editpost($id)
    {
        $post = $this->postRepositroy->editpost($id);
        return view('Posts.Edit',compact('post'));
    }

    public function updatepost(Request $request , $id)
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

    public function deletepost($id)
    {
        $this->postRepositroy->deletepost($id);
        return redirect('posts')->with('status','Record is Deleted Successfully');
    }

}
