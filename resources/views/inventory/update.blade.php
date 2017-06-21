@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inventory</div>

                <div class="panel-body">
                   Update Inventory
                </div>

                <div class="panel-body">
                    <form action='{{ url("inventory/update") }}' method="POST">
                        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                        <input type="hidden" name="id"  value="{{$item->id}}">
                        Name : {{$item->name}}  <br>
                        
                        Qty:
                        <input type="number" name="qty" value="{{$item->qty}}">        <br>
                        Unit Price:
                        <input type="number" name="price" value="{{$item->price}}">      <br>
                        <input type="submit">       
                    </form>
                </div>

            </div>

            
        </div>
    </div>
</div>
@endsection
