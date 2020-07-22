<div class="container shopping_cart_render">
            <div class="row shopping_cart_wrapper" data-url="{{route('cart.delete')}}">
                <div class="col-lg-12">
                    <div class="shoping__cart__table update_cart_url" data-url="{{route('cart.update')}}">

                        <table >
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php 
                            $total =0;
                            @endphp
                            
                            @foreach($carts  as $id => $cursor)
                            @php 
                            $total += $cursor['price'] * $cursor['quantity'];
                            @endphp

                                <tr>
                                    <td class="shoping__cart__item">
                                        <img width="200px" height="200px" src="{{$cursor['image']}}" alt="">
                                        <h5>{{$cursor['name']}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{number_format($cursor['price'])}} VNĐ
                                    </td>
                                    <td class="shoping__cart__quantity" data-id = "{{$id}}">
                                <div>
                                    {{-- <div class="cart_update" data-id = "{{$id}}">
                                        <span class="dec qtybtn">-</span>
                                        <input class="cart-input-box" type="number" min="1" value="{{$cursor['quantity']}}" style="width: 30px;">
                                        <span class="inc qtybtn">+</span>
                                    </div> --}}
                                           <div class="number-input">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                                            <input class="quantity" min="1" name="quantity" value="{{$cursor['quantity']}}" type="number">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                           </div>
                                </div>
                            </td>
                                    <td class="shoping__cart__total">
                                       {{number_format($cursor['price'] * $cursor['quantity'])}} VNĐ
                                    </td>
                                    <td class="shoping__cart__item__close">
                                    
                                    <a onclick="return confirm('bạn có muốn xóa sản phẩm này không')" data-id="{{$id}}" class="cart_delete">
                                        <span class="icon_close"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                               

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                
               
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>{{number_format($total)}}VNĐ</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>