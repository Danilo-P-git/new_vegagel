@extends('ecommerce.side')

@section('content')
<div class="container">
    <div class="col-12">


<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php 
        $total = 0 
        
        @endphp

        @if(session('cart'))

        
        @foreach(session('cart') as $id)
        
        <form action="{{route('ecommerce.cart.store', $id['id_product'])}}" method="POST">
            @csrf
            <p name="userId" value="{{Auth::user()->name}}"></p>
                @php 
                /* dd(session('cart')); */
                $total += $id['price'] * $id['quantity'] @endphp
                
                
                <tr data-id="{{ $id['id_product'] }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $id['image'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $id['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">€{{ $id['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" name="quantity" value="{{ $id['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">€{{ $id['price'] * $id['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            
            @endforeach
            <div class="row">
                <label class="col-md-4 col-form-label text-md-right" for="data_di_consegna">Inserisci una data di consegna</label>
                <input class="col-md-6 form-control" name="data_di_consegna" type="date" id="data_di_consegna" style="width: 45%" required value="" >
            </div>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Totale €{{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/ecommerce') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
            </td>
        </tr>
    </tfoot>
</table>
</div>
</div>
@endsection
  
@section('scripts')
<script type="text/javascript">
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
        
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
            
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
@endsection