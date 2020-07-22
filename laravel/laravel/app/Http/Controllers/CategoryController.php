<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $kwd = $request->has('keyword')? $request->keyword:null;
        if($kwd === null){
            $categories = Category::paginate(3);

        }else{
            $categories = Category::where('cate_name','like',"%$kwd%")->paginate(3);   
            $categories->withPath("?keyword=$kwd");   
        }
        // $categories = Category::all();
        return view('back-end.cate.list',[
            'cate'=>$categories,
            'kwd'=>$kwd
            ]);
    }

    public function add(){
        return view('back-end.cate.add-form');
    }

    public function saveAdd(Request $request){
        $request->validate([
            'cate_name'=>'required|unique:categories|min:4'
        ]);

        $model = new Category();
        $model->fill($request->all());
        // $model->cate_name = $request->cate_name;
        // $model->show_menu = $request->has('show_menu') ? $request->show_menu:null;
        $model->save();
        return redirect()->route('cate.index');
    }

    public function edit($id){
        $model = Category::find($id);
        if(empty($model)){
            return redirect()->route('cate.index');
        }
        return view('back-end.cate.edit-form',[
            'model'=>$model
        ]);
    }
    public function saveEdit($id, Request $request){
        $model = Category::find($id);
        $model->fill($request->all());
        // $model->cate_name = $request->cate_name;
        // $model->show_menu = $request->has('show_menu') ? $request->show_menu:null;
        $model->save();
        return redirect()->route('cate.index');
    }

    public function delete($removeId){
        Category::destroy($removeId);
        return redirect()->route('cate.index');
  
    }

    // public function search(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $output = '';
    //         $categories = Category::where('cate_name', 'LIKE', '%' . $request->search . '%')->get();
    //         if ($categories) {
    //             foreach ($categories as $key => $cate) {
    //                 $output .= '<tr>
    //                 <td>' . $cate->id . '</td>
    //                 <td>' . $cate->cate_name . '</td>
    //                 <td>'<a href="{{route('search'}}"></a>
    //                 </tr>';
    //             }
    //         }
    //         if($output==""){
    //             $output="Không tìm thấy danh mục nào";
    //         }else{
            
    //         return Response($output);
    //     }
    //     }
    // }
}
