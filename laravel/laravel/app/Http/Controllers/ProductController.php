<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function admin(Request $request){
        $kwd = $request->has('keyword')? $request->keyword:null;
        if($kwd === null){
            $products=Product::paginate(3);
        }else{
            $products = Product::where('name','like',"%$kwd%")->paginate(3);   
            $products->withPath("?keyword=$kwd");   
        }
        //lấy data
        // $products = Product::all();
        // truyền dữ liệu ra màn hình
        return view('back-end.admin', [
            'products'=>$products,
            'kwd'=>$kwd
            ]);
    }
    public function delete(Request $request){
        $id = $request->id;
        $delete = Product::find($id)->delete();
        return redirect()->back();
  
    }
    public function addProduct(){
        $cates = Category::all();
        return view('back-end.product.add-form',[
            'cates' => $cates
        ]);
    }

    public function saveProduct(Request $request){
        $request->validate([
            'name' => 'required|unique:products|min:4',
            'price' => 'required|min:4',
            'short_desc' => 'required|min:10',
            'star' => 'required',
            'view' => 'required',
            'detail' => 'required|:min:10'


        ],[
            'name.required' => "hãy nhập tên sản phẩm",
            'name.unique' => "tên sản phẩm đã tồn tại",
            'name.min' => "nhập trên 4 ký tự",
            'price.required' => "Hãy nhập giá sản phẩm",
            'price.min' => "nhập trên 3 ký tự",
            'short_desc.required' => "Nhập mô tả ngắn",
            'short_desc.min' => "nhập trên 10 ký tự",
            'star.required' => "Hãy nhập đánh giá",
            'view.required' => "Hãy nhập lượt view sản phẩm",
            'detail.required' => "Hãy nhập mô tả chi tiết",
            'detail.min' => "nhập trên 10 ký tự"    
        ]);
        $request = $_POST;
        $imgFile = $_FILES['image'];
        $model = new Product();
        $model->fill($request);
        $filename = "";
        // // nếu có ảnh up lên thì lưu ảnh
        if ($imgFile['size'] > 0) {
            $filename = uniqid() . '-' . $imgFile['name'];
            move_uploaded_file($imgFile['tmp_name'], '../public/uploads/' . $filename);
            $filename = '/'.'uploads/' . $filename;
        }
        $model->image = $filename;
        $model->save();
       return redirect()->route('admin');
        
    }

    public function editForm(Request $request){
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        if(!$request){
            return redirect()->route('admin');

        }
        // kiểm tra xem id có thật hay không
        $model = Product::find($request);
        
        if(!$model){
           return redirect()->route('admin');
        }
        
        $cates = Category::all();
        return view('back-end.product.edit-form', [
                                                'cates' => $cates,
                                                'model' => $model
                                            ]);
    
    }

    public function saveEdit(Request $request){
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        
        if(!$request){
            return redirect()->route('admin','msg=Không Đủ Thông Tin Để Update');
            die;
        }

        $model = Product::find($request);
       $msg="";
        if(!$model){
            return redirect()->route('admin','msg= ID Không Tồn Tại');
            die;
        }

    
        $imgFile = $_FILES['image'];
        $model->fill($request);
        $filename = $model->image;

        if ($imgFile['size'] > 0) {
            $filename = uniqid() . '-' . $imgFile['name'];
            move_uploaded_file($imgFile['tmp_name'], '../public/uploads/' . $filename);
            $filename = '/'. 'uploads/' . $filename;
        }
        $model->image = $filename;
        $model->save();
        return redirect()->route('admin','msg= Sửa Sản Phẩm Thành Công');
    
    }

}
