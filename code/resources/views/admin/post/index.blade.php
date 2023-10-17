@extends('layouts.admin')

    @section('content')
        <div class="modal fade" id="modal">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Post</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="myForm_attachment" enctype="multipart/form-data">
                            <input type="hidden" id="hid" name="hid">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="rate"> Post Name</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                                </div>
                                 <div class="form-group col-md-12">
                                    <label for="rate"> Add Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Enter Title" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="rate"> Add Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="" style="display: none" selected>Select Category</option>
                                        @foreach($result as $category)
                                            <option value="{{ $category->id }}"> {{ $category->category_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Post Description</label>
                                    <textarea type="text" class="form-control" id="content" name="content" placeholder="Enter Post Description" required></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success submit" id="submit">Save changes</button>
                </div>
            </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-dark"></h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Category</a></li>
                    </ol>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary addNew"><i class="fa fa-plus"></i> Add New Post</button>
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
 
    <script>

    $(document).ready(function(){

        // menu active
        $(".role_route").addClass('active');
        $(".user_tree").addClass('active');
        $(".user_tree_open").addClass('menu-open');
        $(".user_tree_open").addClass('menu-is-opening');


        //csrf token error
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $('#content').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 300
        });

        //table call
        category();

        $(document).on("blur",".form-control",function(){
            $("#submit").css("display","block");
        });

        //add new data modal 
        $(".addNew").click(function(){
            //empty field function call
            empty_form();

            $("#modal").modal('show');//modal tigger
            $(".modal-title").html('Save Category');//change model title
            $("#submit").html('Save Category');//change submit button text


            $("#submit").click(function(){

                $("#submit").css("display","none");
                var hid = $("#hid").val();
                //save category
                if(hid == ""){

                    var formData = new FormData($('#myForm_attachment')[0]);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Update it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        'type': 'ajax',
                                        'dataType': 'json',
                                        'method': 'post',
                                        'data' : formData,
                                        'url' : 'post',
                                        'processData': false,
                                        'contentType': false,
                                        success:function(data){
                                            if(data.validation_error){
                                                validation_error(data.validation_error);//if has validation error call this function
                                            }

                                            if(data.db_error){
                                                db_error(data.db_error);
                                            }

                                            if(data.db_success){
                                                toastr.success(data.db_success);
                                                setTimeout(function(){
                                                    $("#modal").modal('hide');
                                                    location.reload();
                                                }, 2000);
                                            }

                                        },
                                        error: function(jqXHR, exception) {
                                            db_error(jqXHR.responseText);
                                        }
                                    });
                                }  
                            });  
                        };
                    });
                });

        //edit category
        $(document).on("click", ".edit", function(){

            var id = $(this).attr('data');

            //empty field function call
            empty_form();

            $("#hid").val(id);
            $("#modal").modal('show');//modal tigger
            $(".modal-title").html('Edit Category');//change model title
            $("#submit").html('Update Category');//change submit button text

            $.ajax({
                'type': 'ajax',
                'dataType': 'json',
                'method': 'get',
                'url': 'post/'+id,
                'async': false,
                success: function(data){
                    $("#hid").val(data.id);
                    $("#title").val(data.title);
                    $("#content").summernote('code',data.content);
                    $("#category_id").selectpicker("val",data.category_id);
                }
            });

            $("#submit").click(function(){

                if($("#hid").val() != ""){

                    var formData = new FormData($('#myForm_attachment')[0]);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Update it!'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                $.ajax({
                                    'type': 'ajax',
                                    'dataType': 'json',
                                    'method': 'post',
                                    'data' : formData,
                                    'url': 'post/'+id,
                                    'processData': false,
                                    'contentType': false,
                                    success:function(data){
                                        if(data.validation_error){
                                            validation_error(data.validation_error);//if has validation error call this function
                                        }

                                        if(data.db_error){
                                        db_error(data.db_error);
                                        }

                                        if(data.db_success){
                                            toastr.success(data.db_success);
                                            
                                            setTimeout(function(){
                                                $("#modal").modal('hide');
                                                location.reload();
                                            }, 1000);
                                        }
                                    },
                                });
                            }
                    });
                }
            });
        });

        //delete catagory
        $(document).on("click", ".delete", function(){
            var id = $(this).attr('data');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            'type': 'ajax',
                            'dataType': 'json',
                            'method': 'delete',
                            'url': 'category/'+id,
                            'async': false,
                            success: function(data){

                            if(data){
                                toastr.success('Category Deleted');
                                setTimeout(function(){
                                location.reload();
                                }, 1000);

                            }

                            }
                        });

                    }

            });

        });
    });

    //Data Table 
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
                    html+="<td><button class='btn btn-warning btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-edit'></i></button>";
                    html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"' title='Delete'><i class='fas fa-trash'></i></button>";
                    html+="&nbsp;<a href='post//"+d.slug+"' target='_blank' class='btn btn-sm btn-dark mr-1'> <i class='fas fa-link'></i> </a>"
                    return html;

                }

                }
            ]
        });
    }

    function empty_form(){
        $("#hid").val("");
        $("#name").val("");
        $("#description").val("");
    }

    function validation_error(error){
        for(var i=0;i< error.length;i++){
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error[i],
            });
        }
    }

    function db_error(error){
        Swal.fire({
            icon: 'error',
            title: 'Database Error',
            text: error,
        });
    }

    function db_success(message){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
        });
    }
</script>
@endsection