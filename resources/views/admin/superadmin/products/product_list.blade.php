@extends('admin.layouts.master')
@section('content')
  <a href="{{ route('adminproducts.create') }}" class="btn btn-secondary">Create Product</a>
<hr>
    <table class="table table-dark">
    <thead>
      <tr>
        <th>Orders</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Vendor</th>
        <th>Owner</th>
        <th>Date Created</th>
        <th>Created By</th>
        <th>Featured</th>
        <th>Best Seller</th>
        <th>Action</th>
      </tr>
    </thead>
          @foreach($products as $product)
          <tbody class="table-light text-dark">
            <tr>
              <td>
                  @foreach($orders as $order)
                    @if($order->product_id == $product->id)
                      @if($order->total > 50)
                      <i class="fas fa-shopping-cart bg-info p-2 text-white"> {{$order->total}}</i> 
                      @else
                       <i class="fas fa-shopping-cart"></i> {{$order->total}}
                       @endif              
                    @endif
                  @endforeach
              </td>
              <td><i class="fas fa-book"></i> {{$product->product_name}}</td>
              <td><i class="fas fa-money-bill"></i> {{$product->product_price}}</td>
              <td><i class="fas fa-store"></i> {{$product->vendor->vendor_name}}</td>
              <td><i class="fas fa-user"></i> {{$product->vendor->user_name}}</td>
              <td><i class="fas fa-calendar-day"></i> {{$product->created_at}}</td>
              <td><i class="fas fa-user"></i> {{$product->admin_name}}</td>

              @if($product->featured == 1)
              <td><i class="fas fa-star"></i> FEATURED</td>
              @else
              <td></td>
              @endif
              @if($product->best_seller == 1)
              <td><i class="fas fa-award"></i> BEST SELLER</td>
              @else
              <td></td>
              @endif

              <td><div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('adminproducts.edit', $product->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('adminproducts.destroy', $product->id) }}" method="POST" class="d-inline">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger">Delete</button>
                  @csrf
                </form>
              </div></td>
            </tr>           
          </tbody>
          @endforeach          
  </table>

@endsection
