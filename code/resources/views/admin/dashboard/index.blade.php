@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-8">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $postCount }}</h3>

                  <p>Posts</p>
                </div>
                <div class="icon">
                  <i class="fas fa-pen-square"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-8">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $categoryCount }}</h3>

                  <p>Categories</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tags"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-4 col-8">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $userCount }}</h3>

                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Post List</h3>
                            {{-- <a href="{{ route('post.index') }}" class="btn btn-primary">Post List</a> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped nowrap" id="category">
                          <thead>
                              <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Image</th>
                                  <th>Title</th>
                                  <th>Category</th>
                                  <th>Author</th>
                                  <th>Created Date</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
  <script>  
      $(document).ready(function(){
        category();
      });
      function category(){
        
        $('#category').DataTable().clear();
        $('#category').DataTable().destroy();

        $("#category").DataTable({
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            'ajax': {
                        'method': 'get',
                        'url': 'post/create'
            },
            'columns': [
                {data: 'id'},
                { data: 'image' ,
                    "render": function ( data) {
                    return '<img src="/storage/post/'+data+'" width="40px">';}
                },
                {data: 'title'},
                {data: 'category_name'},
                {data: 'name'},
                {data: 'published_at'},

                {
                data: null,
                render: function(d){
                    var html = "";
                    html+="&nbsp;<a href='post//"+d.slug+"' target='_blank' class='btn btn-sm btn-dark mr-1'> <i class='fas fa-link'></i> </a>"
                    return html;

                }

                }
            ]
        });
    }
  </script>
@endsection