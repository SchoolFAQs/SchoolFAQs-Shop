<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('Admin');
    }
    public function index()
    {
        //
        $categories = Category::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.category.category_list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('admin.category.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'category_name' => 'required',
            'category_description' => 'required',
            'cover_photo' => 'required|file|image|max:1999',
        ]);

        $category = new Category;
        $category->category_name = $request->input('category_name');

        // Handle file upload
        if($request->hasFile('cover_photo')){
            //Get just extenstion
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            //File Name to store
            $fileImageToStore = $category->category_name.'_category_image'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('cover_photo')->storeAs('public/category_images', $fileImageToStore);
        } else {
                $fileImageToStore = 'noimage.jpg';
        }
       
        $category->category_description = $request->input('category_description');
        $category->cover_photo = $fileImageToStore;
        $category->admin_name = Auth()->User()->name;
        $category->save();

        $activity = Activity::all()->last();
        $activity->description; 
        $activity->subject; 
        $activity->changes;
       
        return redirect(route('category.index'))->with('success', 'Category Created');
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
    public function edit($categories)
    {
        //
        $category = Category::where('slug', $categories)->first();
        return view('admin.category.category_edit', compact('category'));
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
        //
        $this->validate($request, [
            'category_name' => 'required',
            'category_description' => 'required',
            'cover_photo' => 'sometimes|file|image|max:1999',
        ]);

        $category = Category::find($id);
        $category->category_name = $request->input('category_name');

        // Handle file upload
        if($request->hasFile('cover_photo')){
            //Get just extenstion
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            //File Name to store
            $fileImageToStore = $category->category_name.'_category_image'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('cover_photo')->storeAs('public/category_images', $fileImageToStore);
        } else {
                $fileImageToStore = $category->cover_photo;
        }
       
        $category->category_description = $request->input('category_description');
        $category->cover_photo = $fileImageToStore;
        $category->admin_name = Auth()->User()->name;
        $category->save();

        $activity = Activity::all()->last();
        $activity->description; //returns 'updated'
        $activity->subject; //returns the instance of NewsItem that was created
       
        return redirect(route('category.index'))->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return redirect(route('category.index'))->with('success', 'Category Deleted');
    }
}
