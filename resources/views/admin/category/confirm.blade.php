@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">


      <div class="container-fluid">
       <div class="container">
            <div class="row">
                <div class="col-md-6 offset-3 mt-3">
                    <div class="mb-3">
                        <a href="{{route('admin#editCategory',$category['id'])}}"><button type="submit" class=" btn btn-danger ">cancel</button></a>
                    </div>
                    <div class="card">
                        <div class="card-header text-center" >
                            <h3>Are u sure to change ?</h3>
                        </div>
                        <div class="card-body">
                            <label for="">Categroy Name :</label> <label for="">{{$category['category_name']}}</label>
                           <div class="mt-3">
                            <div class=" d-flex float-end">
                                <a href="{{route('admin#realCategory')}}"><button type="submit" class=" btn btn-dark ">save</button></a>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
