@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="row mt-4">
          <div class="col-8 offset-2 mt-4">
            <h3 class=" mb-3">{{$pizza[0]->CategoryName}}</h3>
            <div class="card">
              <div class="card-header">

                <h3 class="card-title">

                  <span>Total -{{$pizza->total()}}</span>
                </h3>



                {{-- <div class="card-tools">
                  <form action="{{route('admin#searchCategory')}}" method="get" class=" mt-2">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="search" class="form-control float-right"  placeholder="Search">
                        @if ($errors->has('search'))
                        <p class=" text-danger">{{$errors->first('search')}}</p>
                        @endif
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                  </form>
                </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">


                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Pizza Name</th>
                      <th>Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($pizza as $item)
                      <tr>
                        <td>{{$item->pizza_id}}</td>
                        <td><img class=" w-25" src="{{asset('uploads/'.$item->image)}}" alt=""></td>
                        <td>{{$item->pizza_name}}</td>

                        <td>{{$item->price}}</td>
                      <td>
                        <a href="{{route('admin#editCategory',$item->category_id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        <a href="{{route('admin#deleteCategory', $item->category_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                      </td>

                      </tr>
                      @endforeach



                  </tbody>
                </table>
               <div class=" mt-3 ms-3"> {{$pizza->links()}}</div>
              </div>
              <div class="card-footer">
                <a href="{{route('admin#category')}}"><button class=" btn btn-dark rounded">Back</button></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
