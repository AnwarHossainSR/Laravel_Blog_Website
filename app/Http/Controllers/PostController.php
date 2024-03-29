<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Spatie\MediaLibrary\InteractsWithMedia;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.post_manage',compact('posts',$posts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.post.post_add_form',compact('categories',$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required|unique:posts|max:255',
            'content' => 'required|unique:posts',
        ]);

        $post = Post::create([
            'title'=>$request->title,
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'admin_id'=>Auth()->guard('admin')->id(),
        ]);

        if ($request->hasFile('feature_image')) {
            $post->addMedia($request->feature_image)
                ->toMediaCollection('feature_image');

        }
        return redirect()->route('post.index')->with('success','Post created successfully');
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
    public function edit(Post $post)
    {
        $categories = Category::where('status',1)->get();
        return view('admin.post.post_edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title'=>$request->input('title',$post->title),
            'excerpt'=>$request->input('excerpt',$post->excerp),
            'content'=>$request->input('content',$post->content),
            'status'=>$request->input('status',$post->status),
            'category_id'=>$request->input('category_id',$post->category_id),
            'admin_id'=>Auth()->guard('admin')->id(),
        ]);

        if ($request->hasFile('feature_image')) {
            $post->media()->delete();
            $post->addMedia($request->feature_image)
                ->toMediaCollection('feature_image');
        }
        return redirect()->route('post.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Post::destroy($id);
       return back()->with('success','Post deleted successfully');
    }

    public function hide($id)
    {
        $post = Post::find($id);
        $post->status = 'Unpublish';
        $post->save();
        return back()->with('success','Post hide successfully');
    }
    public function publish($id)
    {
        $post = Post::find($id);
        $post->status =  'Publish';
        $post->save();
        return back()->with('success','Post publish successfully');
    }

    public function fileUpload(Request $request)
    {
        $orginal_name = $request->upload->getClientOriginalName();
        $filename_org = pathinfo($orginal_name,PATHINFO_FILENAME);
        $ext = $request->upload->getClientOriginalExtension();
        $fileName = $filename_org.'-'.time().'.'.$ext;
        $request->upload->move(storage_path('app/public/blog/images'),$fileName);
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/blog/images/'.$fileName);
        $message = 'Photo Uploaded successfully';
        $res = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,`$url`,`$message`)</script>";
        @header("content-type:text/html; charset:utf-8");
        echo $res;

    }
}
