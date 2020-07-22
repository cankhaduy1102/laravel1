@extends('layout.main');
@section('main-content')
<div class="container">
<table class="table-border">
<form action="" method="get" class="col-6">
    <div class="form-group">
        <label for="">TÌm kiếm</label>
        <input type="text" name="keyword" value="{{$kwd}}" class="form-control">
    </div>
    <div class='text-center'>
        <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
    </div>
</form>
    <table class="table border">
    <thead>
        <th>id</th>
        <th>tên danh mục</th>
        <th>
            <a href="{{route('cate.add')}}" class="btn btn-success btn-sm">Thêm mới</a>
        </th>
    </thead>
    <tbody>
    @foreach($cate as $cursor)
    <tr>
        <td>{{$cursor->id}}</td>
        <td>{{$cursor->cate_name}}</td>
        <td>
            <a href="{{route('cate.edit',['id'=>$cursor->id])}}" class="btn btn-info btn-sm">Sửa</a>
            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="openConfirm('{{route('cate.remove',['id'=>$cursor->id])}}')">xóa</a>
        </td>   
    </tr>
    @endforeach
    </tbody>
    </table>
    <div class="row text-center">
        {{$cate->links()}}
    </div>
    

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

<script type="text/javascript">
            $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    method:'GET',
                    url: "{{route('search')}}",
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</div>
</table>


@endsection