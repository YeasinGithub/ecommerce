<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubsubCategory;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index(){
    	$categories = Category::latest()->get();
    	return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request){
    	$request->validate([
    		'category_name_en' => 'required',
    		'category_name_bn' => 'required',
    		'category_icon' => 'required',
    	]);
    	Category::insert([
    		'category_name_en' =>$request->category_name_en,
    		'category_name_bn' =>$request->category_name_bn,
    		'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
    		'category_slug_bn' =>str_replace(' ', '-', $request->category_name_bn),
    		'category_icon'    =>$request->category_icon,
    		'created_at'   	   =>Carbon::now(),
    	]);
    		$notification=array(
			'message'=>'New Category Inserted Successfully',
			'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);
        }

    public function edit($cat_id){
    	$editCats = Category::findOrFail($cat_id);
    	return view('admin.category.edit', compact('editCats'));
        }

    public function update(Request $request){
    	$catup_id = $request->id;
    	Category::findOrFail($catup_id)->update([
    		'category_name_en' =>$request->category_name_en,
    		'category_name_bn' =>$request->category_name_bn,
    		'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
    		'category_slug_bn' =>str_replace(' ', '-', $request->category_name_bn),
    		'category_icon'    =>$request->category_icon,
    		'created_at'   	   =>Carbon::now(),
    	]);
    		$notification=array(
			'message'=>'Category Updated Successfully',
			'alert-type'=>'success'
			);
			return Redirect()->route('category')->with($notification);
        }
    
    public function delete($catDel_id){
    		$cat = Category::findOrFail($catDel_id);
	   		Category::findOrFail($catDel_id)->delete();

	   		$notification=array(
	            'message'=>'Category Deleted Successfully',
	            'alert-type'=>'error'
	        );
	        return Redirect()->back()->with($notification);
        }
        /*------------------------Sub Category---------------------------------*/
        public function subIndex(){
            $subCategories = Subcategory::latest()->get();
            $categories = Category::orderBy('category_name_en', 'ASC')->get();
            return view('admin.subCategory.index', compact('subCategories', 'categories'));
        }
        public function Substore(Request $request){
            $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
            'category_id' => 'required',
        ],[
            'category_id.required' => 'select any category',
        ]);
        Subcategory::insert([
            'subcategory_name_en' =>$request->subcategory_name_en,
            'subcategory_name_bn' =>$request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_bn' =>str_replace(' ', '-', $request->subcategory_name_bn),
            'category_id'    =>$request->category_id,
            'created_at'       =>Carbon::now(),
        ]);
            $notification=array(
            'message'=>'Sub Category Inserted Successfully',
            'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
        public function subEdit($subCat_id){
        $editSubCats = Subcategory::findOrFail($subCat_id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.subCategory.sub_edit', compact('editSubCats', 'categories'));
        }

        public function updateSub(Request $request){
        $subCatup_id = $request->id;
        Subcategory::findOrFail($subCatup_id)->update([
            'subcategory_name_en' =>$request->subcategory_name_en,
            'subcategory_name_bn' =>$request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_slug_en)),
            'subcategory_slug_bn' =>str_replace(' ', '-', $request->subcategory_slug_bn),
            'category_id'    =>$request->category_id,
            'updated_at'       =>Carbon::now(),
        ]);
            $notification=array(
            'message'=>'Sub Category Updated Successfully',
            'alert-type'=>'success'
            );
            return Redirect()->route('sub-category')->with($notification);
        }

        public function subDelete($subCatDel_id){
            $cat = Subcategory::findOrFail($subCatDel_id);
            Subcategory::findOrFail($subCatDel_id)->delete();

            $notification=array(
                'message'=>'Sub Category Deleted Successfully',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
        /*------------------------Sub-Sub Category---------------------------------*/
        public function subsubIndex(){
            $categories = Category::orderBy('category_name_en','ASC')->get();
            $subsubcategories = SubsubCategory::latest()->get();
            return view('admin.subSubCat.index',compact('categories','subsubcategories'));
        }

        public function getSubCat($cat_id){
            $subcat = Subcategory::where('category_id',$cat_id)->orderBy('subcategory_name_en','ASC')->get();
            return json_encode($subcat);
        }

        public function subSubCategoryStore(Request $request){
            SubsubCategory::insert([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->subsubcategory_name_en,
                'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
                'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
                'subsubcategory_slug_bn' => str_replace(' ','-',$request->subsubcategory_name_bn),
                'created_at' => Carbon::now(),
               ]);

               $notification=array(
                'message'=>'Sub-Sub-Catetory Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

        public function subSubEdit($subsubcat_id){
            $subsubcat = SubsubCategory::findOrFail($subsubcat_id);
            return view('admin.subSubCat.edit',compact('subsubcat'));
        }

        public function subSubCatUpdate(Request $request){
            $subsubcat_id = $request->id;
            SubsubCategory::findOrFail($subsubcat_id)->Update([
                'subsubcategory_name_en' => $request->subsubcategory_name_en,
                'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
                'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
                'subsubcategory_slug_bn' => str_replace(' ','-',$request->subsubcategory_name_bn),
                'updated_at' => Carbon::now(),
               ]);

               $notification=array(
                'message'=>'Sub-Sub-Catetory Update Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('sub-sub-category')->with($notification);
        }

        public function subSubDelete($subsubcat_id){
            SubsubCategory::findOrFail($subsubcat_id)->delete();
            $notification=array(
            'message'=>'Sub Sub-Category Delete Successfuly',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
        }


}
