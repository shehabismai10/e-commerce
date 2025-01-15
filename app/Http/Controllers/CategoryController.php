<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


    public function create()
    {
        $categories = Category::all(); // Fetch all categories for parent selection
        return view('categories.create', data: compact('categories'));
    }
    //
    public function store(Request $request){
        // Validate the data

        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:categories,id',

            
        ]);

        //save to Category table
        $category=Category::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'image' => $request->file('image') ? $request->file('image')->store('categories', 'public') : null,
            'parent_id' => $request->parent_id,



        ]);
        return redirect()->route('categories.index')->with('success', value: 'Category added successfully!');
    } 
    
    public function index(){
        $categories=DB::table('categories')->get();
        return view('categories.index',compact('categories'));
    }

    public function edit($id){
        $category=Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    public function update(Request $request ,$id){
        //validate

        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:categories,id',

            
        ]);

        //update Category table
        $category=Category::findOrFail($id);
        $category->name=$request->input('name');
        $category->description=$request->input('description');




        if($request->hasFile('image')){
            //delete old photo if exists
            if($category->image && storage::exists('public/'.$category->image)){
                storage::delete('public' .$category->image);
            }
            $category->image=$request->file('image')->store('categories','public');
            
        }
        //category save
        $category->save();


        
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        



    }
    public function delete($id){
        //find category using id
        $category=Category::findOrFail($id);

        //delete the category
        $category->delete();

        //
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');  
        
    }
}
