<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Function for Return View
    public function ViewWishList()
    {
        return view('frontend.wishlist.view_wishlist');
    }

    // Function for Get wishlist
    public function GetWishlistProduct()
    {
        $wishlist = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json($wishlist);
    }

    // Function for Remove Wishlist
    public function RemoveWishlistProduct($id){

        Wishlist::where('user_id',Auth::id())
        ->where('id',$id)
        ->delete();
        return response()->json(['success' => 'Successfully Product Remove']);
    }
}
