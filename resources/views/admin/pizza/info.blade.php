@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
               <a href="{{route('admin#pizza')}}"> <button class=" btn btn-sm btn-secondary text-white mb-4">BACK</button></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Info Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex" id="activity">
                      <div class=" pr-5 mt-3" >
                        <img src="{{asset('uploads/'.$pizza->image)}}" class=" img-thumbnail rounded-circle" alt="">
                      </div>
                      <div class=" mt-3">
                        <div class="">
                            <b>Name:</b><label for="">{{$pizza->pizza_name}}</label>
                        </div>
                        <div class="">
                            <b>Price:</b><label for="">{{$pizza->pizza_name}} Kyats</label>
                        </div>
                        <div class="">
                            <b>Publish Status:</b>
                            <label for="">
                                @if ($pizza->publish_status==1)
                                    Yes
                                @else
                                    No
                                @endif
                            </label>
                        </div>
                        <div class="">
                            <b>Category :</b><label for="">{{$pizza->category_id}}</label>
                        </div>
                        <div class="">
                            <b>Discount:</b><label for="">{{$pizza->discount_price}} Kyats</label>
                        </div>
                        <div class="">
                            <b>Buy One Get One:</b>
                            <label for="">
                                @if ($pizza->buy_one_get_one_status==1)
                                    Yes
                                @else
                                    No
                                @endif
                            </label>
                        </div>
                        <div class="">
                            <b>Waiting Time:</b><label for="">{{$pizza->waiting_time}} min</label>
                        </div>
                        <div class="">
                            <b>Description:</b><label for="">{{$pizza->description}}</label>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
