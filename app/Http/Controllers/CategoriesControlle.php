<?php

namespace App\Http\Controllers;
use App\Post;
use Session;
use App\Category;
use Illuminate\Http\Request;

class CategoriesControlle extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.show')->with('categories',Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name'=> 'required|min:3'
        ]);
        $category = new Category();
        $category->name= $request->name;
        $category->save();
        Session::flash('message','New Category Created Successfully!');
        return redirect()->route('categories');
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
        $category=Category::find($id);

        return view('admin.category.edit')->with('category',$category);

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

            'name'=>'required|min:3'
        ]);

        $category= category::find($id);
        $category->name=$request->name;
        $category->save();
        Session::flash('message', $category->name.' Successfully Updated!');
        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=category::find($id);
        if($this->hasPosts($category)){
            Session::flash('info','There is some Post Belongs to This Category');
            return redirect()->back();
        }
        $category->delete();
        Session::flash('message',$category->name.' Successfully Deleted!');
        return redirect()->route('categories');

    }

    public function hasPosts(Category $category){
       $posts= Post::withTrashed()->where('category_id',$category->id)->get();
       if($posts->count() >0){
           return true;

       }
       else{
           return false;
       }
    }
}
