<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use App\Order;
use App\Raiting;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->paginate(8);

        return view('products.products', compact('products', 'categories'));
    }


    public function getCategories($id)
    {
        $categories = Category::all();
        $products = Category::find($id)->products;
        return view('products.categories', compact('products', 'categories'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->action('ProductController@index');
    }

    public function getCart()
    {
        $categories = Category::all();
        $oldCart = Session::get('cart');
        $cart = New Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        return view('products.shopping-cart', compact('products', 'totalPrice', 'categories'));
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->action('ProductController@getCart');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->action('ProductController@getCart');
    }

    public function getForget()
    {
        Session::forget('cart');
        return redirect()->route('product')->with('success', 'Korzina ochisten');
    }

    public function checkout()
    {
        $categories = Category::all();
        if (!Session::has('cart')) {
            return view('products.shopping-cart', compact('categories'));
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        return view('products.checkout')->with(compact('total', 'categories'));
    }

    public function postCheckout(Request $request)
    {
        $categories = Category::all();
        if (!Session::has('cart')) {
            return redirect()->action('ProductController@getCart', compact('categories'));
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->address;
        $order->name = $request->name;
        $order->tel = $request->tel;
        $order->total = $cart->totalPrice;

        Auth::user()->orders()->save($order);
        Session::forget('cart');
        return redirect()->route('product')->with('success', 'Successfully purchased products');

    }

    public function getProfile()
    {
        $categories = Category::all();
        $orders = Auth::user()->orders;
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', compact('orders', 'categories'));
    }

    public function show($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $comments = $product->comments()->get();

        $user = Auth::user();
        if ($user == true) {
            $orders = Auth::user()->orders;
            $orders->transform(function ($order, $key) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
            foreach ($orders as $order) {
                foreach ($order->cart->items as $item) {
                    if ($item['item']['id'] == $product->id) {
                        $purchased = true;
                    }

                }
            }
        }
        $raitings = Raiting::where('product_id', $id)->get();
        $score = 0;
        foreach ($raitings as $rating) {
            $rating_scores = $rating->rating;
            $score = $score + $rating_scores;
            $result_rating = round($score / count($raitings),PHP_ROUND_HALF_UP);
        }

        return view('products.productShow', compact('product', 'purchased', 'categories', 'user', 'result_rating', 'comments'));
    }
}
