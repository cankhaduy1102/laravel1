@extends('layout.main');
@section('main-content')
<h1 class="mt-4">Sửa Danh Mục</h1>
<form action="{{route('cate.edit',['id'=>$model->id])}}" method="post">
@csrf
<div class="row">
            <div class="col-6">

                <div class="form-group">
                    <label for="">Danh danh mục</label>
                    <input type="text" name="cate_name" class="form-control" value="{{$model->cate_name}}">
                </div>
               
                <div class="form-group">
                    <label for="">ShowMenu</label>
                    <div class="btn-group" data-toggle="buttons">
                        
                            <input type="checkbox" value="1" name="show_menu" @if($model->show_menu==1) checked @endif>
                       
                </div>
                
            </div>

            <div class=" col-12 ">
                <button type="submit" class="btn btn-info">Lưu</button>
                <a href="" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </div>
</form>
@endsection