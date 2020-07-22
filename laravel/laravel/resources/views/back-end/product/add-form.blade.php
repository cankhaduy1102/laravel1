
@extends('layout.main');
@section('main-content')
        
        {{-- query string --}}
        {{-- form data --}}
        <h3>Tạo mới sản phẩm</h3>
        <form action="{{route('product.saveAdd')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="cate_id" class="form-control">
                            @foreach ($cates as $ca)
                            <option value="{{$ca->id}}">{{$ca->cate_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="number" name="price" class="form-control">
                        @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả ngắn</label>
                        <textarea name="short_desc" class="form-control" rows="4"></textarea>
                        @error('short_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control">   
                    </div>
                    <div class="form-group">
                        <label for="">Đánh giá</label>
                        <input type="number" step="0.1" name="star" class="form-control">
                        @error('star')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Lượt xem</label>
                        <input type="number" name="views" class="form-control">
                        @error('view')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Chi tiết</label>
                        <textarea name="detail" class="form-control" rows="6"></textarea>
                        @error('detail')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
                </div>
                <div class=" col-12 text-center">
                    <button type="submit" class="btn btn-info">Lưu</button>
                    <a href="./" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>
        @endsection
 
    
    
