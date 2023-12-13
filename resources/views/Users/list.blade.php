@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row align-items-top">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Users</span>

                        <button type="button" class="btn btn-success" data-name="add">ADD USERS</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>NO TLP</th>
                                    <th>EMAIL</th>
                                    <th>USERNAME</th>
                                    <th>PASSWORD</th>
                                    <th>Role</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($arr as $key => $value)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->no_tlp}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->username}}</td>
                                        <td>*******</td>
                                        <td>{{$value->role_id}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-info" data-name="edit" data-item="{{$value->id}}">
                                                <i class='bx bx-edit me-0'></i>
                                            </button>
    
                                            <button type="button" class="btn btn-outline-danger" data-name="delete" data-item="{{$value->id}}">
                                                <i class='bx bxs-trash me-0'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="card-style">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" placeholder="Name" data-name="name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">No TLP</label>
                                <input type="text" class="form-control" id="" placeholder="No TLP" data-name="no_tlp">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" id="" placeholder="Email" data-name="email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Role</label>
                                <select data-name="role_id" class="form-select select-2-add">
                                    <option value="">-- Select Role --</option>
                                    <option value="1">SUPERADMIN</option>
                                    <option value="2">OPR WO</option>
                                    <option value="3">OPR DO</option>
                                    <option value="4">MARKETING</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control" id="" placeholder="Username" data-name="username">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" id="" placeholder="Password" data-name="password">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-style">
                            <div class="card-foto">
                                <img src="{{asset('profile/default.jpg')}}" alt="user avatar" id="img_add">
                            </div>
                            <div class="input-type-file">
                                <input type="file" id="add_foto" name="add_foto" accept="image/*" />
                                <label for="add_foto">Choose File</label>
                            </div>
                            <input type="hidden" id="add_name_foto" data-name="foto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal ADD --}}

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="card-style">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" placeholder="Name" data-name="edit_name">
                                <input type="hidden" data-name="edit_id">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">No TLP</label>
                                <input type="text" class="form-control" id="" placeholder="No TLP" data-name="edit_no_tlp">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" id="" placeholder="Email" data-name="edit_email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Role</label>
                                <select data-name="edit_role_id" class="form-select select-2-edit">
                                    <option value="">-- Select Role --</option>
                                    <option value="1">SUPERADMIN</option>
                                    <option value="2">OPR WO</option>
                                    <option value="3">OPR DO</option>
                                    <option value="4">MARKETING</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control" id="" placeholder="Username" data-name="edit_username">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" id="" placeholder="Password" data-name="edit_password">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-style">
                            <div class="card-foto">
                                <img src="" alt="user avatar" id="img_edit">
                            </div>
                            <div class="input-type-file">
                                <input type="file" id="edit_foto" name="edit_foto" accept="image/*" />
                                <label for="edit_foto">Choose File</label>
                            </div>
                            <input type="hidden" id="edit_name_foto" data-name="edit_foto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_edit">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit --}}

{{-- JS Add Data --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("[data-name='name']").val('');
        $("[data-name='no_tlp']").val('');
        $("[data-name='email']").val('');
        $("[data-name='username']").val('');
        $("[data-name='password']").val('');
        $("[data-name='role_id']").val('').trigger("change");
        $("[data-name='foto']").val('');
        $("#modal_add").modal('show');
    });

    $(document).on("click", "[data-name='save_add']", function (e) {
        var name        = $("[data-name='name']").val();
        var no_tlp      = $("[data-name='no_tlp']").val();
        var email       = $("[data-name='email']").val();
        var username    = $("[data-name='username']").val();
        var password    = $("[data-name='password']").val();
        var role_id     = $("[data-name='role_id']").val();
        var foto        = $("[data-name='foto']").val();
        var is_active   = 1;
        var update_by   = "{!! $idn_user->id !!}";
        var table       = "users";
        if(foto === ''){
            var foto    = 'default.jpg';
        }else{
            var foto    = $("[data-name='foto']").val();
        }

        var data = {
                name:name,
                no_tlp:no_tlp,
                email:email,
                username:username,
                password:password,
                role_id:role_id,
                foto:foto,
                is_active: is_active,
                update_by: update_by
            };

        if (name === '' || no_tlp === '' || email === '' || username === '' || password === '' || role_id === '') {
            Swal.fire({
                position:'center',
                title: 'Form is empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $.ajax({
                type: "POST",
                url: "{{ route('actionadd') }}",
                data: {table: table, data: data},
                cache: false,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        location.reload();
                    })
                },            
                error: function (data) {
                    Swal.fire({
                        position:'center',
                        title: 'Action Not Valid!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    }).then((data) => {
                        // location.reload();
                    })
                }
            });
        }

    });

    $("#add_foto").on("change", function(e){
        var ext = $("#add_foto").val().split('.').pop().toLowerCase();
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            $('#img_add').attr('src', uploadedFile);
            var photo           = e.target.files[0];
            var formData        = new FormData();
            formData.append('add_foto', photo);
            $.ajax({
                url: "{{route('upload_profile')}}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    $('#add_name_foto').val(res);
                }
            })

        }
    });
