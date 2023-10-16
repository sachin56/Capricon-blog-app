@extends('layouts.admin')

    @section('content')
        <div class="modal fade" id="modal">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" id="hid" name="hid">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="rate"> Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="rate">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <button class="btn btn-primary addNew"><i class="fa fa-plus"></i> Add New Category</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="category">
                                <thead>
                                    <tr>
                                        <th style="width:10%">ID</th>
                                        <th style="width:20%">Name</th>
                                        <th style="width:20%">Description</th>
                                        <th style="width:20%">Action</th>
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
                    var name =$("#name").val();
                    var description =$("#description").val();

                    $.ajax({
                        'type': 'ajax',
                        'dataType': 'json',
                        'method': 'post',
                        'data' : {name:name,description:description},
                        'url' : 'category',
                        'async': false,
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
                'url': 'category/'+id,
                'async': false,
                success: function(data){
                    $("#hid").val(data.id);
                    $("#name").val(data.name);
                    $("#description").val(data.description);
                }
            });

            $("#submit").click(function(){

                if($("#hid").val() != ""){

                    var id = $("#hid").val();
                    var name = $("#name").val();
                    var description = $("#description").val();
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
                                    'method': 'put',
                                    'data' : {name:name,description:description},
                                    'url': 'category/'+id,
                                    'async': false,
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

    //Data Table show
    function category(){
        
        $('#category').DataTable().clear();
        $('#category').DataTable().destroy();

        $("#category").DataTable({
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            'ajax': {
                        'method': 'get',
                        'url': 'category/create'
            },
            'columns': [
                {data: 'id'},
                {data: 'category_name'},
                {data: 'description'},

                {
                data: null,
                render: function(d){
                    var html = "";
                    html+="<td><button class='btn btn-warning btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-edit'></i></button>";
                    html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"' title='Delete'><i class='fas fa-trash'></i></button>";
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