@extends('layout.frontend')

@section('content')
@php
    $totalPoints = 0;
    $subtotal = 0;
    $tax = 11;
    $tax_amount = 0;
    $total = 0;

    // Fetch user points
    $userPoints = Auth::user()->poin ?? 0;

    if (session('cart')) {
        foreach (session('cart') as $item) {
            $typeName = isset($item['product']) ? $item['product']->type->name : null;
            if ($typeName == 'deluxe' || $typeName == 'superior' || $typeName == 'suite') {
                $totalPoints += 5 * $item['quantity'];
            } else {
                $totalPoints += floor($item['quantity'] * $item['price'] / 300000);
            }
            $subtotal += $item['quantity'] * $item['price'];
        }

        $tax_amount = $subtotal * ($tax/100);
        $total = $subtotal + $tax_amount;
    }
@endphp

<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Total Points Earned: {{ $userPoints }}</h2> <!-- Display total points user has already earned -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @if(session('cart'))
                                    @foreach (session('cart') as $item)
                                    <tr>
                                        <td>
                                            <div class="img">
                                                @if (!empty($item['photo']))
                                                    <a href="#"><img src="{{ asset('images/'.$item['photo']) }}" alt="Image"></a>
                                                @else
                                                    <a href="#"><img src="{{ asset('images/blank.jpg') }}" alt="Image"></a>
                                                @endif
                                                <p>{{ $item['name'] }}</p>
                                            </div>
                                        </td> 
                                        <td>{{ 'IDR '.$item['price'] }}</td>
                                        <td>
                                            <div class="qty">
                                                <button onclick="redQty({{ $item['id'] }})" class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $item['quantity'] }}">
                                                <button onclick="addQty({{ $item['id'] }})" class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>{{ 'IDR '.$item['quantity'] * $item['price'] }}</td>
                                        <td><a class="btn btn-danger" href="{{ route('delFromCart', $item['id']) }}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    @endforeach    
                                @else
                                <tr>
                                    <td colspan="5"><p>Tidak ada item di cart.</p></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon">
                                <input type="text" placeholder="Coupon Code">
                                <button>Apply Code</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>                          
                                    <h2>Sub Total<span id="subtotal">{{ 'IDR '.$subtotal }}</span></h2>
                                    <h2>Tax<span id="taxAmount">{{ 'IDR '.$tax_amount }}</span></h2>
                                    <h2>Grand Total<span id="grandTotal">{{ 'IDR '.$total }}</span></h2>
                                    <h2>Total Points (Cart)<span id="totalPoints">{{ $totalPoints }}</span></h2>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="usePointsCheckbox">
                                        <label class="form-check-label" for="usePointsCheckbox">
                                            Use Points for Discount
                                        </label>
                                    </div>
                                    <div id="pointsDiscountSection" style="display: none;">
                                        <h2>Points Used<span id="pointsUsed"></span></h2>
                                        <h2>Price After Points<span id="priceAfterPoints"></span></h2>
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex justify-content-between cart-btn">
                                    <a class="btn btn-xs" href="{{ route('laralux.index') }}">Continue Shopping</button>
                                    <a class="btn btn-xs" href="{{ route('checkout') }}">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#usePointsCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    var total = {{ $total }};
                    var points = {{ $userPoints }};
                    var pointsValue = 100000;

                    if (points > 0) {
                        var maxPointsToUse = Math.floor(total / pointsValue);
                        var pointsToUse = Math.min(points, maxPointsToUse);
                        var pointsUsedValue = pointsToUse * pointsValue;

                        $('#pointsUsed').text(' - IDR ' + pointsUsedValue);
                        $('#priceAfterPoints').text('IDR ' + (total - pointsUsedValue));
                        $('#pointsDiscountSection').show();
                    } else {
                        $('#pointsDiscountSection').hide();
                    }
                } else {
                    $('#pointsDiscountSection').hide();
                }
            });
        });

        function redQty(id) {
            $.ajax({
                type:'POST',
                url:'{{ route("redQty") }}',
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id': id
                },
                success: function(data){
                    location.reload();
                }
            });
        }    

        function addQty(id) {
            $.ajax({
                type:'POST',
                url:'{{ route("addQty") }}',
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id': id
                },
                success: function(data){
                    location.reload();
                }
            });
        }
    </script>
@endsection
