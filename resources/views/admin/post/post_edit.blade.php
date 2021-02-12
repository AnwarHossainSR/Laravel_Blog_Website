@extends('admin.master')
@section('title')
    Admin || Edit
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post {{ $post->title }}</h1>
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
                    <form action="{{ route('post.update',[$post->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputName">Title</label>
                          <input type="text" class="form-control" name="title" id="exampleInputName" value="{{ $post->title }}" placeholder="Write a title ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Excerpt</label>
                            <input type="text" class="form-control" name="excerpt" id="exampleInputName" value="{{ $post->excerpt }}" placeholder="Write an excerpt">
                          </div>
                          <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Category</label>
                            <select class="custom-select " name="category_id">

                                @forelse($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    @if ($post->category_id == $cat->id) selected
                                    @endif >
                                    {{ $cat->name }}
                                </option>
                                @empty
                                @endforelse
                            </select>
                          </div>
                          <div class="md-form">
                            <label >Content</label>
                            <textarea type="text" name="content" class="md-textarea form-control" rows="3" >{{ $post->content }}</textarea>
                          </div><br>
                          <div class="form-group-file">
                            <input type="file" name="feature_image" accept="image/*" id="file-upload" class="form-control" name="file" style="display: none;" onchange="previewFile(this)">
                            <p onclick="document.querySelector('#file-upload').click()">
                                Drag & drop to upload image
                            </p>

                          </div>
                        <div id="previewBox" style="display: none;">
                            <img src="{{ $post->url }}" id="previewImg" alt="" width="40%" height="50%">
                            <i class="fas fa-trash-alt nav-icon" style="cursor: pointer;" onclick="previewRemove()">Delete</i>
                        </div>
                        <div class="card-footer">
                            @if($post->status == 'Unpublish')
                                <button type="submit" name="status" class="btn btn-primary" value="unpublish">Save Post</button>
                            @elseif($post->status == 'Publish')
                                <button type="submit" name="status" class="btn btn-success" value="publish">Update Post</button>
                            @else
                                <button type="submit" name="status" class="btn btn-success" value="publish">Update Post</button>
                            @endif
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

@section('style')
  <style>
      .form-group-file{
          width: 100%;
          height: 150px;
          border: 1px dashed !important;
          margin-bottom: 10px;
      }
      .form-group-file{
          width: 100%;
          height: 100%;
          text-align: center;
          line-height: 178px;
      }

  </style>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
         CKEDITOR.replace('content',{
            filebrowserUploadUrl:'{{ route('post.content_file',['_token'=>csrf_token()]) }}',
            filebrowserUploadMethod:'form',
        });

        $(document).ready(function () {
            let url =  "{{ $post->url }}";
            if (url != null) {
                $('#previewBox').css('display','block');
                $('.form-group-file').css('display','none');
            }
        });

        function previewFile(input)
        {
            let file = $("input[type=file]").get(0).files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(){
                    $('#previewImg').attr('src',reader.result);
                    $('#previewBox').css('display','block');
                }
                $('.form-group-file').css('display','none');
                reader.readAsDataURL(file);
            }
        }

        function previewRemove(input)
        {
            $('#previewImg').attr('src','');
            $('#previewBox').css('display','none');
            $('.form-group-file').css('display','block');
        }
    </script>
@endsection

