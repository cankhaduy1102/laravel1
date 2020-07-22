<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Cookie; 

class HomeController extends Controller
{
    public function index(){
        
        return view('home');
    }
    public function blog(){
        return view('front-end.blog');
    }
    public function blogDetail(){
        return view('front-end.blog-details');
    }
    public function checkout(){
        return view('front-end.checkout');
    }
    public function contact(){
        return view('front-end.contact');
    }
    public function main(){
        return view('front-end.main');
    }
    public function shopDetail(Request $request){
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        if(!$request){
            return redirect()->route('/');

        }
        // kiểm tra xem id có thật hay không
        $cates = Category::all();
        $model = Product::find($request);
        $related = Product::where('cate_id','=', $model->cate_id)->get();
        if(!$model){
           return redirect()->route('/');
        }
        
        
        return view('front-end.shop-details', [
                                                'cates' => $cates,
                                                'list'=>$related,
                                                'model' => $model
                                            ]);
    }
    public function shopGird(Request $request){
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        if(!$request){
            return redirect()->route('/');

        }
        $cates = Category::find($request);
        $msg="";
         if(!$cates){
             return redirect()->route('/');
             die;
         }
         $product = Product::all();
         $model = Product::where('cate_id','=',$request)->get(); 
         
       return view('front-end.shop-gird',[
           
           'model' =>$model,
           'pro' => $product
       ]);
    }
    public function shoppingCart(){
        $carts = json_decode(cookie::get('cartId'),true);
        return view('front-end.shopping-cart', compact('carts'));

        
    }

    public function search(Request $request){
        if($request->ajax()){
        if(isset($request->search)){
        $output="";
        $products=Product::where('name','LIKE','%'.$request->search."%")->get();
        if($products){
        foreach ($products as $key => $product) {
        $output.='<div>'.
        '<br>'.
        '<h3><a href="shop-details?id='.$product->id.'" class="nav-link text-success">'.$product->name.'</a></h3>'.
        '</div>';
        }
        
        return Response($output);
        }
        }
        $output=null;
}

}

    Public function addToCart($id){
            $products = Product::find($id);
            
            $cookie = Cookie::get('cartId');
            
            $cart = json_decode($cookie,true);

            if (isset($cart[$id])){
                $cart[$id]['quantity'] =   $cart[$id]['quantity'] + 1;
            } else {
            $cart[$id] = [
                'id' => $products->id,
                'name' => $products->name,
                'price' => $products->price,
                'image' => $products->image,
                'quantity' => 1
            ];
            }   
                $array_json = json_encode($cart);
                Cookie::queue('cartId', $array_json);   
                
}
    public function remove(Request $request)
    {
        if($request->id){
            $carts =  json_decode(Cookie::get('cartId'), true);
            
            unset($carts[$request->id]);
            $array_json = json_encode($carts);
            
            Cookie::queue('cartId', $array_json);
            // echo "<pre>";
            // print_r($array_json);die;
            $cart_components = view('layout.components.cart-components', compact('carts'))->render();
            
            return response()->json([
                'cart_components' => $cart_components,
                'code' => 200
            ],200);
        }
    }

    Public function wishList($id){
        $products = Product::find($id);
        
        $cookie = Cookie::get('cartId');
        
        $list = json_decode($cookie,true);

        if (isset($list[$id])){
            
        } else {
        $list[$id] = [
            'id' => $products->id,
            'name' => $products->name,
            
            'image' => $products->image,
            
        ];
        }   
            $array_json = json_encode($list);
            Cookie::queue('cartId', $array_json);   
            echo "<pre>";
            print_r($list);
}

    public function update(Request $request){
       if($request->id && $request->quantity){
           $cookie = Cookie::get('cartId');
           $items = json_decode($cookie,true);
           $cate = Category::all();
           $items[$request->id]['quantity']= $request->quantity;
           $array_json = json_encode($items);
            Cookie::queue('cartId', $array_json);
           $cartComponent = view('layout.components.cart-components',[
               'carts' =>$items,
               'cates' =>$cate
           ])->render();
            return response()->json(['cartComponent'=>$cartComponent,'code'=>200],200);
       }
        
        
    }


}