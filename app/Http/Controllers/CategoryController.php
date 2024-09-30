<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        if(!$categories)
        {
            return response()->json(["Error"=>"no categories found"],404);
        } 
        return response()->json($categories, 200);
        
    }

    public function show($id)
    {
        $category= Category::find($id);
        if ($category) {
            return response()->json($category,200); 
        }else return response()->json(["Error"=>'category not found']);
    }

    public function store(StoreCategoryRequest $request) 
    {
        $validatedData = $request->validated(); 
        
        $category = new Category();
        $category->name = $validatedData["name"];
        $category->is_active = $validatedData["is_active"];
        $category->order_id = $validatedData["order_id"];
        $category->parent_id = $validatedData["parent_id"];
        $category->save();

        return response()->json(["Message" => "Category was added"], );
    }

    public function update(StoreCategoryRequest $request, $id) 
    {
        $validatedData = $request->validated(); 
        
        $category = Category::find($id);
        if ($category) {
            $category->name = $validatedData["name"];
            $category->is_active = $validatedData["is_active"];
            $category->order_id = $validatedData["order_id"];
            $category->parent_id = $validatedData["parent_id"];
            $category->save();

            return response()->json(['Message' => 'Category was updated'], );
        }

        return response()->json(['Error' => 'Category not found'], );
    }
    public function delete($id)
    {
        $category= Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(["Message"=>'category deleted'],200);
        }
       else{
        return response()->json(["Error"=>'category not found'],404);
        }
        
    }


    public function findSubcategories($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(["error" => "Parent category not found"], 404);
        }
    
        $subcategories = Category::where('parent_id', $id)->get();
    
        if ($subcategories->isEmpty()) {
            return response()->json(["error" => "Subcategories not found"], 404);
        }
    
        return response()->json($subcategories);
    }

    public function ShowTree($id=0){
        $categories= Category::where('parent_id',$id)->get();
        if ($categories->isNotEmpty()){
            echo '<ul>';
            foreach($categories as $category){
                echo '<li>' . $category->name;
                $this-> ShowTree($category->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

}