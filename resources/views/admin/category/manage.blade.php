@extends('admin.master')
@section('title')
    Admin || Category
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{ route('category.manage') }}">Category</a></li>
                    <li class="breadcrumb-item active">Manage</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            @include('admin.include.alert')

            <div class="card-header">
              <h3 class="card-title">Categories</h3>
              <a href="{{ route('category.add') }}" class="card-title float-right">
                <i class="fas fa-plus-circle nav-icon"></i>
                Add Category
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table table-hover">
                <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($categories as $key => $cate)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $cate->name }}</td>
                            <td>
                                @if ($cate->status == 1)
                                    <li class="text-success">Publish</li>
                                @else
                                <li class="text-danger">Unpublish</li>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('category.destroy',$cate->id) }}" title="Delete" class="btn text-danger">
                                    <i class="fas fa-trash nav-icon"></i>
                                </a>
                                <a href="{{ route('category.edit',$cate->id) }}" title="Edit" class="btn text-success">
                                    <i class="fas fa-edit nav-icon"></i>
                                </a>
                                @if($cate->status == 1)
                                    <a href="{{ route('category.hide',$cate->id) }}" title="Click to Unpublish" class="btn text-success">
                                        <i class="fas fa-arrow-up nav-icon"></i>
                                    </a>
                                @else
                                <a href="{{ route('category.publish',$cate->id) }}" title="Click to Publish" class="btn text-danger">
                                    <i class="fas fa-arrow-down nav-icon"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>


{{-- <div class="card">
    <div class="card-header">
      <h3 class="card-title">DataTable with default features</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Rendering engine</th>
          <th>Browser</th>
          <th>Platform(s)</th>
          <th>Engine version</th>
          <th>CSS grade</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 4.0
          </td>
          <td>Win 95+</td>
          <td> 4</td>
          <td>X</td>
        </tr>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 5.0
          </td>
          <td>Win 95+</td>
          <td>5</td>
          <td>C</td>
        </tr>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 5.5
          </td>
          <td>Win 95+</td>
          <td>5.5</td>
          <td>A</td>
        </tr>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 6
          </td>
          <td>Win 98+</td>
          <td>6</td>
          <td>A</td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div> --}}
@endsection
