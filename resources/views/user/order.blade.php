@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">
    Order Page
    <div class="col-4 ">
        <img src="{{asset('uploads/'.$order->image)}}" class="img-thumbnail" width="100%">            <br>

        <a href="{{route('user#index')}}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        @if(Session::has('total'))
             <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
              Order Succcess! Please wait {{Session::get('total')}} min please.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{route('user#placeOrder')}}" method="POST">
            @csrf
            <h3>Name:</h3>
            <span >{{$order->pizza_name}}</span><br><br>
            <h3>Price:</h3>
            <span >{{$order->price}}Ks</span><br><br>
            <h3>Waiting Time:</h3>
            <span >{{$order->waiting_time}} min</span><br><br>
            <h3>Pizza Count:</h3>
            <input type="number" name=" count" class=" form-control" placeholder="Number of pizza what you want.">
            @if ($errors->has('count'))
            <p class=" text-danger">{{$errors->first('count')}}</p>
             @endif
            <h3>Payment :</h3>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="payment" id="inlineRadio1" value="1">
              <label class="form-check-label" for="inlineRadio1">Card</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="payment" id="inlineRadio2" value="2">
              <label class="form-check-label" for="inlineRadio2">Cash</label>
            </div>
            @if ($errors->has('payment'))
            <p class=" text-danger">{{$errors->first('payment')}}</p>
             @endif
           <div class="col-2 mt-3">
            <button class="btn btn-sm btn-primary float-end mt-2 col-12" ><i class="fas fa-shopping-cart"></i> Order</button>
           </div>
        </form>
    </div>

</div>
@endsection
