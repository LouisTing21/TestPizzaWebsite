@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{asset('uploads/'.$detial->image)}}" class="img-thumbnail" width="100%">            <br>
        <a href="{{route('user#orderPage')}}">
            <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Buy</button>
        </a>
        <a href="{{route('user#index')}}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
      <h3>Name:</h3>
      <span >{{$detial->pizza_name}}</span><br><br>
      <h3>Price:</h3>
      <span >{{$detial->price}}Ks</span><br><br>
      <h3>Discount price:</h3>
      <p >{{$detial->discount_price}}Ks</p><br><br>
      <h3>Buy One Get One</h3>
     @if ($detial->buy_one_get_one_status==1)
         Yes
     @else
         No
     @endif  <br> <br>
     <h3>Waiting Time:</h3>
     <p>{{$detial->waiting_time}} min</p><br><br>
      <h3>Description</h3>
    <p>{{$detial->description}}</p><br><br>
    <div class="">
        <h5 class=" text-primary ">Total Price</h5>
        <h3 class=" text-success text-bold">{{$detial->price-$detial->discount_price}}</h3>
    </div>
    </div>

</div>
@endsection
