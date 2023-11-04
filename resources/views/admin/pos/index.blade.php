@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-auto col-lg-7">
            <div class="mb-2">
                <input
                    type="text"
                    class="form-control search"
                    placeholder="ค้นหาสินค้า..."
                />
            </div>
            <div class="order-product product-search" style="display: flex;column-gap: 0.5rem;flex-wrap: wrap;row-gap: 0.5rem;">
                @foreach($products as $product)
                    <button type="button"
                        class="item"
                        style="cursor: pointer; border: none; width:160px; height:160px;"
                        value="{{ $product->id }}"
                    >
                        @if($product->image)
                        <?php
                        $string = asset($product->image->getUrl());;
                        $pattern = '/localhost/';
                        $replacement = '127.0.0.1:8000';
                        $image = preg_replace($pattern, $replacement, $string);
                        //echo $foo;
                        ?>

                        <img src="{{ $image }}" width="90px" height="90px" alt="test" />
                        @endif
                        <p style="margin: 0; font-size:15px;" >{{ $product->name }}
                        <span >({{ $product->price }})</span>
                        </p>
                    </button>
                @endforeach
            </div>
        </div>
        <div class="col-md-auto col-md-5 mb-4">
            <div class="row mb-2">
                <div class="col">
                    <form class="d-flex">
                        <input
                            type="text"
                            class="form-control productCode"
                            placeholder="สแกนบาร์โค้ด..."
                        />
                        <button class="btn btn-sm rounded btn-success scan">ค้นหา</button>
                    </form>
                </div>
            </div>
            <div class="user-cart">
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                                <th class="text-right">ราคา</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="{{ route('admin.transactions.store') }}" method="post">
                @csrf 
                <div class="row mt-2">
                    <div class="col">ยอดรวม:</div>
                    <div class="col text-right">
                        <input type="number" value="" name="total" readonly class="form-control total">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">รับเงิน:</div>
                    <div class="col text-right">
                        <input type="number" value="" name="accept" class="form-control received">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col">ทอนเงิน:</div>
                    <div class="col text-right"> 
                        <input type="number" value="" name="return" readonly class="form-control return">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button
                            type="button"
                            class="btn btn-danger btn-block"
                        >
                            ยกเลิก
                        </button>
                    </div>
                    <div class="col">
                        <button
                            type="submit"
                            class="btn btn-primary btn-block"
                        >
                            ยืนยัน
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script-alt')
    <script>
         $(document).ready(function() {

                function getCarts(){
                $.ajax({
                    type: 'get',
                    url: "carts",
                    dataType: "json",
                    success: function(response) {
                        let total = 0;
                        $('tbody').html("");
                        $.each(response.carts, function(key,product) {
                            total += product.price * product.quantity                            
                            $('tbody').append(`
                            <tr>
                                <td>${product.name}</td>
                                <td class="d-flex">
                                    <select class="form-control qty">
                                    ${[...Array(product.stock).keys()].map((x) => (
                                        `<option ${product.quantity == x + 1 ? 'selected' : null} value=${x + 1}>
                                            ${x + 1}
                                        </option>`
                                    ))}
                                    </select>
                                    <input
                                        type="hidden"
                                        class="cartId"
                                        value="${product.id}"
                                        />
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm delete"
                                        value="${product.id}"
                                        
                                    >
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-right">
                                ${ product.quantity * product.price}.-
                                </td>
                            </tr>
                            `)
                        });

                        const test = $('.total').attr('value', `${total}`);
                    }
                })
            }

            getCarts()

            $(document).on('change', '.received', function() {
                const received = $(this).val();
                const total = $('.total').val();
                const subTotal = received - total;
                const change = $('.return').val(subTotal);            
            })

            $(document).on('change', '.qty', function() {
                const qty = $(this).val();
                const cartId = $(this).closest('td').find('.cartId').val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: 'put',
                    url: `carts/${cartId}`,
                    data: {
                        qty
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 400){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            })

            $(document).on('keyup', '.search', function() {
                const search = $(this).val();

                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: 'post',
                    url: `products/search`,
                    data: {
                        search
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.product-search').html("");
                        $.each(response, function(key,product) {                      
                            $('.product-search').append(`
                            <button type="button"
                                class="item"
                                style="cursor: pointer; border: none;"
                                value="${product.id}"
                            >
                                <img src="http://127.0.0.1:8000/storage/${product.image.id}/${product.image.file_name}" width="45px" height="45px" alt="test" />
                               
                                <h6 style="margin: 0;">${product.name}</h6>
                                <span >(${product.price})</span>
                            </button>
                            `)
                        });
                    }
                })
            })

            $(document).on('click', '.delete', function() {
                const cartId = $(this).val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'delete',
                    url: `carts/${cartId}`,
                    success: function(response) {
                        if(response.status === 400){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            })

            $('.scan').click(function(e) {
                e.preventDefault();
                const productCode = $(this).closest('form').find('.productCode').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: `carts`,
                    data: {
                        productCode
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 400 || response.status === 500){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            });

            $(document).on('click', '.item', function() {
                const productId = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: `carts`,
                    data: {
                        productId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 400){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })

            })
         })
    </script>
@endpush
