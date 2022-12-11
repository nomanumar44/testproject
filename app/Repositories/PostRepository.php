<?php

namespace App\Repositories;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface{
         public function index()
         {

            return  Post::paginate(10);
         }
         public function createpost($data)
         {
            $post = new Post();
            $post->title = $data['title'];
            $post->body = $data['body'];
            if($post->image){
                $file= $post->file('image');
                $filename= date('YmdHi').".".$file->getClientOriginalExtension();
                $file->move(public_path('public/Image'), $filename);
                $post['image']= $filename;
            }
            return $post->save();
         }

         public function editpost($id)
         {
           return Post::find($id);
         }

         public function deletepost($id)
         {
            $post = Post::find($id);
            $post->delete();
         }

         public function updatepost($data,$id)
         {

         }
}
?>
