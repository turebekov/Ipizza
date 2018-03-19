<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('admin.product.create', compact('categories', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected $rule = array(
        'name' => 'required|max:255',
        'description' => 'required',
        'composition' => 'required|max:255',
        'image' => 'required',
        'price' => 'required',
        'user_id' => 'required',
        'category_id' => 'required'
    );

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rule);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }
        if (!$request->hasFile('image') && !$request->file('image')->isValid()) {
            return abort(404, 'Image not uploaded');
        }
        $filename = $this->getFileName($request->image);
        $request->image->move(base_path('public/images'), $filename);
        $product = new Product($request->all());
        $product->image = $filename;
        $product->save();

        return redirect()->action('Admin\\ProductController@index')->with('status', 'created');
    }

    protected function getFileName($file)
    {
        return str_random(32) . '.' . $file->extension();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.product.update', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), $this->rule);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }

        $product = Product::find($id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filename = $this->getFileName($request->image);
            $request->image->move(base_path('public/images'), $filename);

            File::delete(base_path('public/images/' . $product->image));
            $product->image = $filename;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->composition = $request->composition;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect()->action('Admin\\ProductController@index')->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->action('Admin\\ProductController@index')->with('status', 'deleted');
    }
}
