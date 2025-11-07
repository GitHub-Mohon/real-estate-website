<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;
use App\Models\Comment;
use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
     public function index(){
        $posts = Post::orderBy('id','asc')->get();

        return view('backend.admin.posts.index',compact('posts'));
    }
    public function post_create(){
        $posts = Post::orderBy('id','asc')->get();

        return view('backend.admin.posts.create',compact('posts'));
    }

    public function post_store(Request $request){

        $request->validate([
            'title' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'featured_photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
        ]);

        $slug = Str::slug($request->title);

        $fileName = 'hero_'. time(). '.' . $request->featured_photo->extension();

            $request->featured_photo->move(public_path('uploads/posts'),$fileName);
        $postFile = 'post_'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/posts'),$postFile);

        $posts = new Post();
        $posts->title = $request->title;
        $posts->slug = $slug;
        $posts->featured_photo = $fileName;
        $posts->photo = $postFile;
        $posts->summary = $request->summary;
        $posts->description = $request->description;
        $posts->sub_title = $request->sub_title;
        $posts->sub_summary = $request->sub_summary;
        $posts->sub_li = $request->sub_li;
        $posts->tags = $request->tags;
        $posts->create_by = Auth::guard('admin')->user()->id;
        $posts->save();

        return redirect()->route('admin_post_index')->with('success','Post Created Successfully');
    }

    public function post_edit($id){

        $singlePost = Post::where('id',$id)->first();

        return view('backend.admin.posts.edit',compact('singlePost'))->with('info','Edit this Post');
    }
    public function post_update(Request $request, $id){

        $request->validate([
            'title' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'featured_photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
        ]);

        $post = Post::where('id',$id)->first();

        $slug = Str::slug($request->title);


        if($request->featured_photo){
            $request->validate([
                'featured_photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $postFile = 'hero_'. time(). '.' . $request->featured_photo->extension();

            if($post->featured_photo != ''){
                unlink(public_path('uploads/posts/'. $post->featured_photo.''));
            }
            $request->featured_photo->move(public_path('uploads/posts'),$postFile);

        }else{
            $postFile = $post->featured_photo;
        }
        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'post_'. time(). '.' . $request->photo->extension();

            if($post->photo != ''){
                unlink(public_path('uploads/posts/'. $post->photo.''));
            }
            $request->photo->move(public_path('uploads/posts'),$fileName);

        }else{
            $fileName = $post->photo;
        }

        $post->title = $request->title;
        $post->featured_photo = $postFile;
        $post->photo = $fileName;
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->sub_title = $request->sub_title;
        $post->sub_summary = $request->sub_summary;
        $post->sub_li = $request->sub_li;
        $post->tags = $request->tags;
        $post->update();

        return redirect()->route('admin_post_index')->with('success','Post Updated Successfully');
    }
    public function post_destroy( $id){
        $post = Post::where('id',$id)->first();

        if($post->featured_photo != ''){
                unlink(public_path('uploads/posts/'. $post->featured_photo.''));
            }
        if($post->photo != ''){
                unlink(public_path('uploads/posts/'. $post->photo.''));
            }

        if($post){
            $post->delete();

        $comments = null;
        $comments = Comment::orderBy('id','asc')->where('post_id',$post->id)->get();
        $comments_ids = $comments->pluck('id');

        $reply_comment = null;
        $reply_comment = ReplyComment::orderBy('id','asc')->whereIn('comment_id',$comments_ids)->where('post_id',$post->id)->get();

        if($comments){
            foreach($comments as $comment){
                $comment->delete();
            }
        }
        if($reply_comment){
            foreach($reply_comment as $item){
                $item->delete();
            }
        }

        return redirect()->route('admin_post_index')->with('error','Post Deleted Successfully');
        }else{
            return redirect()->route('admin_post_index')->with('info','Post not Found');
        }
    }
}
