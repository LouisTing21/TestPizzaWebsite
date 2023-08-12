@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        {{-- @if(Session::has('categorySuccess'))
             <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                 {{Session::get('categorySuccess')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('deleteSuccess'))
             <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                 {{Session::get('deleteSuccess')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{Session::get('updateSuccess')}}
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
        @endif --}}
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  {{-- <a href="{{route('admin#addCategory')}}">
                    <button class="btn btn-sm btn-outline-dark">Add Category</button>
                  </a> --}}
                  <div class="">
                    <span>Total -{{$order->total()}}</span>
                </div>
                </h3>
                {{-- <span>Total -{{$Category->total()}}</span> --}}

                <div class="card-tool">
                    <form action="{{route('admin#orderSearch')}}" method="get" class=" mt-2">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right"  placeholder="Search">
                            {{-- @if ($errors->has('search'))
                            <p class=" text-danger">{{$errors->first('search')}}</p>
                            @endif --}}
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                      </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">


                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Customer Name</th>
                      <th>Pizza Name</th>
                      <th>Produt Count</th>
                      <th>Order Date</th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($order as $item)
                      <tr>
                        <td>{{$item->customer_id}}</td>
                      <td>{{$item->name}}</td>
                      <td>
                        {{-- @if ($item->count==0)
                            <a href="#" >{{$item->count}}</a>

                        @else
                              <a href="{{route('admin#categoryItem',$item->category_id)}}">{{$item->count}}</a>
                        @endif --}}
                        {{$item->pizza_name}}
                      </td>
                      <td>
                        {{-- <a href="{{route('admin#editCategory',$item->category_id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        <a href="{{route('admin#deleteCategory', $item->category_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                         --}}
                         {{$item->count}}
                      </td>
                      <td>{{$item->order_time}}</td>

                      </tr>
                      @endforeach



                  </tbody>
                </table>
               <div class=" mt-3 ms-3"> {{$order->links()}}</div>
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