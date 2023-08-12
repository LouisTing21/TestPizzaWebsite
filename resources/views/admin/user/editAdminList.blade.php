@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">

      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Edit Admin List</legend>
                </div>
                <div class="card-body">
                    @if(Session::has('updateSuccess'))
                     <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                       {{Session::get('updateSuccess')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                      @endif
                      @if(Session::has('errorSuccess'))
                     <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                       {{Session::get('errorSuccess')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                      @endif

                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#updateAdminList',$admin->id)}}">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="name" value="{{old('name',$admin->name)}}" placeholder="Name">

                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail" value="{{old('name',$admin->email)}}" placeholder="Email">
                            @if ($errors->has('email'))
                            <p class=" text-danger">{{$errors->first('email')}}</p>
                        @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="number" name="phone" class="form-control" id="inputName" value="{{old('name',$admin->phone)}}" placeholder="Phone">

                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" name="address" class="form-control" id="inputEmail" value="{{old('name',$admin->address)}}" placeholder="Address">

                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn bg-dark text-white">Update</button>
                            </div>
                          </div>

                      </form>

                      {{-- <div class="">
                        <a href="{{route('admin#changePage')}}">Change Password</a>
                      </div> --}}

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
