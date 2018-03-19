<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{

    protected $rule = array(
        'text' => 'required',
        'user_id' => 'required',
        'product_id' => 'required'
    );
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rule);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }
        $comment = new Comment($request->all());

        $comment->save();

        return back()->with('status','comment added');




    }
}
