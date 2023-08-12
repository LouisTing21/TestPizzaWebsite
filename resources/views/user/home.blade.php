@extends('user.layout.style')

@section('content')
<div class="container px-4 px-lg-5" id="home">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light" id="about">CODE LAB Pizza</h1>
            <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
            <a class="btn btn-primary" href="#!">Enjoy!</a>
        </div>
    </div>

    <!-- Content Row-->
    <div class="d-flex ">
        <div class="col-3 me-5">
            <div class="">
                <div class="py-5 text-center">
                    <form class="d-flex m-5" action="{{route('user#search')}}" method="get">
                        <input class="form-control me-2" type="search" value=" {{old('search')}}" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>

                    <div class="">
                            <a href="{{route('user#index')}}" class=" text-decoration-none text-dark"> <div class=" m-2 p-2" >All</div></a>
                            @foreach ($category as $item)
                            <a href="{{route('user#pizzaSearch',$item->category_id)}}" class=" text-decoration-none text-dark"><div class="m-2 p-2">{{$item->category_name}}</div></a>
                            @endforeach
                    </div>
                    <hr>
                   <form action="{{route('user#priceSearch')}}" method="get">
                    @csrf
                    <div class="text-center m-4 p-2">
                        <h3 class="mb-3 " >Start - End Date</h3>
                            <input type="date" name="startDate" id="" class="form-control">
                            @if ($errors->has('startDate'))
                            <p class=" text-danger">{{$errors->first('startDate')}}</p>
                            @endif
                            <input type="date" name="endDate" id="" class="form-control mt-3">
                            @if ($errors->has('endDate'))
                            <p class=" text-danger">{{$errors->first('endDate')}}</p>
                            @endif
                    </div>
                    <hr>
                    <div class="text-center m-4 p-2">
                        <h3 class="mb-3">Min - Max Amount</h3>
                            <input type="number" name="min" id="" class="form-control"  placeholder="minimum price">
                            @if ($errors->has('min'))
                            <p class=" text-danger">{{$errors->first('min')}}</p>
                             @endif
                            <input type="number" name="max" id="" class="form-control mt-3"  placeholder="maximun price">
                            @if ($errors->has('max'))
                            <p class=" text-danger">{{$errors->first('max')}}</p>
                            @endif
                            <div class=" mt-3">
                                <button type="submit" class="  btn btn-dark text-white">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                    </div>
                   </form>
                </div>
            </div>
        </div>
        <div class="vr"></div>
        <div class="mt-5">
            <div class="row " id="pizza">
             @if ($status==1)
             @foreach ($pizza as $item)
             <div class="col-md-4 mb-5" >
               <div class="card h-100 me-10"  style="width: 270px" >
                   <!-- Sale badge-->

                   @if ($item->buy_one_get_one_status==1)
                   <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Buy 1 Get 1</div>
                   @endif
                   <!-- Product image-->
                   <img class="card-img-top" id="pizza-image" src="{{asset('uploads/'.$item->image)}}"  alt="..." />
                   <!-- Product details-->
                   <div class="card-body p-4">
                       <div class="text-center">
                           <!-- Product name-->
                           <h5 class="fw-bolder">{{$item->pizza_name}}</h5>
                           <!-- Product price-->
                           <span class="text-dark fs-5">{{$item->price}}</span>Ks
                       </div>
                   </div>
                   <!-- Product actions-->
                   <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                       <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('admin#deetials',$item->pizza_id)}}">More Detial</a></div>
                   </div>
               </div>
              </div>


             @endforeach
             @else
             <div class="alert alert-danger mt-5 ms-5 text-center  " role="alert">
              There is no data.
              </div>
             @endif
            </div>
        </div>
    </div>
</div>

<div class="text-center d-flex justify-content-center align-items-center mt-5" id="contact">

    <div class="col-4 border rounded-3 bg-secondary  bg-opacity-10 shadow ps-5 pt-5 pe-5 pb-2 mb-5">
        @if(Session::has('contactSuccess'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{Session::get('contactSuccess')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h3>Contact Us</h3>

        <form action="{{route('user#contact')}}" class="my-4" method="POST">
            @csrf
            <input type="text" name="name" id="" class="form-control my-3" placeholder="Name">
            @if ($errors->has('name'))
            <p class=" text-danger">{{$errors->first('name')}}</p>
            @endif
            <input type="email" name="email" id="" class="form-control my-3" placeholder="Email">
            @if ($errors->has('email'))
            <p class=" text-danger">{{$errors->first('email')}}</p>
            @endif
            <textarea class="form-control my-3" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
            @if ($errors->has('message'))
            <p class=" text-danger">{{$errors->first('message')}}</p>
            @endif
            <button type="submit" class="btn btn-outline-dark">Send  <i class="fas fa-arrow-right"></i></button>
        </form>
    </div>
</div>
@endsection
