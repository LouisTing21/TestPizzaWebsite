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
                  <legend class="text-center">Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#insertPizza')}}"  ENCTYPE="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name"  placeholder="Name">
                          </div>
                          @if ($errors->has('name'))
                          <p class=" text-danger">{{$errors->first('name')}}</p>
                      @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" name="image"  placeholder="image" >
                            </div>
                            @if ($errors->has('image'))
                              <p class=" text-danger">{{$errors->first('image')}}</p>
                          @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" name="price"  placeholder="price">
                            </div>
                            @if ($errors->has('price'))
                              <p class=" text-danger">{{$errors->first('price')}}</p>
                          @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Publish  Status</label>
                            <div class="col-sm-10">
                              <select name="publish" id="" class=" form-control">
                                <option value="">Choose option...</option>
                                <option value="1">Pubilsh</option>
                                <option value="0">Unpublish</option>
                              </select>
                              @if ($errors->has('name'))
                              <p class=" text-danger">{{$errors->first('name')}}</p>
                          @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category" id="" class=" form-control">
                                    <option value="">Choose Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                            @if ($errors->has('category'))
                            <p class=" text-danger">{{$errors->first('category')}}</p>
                        @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" name="discount"  placeholder="">
                            </div>
                            @if ($errors->has('discount'))
                              <p class=" text-danger">{{$errors->first('discount')}}</p>
                          @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                            <div class="col-sm-10 mt-2">
                                <input type="radio" value="1" name="buyOneGetOne" class=" form-input-check ">Yes
                                <input type="radio" value="0" name="buyOneGetOne" class=" form-input-check ">No
                            </div>
                            @if ($errors->has('buyOneGetOne'))
                            <p class=" text-danger">{{$errors->first('buyOneGetOne')}}</p>
                        @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" name="waitingTime"  placeholder="">
                            </div>
                            @if ($errors->has('waitingTime'))
                            <p class=" text-danger">{{$errors->first('waitingTime')}}</p>
                        @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Description" name="description" ></textarea>
                            </div>
                            @if ($errors->has('description'))
                            <p class=" text-danger">{{$errors->first('description')}}</p>
                        @endif
                          </div>



                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add</button>
                          </div>
                        </div>
                      </form>

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
