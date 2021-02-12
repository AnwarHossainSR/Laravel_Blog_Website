@extends('admin.master')
@section('title')
    Admin || Post
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Generate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('post.index') }}" class="card-title">
                    <i class="fas fa-list nav-icon"></i>
                    Post List
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
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputName">Title</label>
                          <input type="text" class="form-control" name="title" id="exampleInputName" placeholder="Write a title ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Excerpt</label>
                            <input type="text" class="form-control" name="excerpt" id="exampleInputName" placeholder="Write an excerpt">
                          </div>
                          <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Category</label>
                            <select class="custom-select " name="category_id">
                                <option value="0" selected>Select a category</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                @endforelse
                              @foreach($categories as $key => $category)

                              @endforeach
                            </select>
                          </div>
                          <div class="md-form">
                            <label >Content</label>
                            <textarea type="text" name="content" class="md-textarea form-control" rows="3" ></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName">Feature Image</label>
                            <input type="file" accept="image/*" class="form-control" name="file" style="display: none;">
                            <p>Drag & drop to upload image</p>
                          </div>
                        <div class="card-footer">
                            <button type="submit" name="status" class="btn btn-primary" value="unpublish">Save Post</button>
                            <button type="submit" name="status" class="btn btn-success" value="publish">Publish Post</button>
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

@section('script')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
         CKEDITOR.replace('content',{
            filebrowserUploadUrl:'{{ route('post.content_file',['_token'=>csrf_token()]) }}',
            filebrowserUploadMethod:'form',
        });
    