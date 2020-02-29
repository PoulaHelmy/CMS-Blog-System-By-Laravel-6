<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Profile;
use Illuminate\Http\Request;
use App\Post;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkCategory')->only('create');
    }
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }
    public function store(PostRequest $request)
    {
        //dd($request->all());
        $data=$request->only(['title','description','content','image','category', 'user_id']);
        //dd($request->all());
        $post = Post::create([
            'content' =>$data['content'],
            'title' =>$data['title'],
            'description' => $data['description'],
            'image' => $data['image']->store('images','public'),
            'category_id'=>$data['category'],
            'user_id'=>$data['user_id']
        ]);
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        session()->flash('success','Post Created Successfully');
        return redirect(route('posts.index'));
    }
    public function show(Post $post)
    {
        $user = $post->user;
        $profile = $user->profile;
        return view("posts.show")->with('post',$post)->with('categories',Category::all())->with('profile',$profile)->with('user',$user);
    }
    public function edit(Post $post)
    {
        return view('posts.create',['post' => $post, 'categories' => Category::all(),'tags' => Tag::all()]);
    }
    public function update(UpdateRequest $request, Post $post)
    {
        //dd($request->get('category'));
        $data=$request->only(['title','description','content']);
        if($request->hasFile('image'))
        {
            $image=$request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $data['image']=$image;
        }
        if($request->has('category'))
        {
            $data['category_id']=$request->get('category');
        }
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
       $post->update($data);
        session()->flash('success','Post Updated Successfully');
        return redirect(route('posts.index'));
    }
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        if($post->trashed()) {
            Storage::disk('public')->delete($post->image);
            //full delete
            $post->forceDelete();
        }
        else{
            //soft delete
            $post->delete();
        }
        session()->flash('success','Post Trashed Successfully');
        return redirect(route('posts.index'));
    }
    public function trashed()
    {
        $trashed=Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }
    public function restore($id)
    {
        Post::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Post Restored Successfully');
        return redirect(route('trashed.index'));
    }


}
