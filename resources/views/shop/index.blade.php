@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Shop</div>

                <div class="panel-body">
                    Hello, this is your Shop
                    You are logged in!
                
                </div>

                <div class="panel-body">
                    
                    @foreach($all_items as $item)
                        
                    <form action='{{ url("shop") }}' method="POST">
                                                
                        Name : {{ $item->name}}        <br>
                        Stock : {{ $item->qty}}         <br>
                        Price : {{ $item->price}}       <br>
                        
                        
                        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$item->id}}">
                        
                        Quantity:
                        <input type="number" name="qty" min="1" max="{{$item->qty}}" value="1">
                        <br>    
                        <input type="submit" value="Add {{$item->name}} to cart">
                
                    </form>
                    <hr>
                    @endforeach
                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Cart</div>

                <div class="panel-body">

                <?php
                    $total = 0
                ?>

                    @foreach($cart as $item_id=>$qty)
                        @foreach($all_items as $item)
                            @if($item->id == $item_id)
                                {{$item->name}} has qty of {{$qty}}
                                SUBTOTAL = {{$qty * $item->price}}
                                <?php
                                    $total+= $qty * $item->price
                                ?>
                                @break
                            @endif
                        @endforeach    
                        <a href="{{url('shop/remove/'.$item_id)}}">Remove from cart</a>
                        <br>
                    @endforeach

                    TOTAL BILL: {{$total}}
                    <a href="{{url('/checkout')}}">CHECKOUT</a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
