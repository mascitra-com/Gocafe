<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save Rating & Review
        $review = new Review($request->all());
        $review->created_by = Auth::user()->id;
        $review->save();
        // Get Average Rating
        $newRating = Review::where('item_id', $request->item_id)->avg('rating');
        $menu = Menu::find($request->item_id);
        $menu->rating = $newRating;
        $menu->reviewed = (int) $menu->reviewed + 1;
        $menu->save();
        return response()->json(['status' => 'success', 'review' => $request->all(), 'newRating' => $newRating]);
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
        //
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
    }
}
