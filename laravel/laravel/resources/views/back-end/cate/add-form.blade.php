@extends('layout.main');
@section('main-content')
<form action="{{route('saveAdd')}}" method="post">
@csrf
<div class="col-6">

<div class="form-group">
    <label for="">Danh danh mục</label>
    <input type="text" name="cate_name" class="form-control">
    <!-- @error('cate_name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
</div> -->


<div class="form-group">
    <label for="">ShowMenu</label>
    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-danger active">
            <input type="checkbox" name="show_menu" value="1" checked autocomplete="off">
        </label>
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