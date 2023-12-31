@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::has('createSuccess'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{Session::get('createSuccess')}}
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
         <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
             {{Session::get('updateSuccess')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
          @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a href="{{route('admin#createPizza')}}">
                        <button class=" btn  "><i class="fa-solid fa-plus"></i></button>
                    </a>
                    <div class="">
                        <span>Total -{{$pizza->total()}}</span>
                    </div>
                </h3>

                <div class="card-tools">
                  <form action="{{route('admin#searchPizza')}}" method="get">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        @if ($errors->has('table_search'))
                        <p class=" text-danger">{{$errors->first('table_search')}}</p>
                        @endif
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                  </form>
                  <a href="{{route('admin#pizzaDownload')}}" >
                    <button class="btn btn-sm btn-success mt-2">
                        Download CSV
                    </button>
                </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   @if ($status==0)
                       <tr>
                            <td colspan="7">
                                <small>This is no data.</small>
                            </td>
                       </tr>
                   @else
                   @foreach ($pizza as $item)
                   <tr>
                    <td>{{$item->pizza_id}}</td>
                    <td>{{$item->pizza_name}}</td>
                    <td>
                      <img src="{{asset('uploads/'.$item->image)}}" class="img-thumbnail" width="100px">
                    </td>
                    <td>{{$item->price}} kyats</td>
                    <td>
                        @if ($item->publish_status==1)
                            Publish
                          @elseif ($item->publish_status==0)
                            Unpublish
                        @endif
                    </td>
                    <td>
                        @if ($item->buy_one_get_one==1)
                            Yes
                          @elseif ($item->buy_one_get_one==0)
                            No
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin#editPizza',$item->pizza_id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        <a href="{{route('admin#deletePizza',$item->pizza_id)}}"> <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        <a href="{{route('admin#infoPizza',$item->pizza_id)}}"><button class="btn btn-sm bg-blue text-white"><i class="fa-solid fa-eye"></i></button></a>
                    </td>
                  </tr>
                   @endforeach
                   @endif

                  </tbody>
                </table>
                <div class="">
                    {{$pizza->links()}}
                </div>
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
