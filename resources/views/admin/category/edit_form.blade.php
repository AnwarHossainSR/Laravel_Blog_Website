@extends('admin.master')
@section('title')
    Admin || Category
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category Update</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('category.manage') }}" class="card-title">
                    <i class="fas fa-list nav-icon"></i>
                    Category List
                </a>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  @include('admin.include.alert')
                  <div class="card">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('category.update') }}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="id" id="exampleInputName" value="{{ $category->id }}" hidden>
                          <label for="exampleInputName">Name</label>
                          <input type="text" class="form-control" name="name" id="exampleInputName" value="{{ $category->name }}">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
  </section>

@endsection
