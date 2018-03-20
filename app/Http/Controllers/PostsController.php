<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use App\Tag;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.post.index')->with('posts',post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Category::all();
        $tags=Tag::all();
        if($category->count()== 0 || $tags->count() == 0){
            if($category->count()==0)
            Session::flash('info','Please Add Some Category First');
            if ($tags->count()==0)
                Session::flash('info','Please Add Some Tag First');
            return redirect()->back();
        }
        return view('admin.post.create')->with('categories',$category )->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'title'=>'required',
            'category'=> 'required',
            'featured'=>'required|image',
            'post_content'=>'required|min:5',
            'tags'=>'required'
        ]);

        $featured_original_name= $request->featured->getClientOriginalName();
        $featured_new_name=time().$featured_original_name;
        $request->featured->move('uploads/posts/',$featured_new_name);
        $post=Post::create([

            'title'=>$request->title,
            'content'=>$request->post_content,
            'featured'=>$featured_new_name,
            'category_id'=>$request->category,
            'slug'=>str_slug($request->title)
        ]);
        $post->tags()->attach($request->tags);

        Session::flash('message','New Post Created Successfully!');
        return redirect()->back();
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
        $post=Post::find($id);
        return view('admin.post.edit')
            ->with('categories',Category::all())
            ->with('tags',Tag::all())
            ->with('post',$post);
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
        $this->validate($request,[

            'title'=>'required|min:3',
            'post_content'=>'required|min:5',
            'tags'=>'required',
            'category'=>'required'
        ]);
       // $post=Post::find($id);
        $post=Post::withTrashed()->where('id',$id)->first();
            if($request->featured != null)
            {

               if( File::delete('uploads/posts/'.$post->featured)){

                Session::flash('info','Old Picture has Been Deleted!');
                $featured_original_name= $request->featured->getClientOriginalName();
                $featured_new_name=time().$featured_original_name;
                $request->featured->move('uploads/posts/',$featured_new_name);
            }
            else{
                   Session::flash('warn','Post Featured not Deleted!');

                }



            }





        $post->title=$request->title;
        $post->category_id=$request->category;
        $post->content=$request->post_content;
        $post->featured=$request->featured;


        $post->tags()->sync($request->tags);


        $post->save();

        Session::flash('message','Post Succesfully Updated!');
        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();

            File::delete('uploads/posts/'.$post->featured);

            if(!file_exists('uploads/posts/'.$post->featured))
            {
                $post->tags()->detach();
                $post->forceDelete();
                Session::flash('message','Post has been Deleted Permanently!');
                return redirect()->route('post.trash');

            }
    }
    public function trashed($id){

        $post=Post::find($id);
        $post->delete();
        Session::flash('message','Post Successfully Trashed!');
        return redirect()->route('posts');

    }
    public function trashedPosts(){
        $posts=Post::onlyTrashed()->get();
         return view('admin.post.trash',['posts'=>$posts]);
    }
    public function restore($id){

        $post=Post::onlyTrashed()->where('id',$id)->first();
        $post->restore();
        Session::flash('message','Post has been Restore Successfully!');
        return redirect()->route('post.trash');


    }
}
