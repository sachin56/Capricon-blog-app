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
                        <form>
                            <input type="hidden" id="hid" name="hid">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="rate"> User Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Title" required>
                                </div>
                                 <div class="form-group col-md-12">
                                    <label for="rate">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Title" readonly>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Roles</label>
                                        <select class="select2" multiple="multiple" style="width: 100%;" id="role_id" name="role_id">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->description }}</option>
                                            @endforeach
                                        </select>
                                      </div>
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
                        <div class="card-body">
                            <table class="table table-striped nowrap" id="category">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
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
        $('.select2').select2();
        
        //table call
        category();

        $(document).on("blur",".form-control",function(){
            $("#submit").css("display","block");
        });

        //edit category
        $(document).on("click", ".edit", function(){

            var id = $(this).attr('data');

            //empty field function call
            empty_form();

            $("#hid").val(id);
            $("#modal").modal('show');//modal tigger
            $(".modal-title").html('Edit User');//change model title
            $("#submit").html('Update User');//change submit button text

            $.ajax({
                'type': 'ajax',
                'dataType': 'json',
                'method': 'get',
                'url': 'user/'+id,
                'async': false,
                success: function(data){
                    $("#hid").val(data.users.id);
                    $("#name").val(data.users.name);
                    $("#email").val(data.users.email);

                    let roles=data.u_user_roles;

                    var u_user_roles = [];

                    roles.forEach(obj=> u_user_roles.push(Object.values(obj)));

                    $("#role_id").val(u_user_roles).change();
                }
            });

            $("#submit").click(function(){

                if($("#hid").val() != ""){

                    var id = $("#hid").val();
                    var name = $("#name").val();
                    var role_id =$("#role_id").val()

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
                                    'data' :{name:name,role_id:role_id},
                                    'url': 'user/'+id,
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
                            'url': 'user/'+id,
                            'async': false,
                            success: function(data){

                            if(data){
                                toastr.success('User Deleted');
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
                        'url': 'user/create'
            },
            'columns': [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
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