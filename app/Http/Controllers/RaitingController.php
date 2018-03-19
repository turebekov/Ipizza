<?php

namespace App\Http\Controllers;

use App\Raiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class RaitingController extends Controller
{
    protected $rule = array(
        'rating' => 'required',
        'user_id' => 'required',
        'product_id' => 'required'
    );

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rule);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }

        $rating = new Raiting($request->all());
        $rating->save();
        $product_id = $request->product_id;
        $raitings = Raiting::where('product_id', $product_id)->get();
        $score = 0;
        foreach ($raitings as $rating) {
            $rating_scores = $rating->rating;
            $score = $score + $rating_scores;
            $result = round($score / count($raitings),PHP_ROUND_HALF_UP);
        }

        return back()->with('status', 'raiting added',['result' => $result]);
    }
}
