<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function index(){
    	$brands = Brand::latest()->get();
    	return view('admin.brand.index', compact('brands'));
    }
    public function store(Request $request){
    	$request->validate([
    		'brand_name_en' => 'required',
	    	'brand_name_bn' => 'required',
	    	'brand_image' => 'required',
    	],[
    		'brand_name_en.required' => 'input brand english name',
    		'brand_name_bn.required' => 'input brand bangla name'
    	]);

	    	$image = $request->file('brand_image');
	        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
	        Image::make($image)->resize(166,110)->save('upload/brand/'.$name_gen);
	        $save_url = 'upload/brand/'.$name_gen;

	        Brand::insert([
	        	'brand_name_en' => $request->brand_name_en, 
	        	'brand_name_bn' => $request->brand_name_bn, 
	        	'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
	        	'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
	        	'brand_image'   => $save_url,
	        	'created_at'	=>Carbon::now(),
	        ]);
	        $notification=array(
			'message'=>'New Brand Inserted Successfully',
			'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);	
    	}

    	public function edit($brand_id){
    		$edits = Brand::findOrFail($brand_id);
    		return view('admin.brand.edit', compact('edits'));
    	}
    	public function brandUpdate(Request $request){
	       $brand_id = $request->id;
	       $old_img = $request->old_image;

	       if ($request->file('brand_image')) {
	           unlink($old_img);
	            $image = $request->file('brand_image');
	            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
	            Image::make($image)->resize(166,110)->save('upload/brand/'.$name_gen);
	            $save_url = 'upload/brand/'.$name_gen;

	            Brand::findOrFail($brand_id)->update([
	                'brand_name_en' => $request->brand_name_en,
	                'brand_name_bn' => $request->brand_name_bn,
	                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
	                'brand_slug_bn' => str_replace(' ','-',$request->brand_name_bn),
	                'brand_image' => $save_url,
	                'created_at' => Carbon::now(),
	            ]);

	            $notification=array(
	                'message'=>'Brand Update Success',
	                'alert-type'=>'success'
	            );
	            return Redirect()->route('brand')->with($notification);
	       }else {
	        Brand::findOrFail($brand_id)->update([
	            'brand_name_en' => $request->brand_name_en,
	            'brand_name_bn' => $request->brand_name_bn,
	            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
	            'brand_slug_bn' => str_replace(' ','-',$request->brand_name_bn),
	            'created_at' => Carbon::now(),
	        ]);

	        $notification=array(
	            'message'=>'Brand Update Success',
	            'alert-type'=>'success'
	        );
	        return Redirect()->route('brand')->with($notification);
	       }

	   }

	   public function delete($brand_id){
	   		$brand = Brand::findOrFail($brand_id);
	   		$imgId = $brand->brand_image;
	   		unlink($imgId);
	   		Brand::findOrFail($brand_id)->delete();

	   		$notification=array(
	            'message'=>'Brand Deleted Successfully',
	            'alert-type'=>'success'
	        );
	        return Redirect()->back()->with($notification);
	   }


}
