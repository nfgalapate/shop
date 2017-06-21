@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inventory</div>

                <div class="panel-body">
                    Hello, this is your inventory
                    You are logged in!
                </div>

                <div class="panel-body">
                    <form action='{{ url("inventory/add") }}' method="POST">
                        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                        Name
                        <input type="text" name="name">
                        Qty:
                        <input type="number" name="qty">
                        Unit Price:
                        <input type="number" name="price">
                        <input type="submit">
                    </form>
                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Current Items</div>

                <div class="panel-body">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    @foreach($all_items as $item)
                        <tr>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->qty}}</td>
                            <td>{{ $item->price}}</td>
                            <td>
                                <a href='{{ url("inventory/update/". $item->id)  }}'>Update</a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
