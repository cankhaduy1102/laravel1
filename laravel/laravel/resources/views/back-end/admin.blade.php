
@extends('layout.main');
@section('main-content')
<form action="" method="get" class="col-6">
    <div class="form-group">
        <label for="">TÌm kiếm</label>
        <input type="text" name="keyword"  class="form-control">
    </div>
    <div class='text-center'>
        <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
    </div>
</form>
<table class="table border">
    <thead>
    <th>Mã</th>
    <th>Tên sản phẩm</th>
    <th>Ảnh sản phẩm</th>
    <th>Giá sản phẩm</th>
    <th>
            <a href="{{route('product.add')}}" class="btn btn-success btn-sm">Thêm mới</a>
        </th>
    </thead>
    <tbody>
        @foreach($products as $cursor)
        <tr>
            <td>{{$cursor->id}}</td>
            <td>{{$cursor->name}}</td>
            <td>
                <img src="{{$cursor->image}}" width="100x" alt="">
            </td>
            <td>{{$cursor->price}}</td>
            <td>
            <a href="{{route('product.edit',['id'=>$cursor->id])}}" class="btn btn-info btn-sm">Sửa</a>
            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="openConfirm('{{route('product.remove',['id'=>$cursor->id])}}')">xóa</a>
        </td>   
        </tr>
        @endforeach
    </tbody>
    </table>
    <script>
    function openConfirm(removeUrl){
        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Cảnh báo',
  text: "Bạn có chắc chắn muốn xóa danh mục này",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Đòng ý',
  cancelButtonText: 'Hủy',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      window.location.href = removeUrl;
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
    }
</script>
    <div class="row text-center">
        {{$products->links()}}
    </div>
    
@endsection