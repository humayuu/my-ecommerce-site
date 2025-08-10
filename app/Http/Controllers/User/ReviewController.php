<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function ReviewStore(Request $request)
    {
        $product = $request->id;

        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'summary' => $request->summary,
            'rating' => $request->quality,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Review Will Approve by Admin.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function PendingReview()
    {
        $reviews = Review::where('status', 0)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.review.pending_review', compact('reviews'));
    }

    public function ReviewApprove($id)
    {
        Review::where('id', $id)
            ->update([
                'status' => 1
            ]);

        $notification = [
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function PublishReview()
    {
        $reviews = Review::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.review.publish_review', compact('reviews'));
    }

    public function ReviewDelete($id)
    {
        Review::findOrFail($id)
            ->delete();

        $notification = [
            'message' => 'Review Delete Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }
}
