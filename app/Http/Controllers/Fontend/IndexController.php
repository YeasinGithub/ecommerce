<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;

class IndexController extends Controller
{
    public function index(){
    	$categories = Category::orderBy('category_name_en','ASC')->get();
    	$sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(5)->get();
    	$proudcts = Product::where('status',1)->orderBy('id','DESC')->get();
    	$featureds = Product::where('featured',1)->where('status',1)->orderBy('id','DESC')->get();
    	
    	$special_offers = Product::where('special_offer',1)->where('status',1)->orderBy('id','DESC')->get();
    	$special_deals = Product::where('special_deals',1)->where('status',1)->orderBy('id','DESC')->get();
    	$skip_category_0 = Category::skip(0)->first();
        $skip_category_1 = Category::skip(1)->first();
        $skip_category_2 = Category::skip(2)->first();
        $skip_brand_0 = Brand::skip(2)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBY('id','DESC')->get();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBY('id','DESC')->get();
        $skip_product_2 = Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBY('id','DESC')->get();
        $skip_product_brand_0 = Product::where('status',1)->where('brand_Id',$skip_brand_0->id)->orderBY('id','DESC')->get();
    	
    	return view('fontend.index', compact('categories','sliders','proudcts','featureds','special_offers','special_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_category_2','skip_product_2','skip_product_0','skip_product_brand_0','skip_brand_0'));
    }
    //product details
    public function singleProduct($product_id){
        $product = Product::findOrFail($product_id);

        $cat_id = $product->category_id;
        $relatedProducts = Product::where('category_id',$cat_id)->where('id','!=',$product_id)->orderBy('id','DESC')->get();

        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);

        $color_bn = $product->product_color_bn;
        $product_color_bn = explode(',',$color_bn);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_bn = $product->product_size_bn;
        $product_size_bn = explode(',',$size_bn);

        $multiImgs = MultiImg::where('product_id',$product_id)->get();
        $cat_id = $product->category_id;
        $relatedProducts = Product::where('category_id',$cat_id)->where('id','!=',$product_id)->orderBy('id','DESC')->get();
        

        return view('fontend.single_product',compact('product','multiImgs','product_color_en','product_color_bn','product_size_en','product_size_bn','relatedProducts'));
    }
	//tag wise product
    public function tagWiseProduct($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->orderBy('id','DESC')->paginate(1);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('fontend.tag_products',compact('products','categories'));
    }
    //subcategory wise product show
    public function subCatWiseProduct($subcat_id,$slug){
    	$products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(1);
    	$categories = Category::orderBy('category_name_en','ASC')->get();
    	return view('fontend.subcategory_product', compact('products', 'categories')); 
    }
    //sub-sub-catgory wise product show
     public function subSubCatWiseProduct($subsubcat_id,$slug){
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(1);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('fontend.sub_sub_category_product',compact('products','categories'));
    }

    // =========================== Product view with ajax================
    public function productViewAjax($product_id){
            $product = Product::with('category','brand')->findOrFail($product_id);

            $color = $product->product_color_en;
            $product_color = explode(',',$color);
            $size = $product->product_size_en;
            $produt_size = explode(',',$size);

        	return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $produt_size,
        ));

    }


}//all end