</script>
{{-- End JS Add Data --}}

{{-- JS Edit Data --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        var id      = $(this).attr("data-item");
        var table   = 'users';
        var field   = 'id';

        $.ajax({
            type: "POST",
            url: "{{ route('actionshowdata') }}",
            data: {id:id,table:table,field:field},
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                $("[data-name='edit_id']").val(data['data'].id);
                $("[data-name='edit_name']").val(data['data'].name);
                $("[data-name='edit_no_tlp']").val(data['data'].no_tlp);
                $("[data-name='edit_email']").val(data['data'].email);
                $("[data-name='edit_username']").val(data['data'].username);
                $("[data-name='edit_password']").val(data['data'].pass);
                $("[data-name='edit_role_id']").val(data['data'].role_id).trigger("change");
                $("[data-name='edit_foto']").val(data['data'].foto);
                var show_foto   = "assets/images/profiles/"+data['data'].foto;
                $('#img_edit').attr('src', show_foto);
                $("#modal_edit").modal('show');
            },            
            error: function (data) {
                Swal.fire({
                    position:'center',
                    title: 'Action Not Valid!',
                    icon: 'warning',
                    showConfirmButton: true,
                    // timer: 1500
                }).then((data) => {
                    // location.reload();
                })
            }
        });
        
    });

    $(document).on("click", "[data-name='save_edit']", function (e) {
        var name        = $("[data-name='edit_name']").val();
        var no_tlp      = $("[data-name='edit_no_tlp']").val();
        var email       = $("[data-name='edit_email']").val();
        var username    = $("[data-name='edit_username']").val();
        var password    = $("[data-name='edit_password']").val();
        var role_id     = $("[data-name='edit_role_id']").val();
        var foto        = $("[data-name='edit_foto']").val();
        if(foto === ''){
            var foto    = 'default.jpg';
        }else{
            var foto    = $("[data-name='edit_foto']").val();
        }

        var table       = "users";
        var whr         = "id";
        var id          = $("[data-name='edit_id']").val();
        var dats        = {name:name,no_tlp:no_tlp,email:email,username:username,password:password,role_id:role_id,foto:foto};

        if (name === '' || no_tlp === '' || email === '' || username === '' || password === '' || role_id === '') {
            Swal.fire({
                position:'center',
                title: 'Form is empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $.ajax({
                type: "POST",
                url: "{{ route('actionedit') }}",
                data: {id:id,whr:whr,table:table,dats:dats},
                cache: false,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        location.reload();
                    })
                },            
                error: function (data) {
                    Swal.fire({
                        position:'center',
                        title: 'Action Not Valid!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    }).then((data) => {
                        // location.reload();
                    })
                }
            });
        }
    });

    $("#edit_foto").on("change", function(e){
        var ext = $("#edit_foto").val().split('.').pop().toLowerCase();
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            $('#img_edit').attr('src', uploadedFile);
            var photo           = e.target.files[0];
            var formData        = new FormData();
            formData.append('add_foto', photo);
            $.ajax({
                url: "{{route('upload_profile')}}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    $('#edit_name_foto').val(res);
                }
            })

        }
    });
</script>
{{-- End JS Edit Data --}}

{{-- JS Delete Data --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id      = $(this).attr("data-item");
        var table   = 'users';
        var whr     = 'id';

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Aksi ini tidak dapat diulang!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('actiondelete') }}",
                    data: {id:id,whr:whr,table:table},
                    cache: false,
                    success: function(data) {
                        Swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            location.reload();
                        })
                    },            
                    error: function (data) {
                        Swal.fire({
                            position:'center',
                            title: 'Action Not Valid!',
                            icon: 'warning',
                            showConfirmButton: true,
                            // timer: 1500
                        }).then((data) => {
                            // location.reload();
                        })
                    }
                });
            }
        })
    });
</script>
{{-- End JS Delete Data --}}

{{-- JS Datatable --}}
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
{{-- End JS Datatable --}}

{{-- Select2 --}}
<script>
    $(".select-2-add").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $("#modal_add")
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $("#modal_edit")
    });
</script>
{{-- End Select2 --}}

@stop