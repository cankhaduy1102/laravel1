   <!-- Js Plugins -->
   <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script>
function addToCart(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
    type : "GET",
    url : urlCart,
    success: function(data){
     if (data.code === 200) {
         alert('Thêm sản phẩm thành công')
     }
    },
    });
}
 $(function () {
     $('.add_to_cart').on('click', addToCart);
 });
</script>
<script type="text/javascript">
    //chọn id="search" và gán sự kiện
        $('#search').on('keyup',function(){
            $value=$(this).val();   //nhận dữ liệu từ input
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value},
                success:function(data){
                $('#tsearch').html(data);
                }
        });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>