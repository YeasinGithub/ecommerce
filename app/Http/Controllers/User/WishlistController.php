<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //create
    public function create(){
        return view('user.wishlist');
    }
    //all product
    public function readAllProduct(){
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);
    }

    //wishlist destroy
    public function destory($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['error' => 'remove product ok!']);
    }
}
