@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row align-items-top">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Input STO WO</span>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">SO NO</th>
                                    <th scope="col">PT NO</th>
                                    <th scope="col">WO STATE</th>
                                    <th scope="col">WO DATE</th>
                                    <th scope="col">DO NO</th>
                                    <th scope="col">DO STATE</th>
                                    <th scope="col">DATE UPLOAD</th>
                                </tr>
                            </thead>
                            <tbody id="showdatatable">
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Modal Input WO --}}
<div class="modal fade" id="input" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Input WO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label">Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control" data-name="tgl_input" value="{{date('Y-m-d')}}">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-event"></i></span>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label">Select WO</label>
                        <select id="id_sto" class="form-select select2-add">
                            <option value="">-- Select WO --</option>
                            @foreach($wo as $key => $value)
                                <option value="{{$value->id}}">{{$value->pt_no}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <h5 class="card-title">SO Details</h5>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">SO NO</div>
                    <div class="col-lg-9 col-md-8 fw-bold" data-name="so_no">-</div>
                    <input type="hidden" data-name="id" id="id_sto">
                    <input type="hidden" data-name="tgl_input" value="{{date('Y-m-d H:i:s')}}">
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">WO NO</div>
                    <div class="col-lg-9 col-md-8 fw-bold" data-name="wo_no">-</div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">WO STATE</div>
                    <div class="col-lg-9 col-md-8 fw-bold" data-name="wo_state">-</div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 label">WO DATE</div>
                    <div class="col-lg-9 col-md-8 fw-bold" data-name="wo_date">USA</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save">Done</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Input WO --}}

<script>
    $(document).ready(function() {
        setTimeout(fetchAndUpdateData);
    });
</script>

{{-- JS Input WO --}}
<script>
    $(document).on("click", ".action-input", function (e) {
        var id          = $("[data-name='id']").val($(this).attr("data-item").split(",")[0]);
        var so_no       = $("[data-name='so_no']").text(': '+$(this).attr("data-item").split(",")[1]);
        var wo_no       = $("[data-name='wo_no']").text(': '+$(this).attr("data-item").split(",")[2]);
        var wo_state    = $("[data-name='wo_state']").text(': '+$(this).attr("data-item").split(",")[3]);
        var wo_date     = $("[data-name='wo_date']").text(': '+$(this).attr("data-item").split(",")[4]);
        $("#input").modal('show');
    });

    $(document).on("click", "[data-name='save']", function (e) {

        var id_sto      = $("#id_sto").val();
        var tgl_input   = $("[data-name='tgl_input']").val();
        var update_by   = "{!! $idn_user->id !!}";
        var table       = "trx_wo";
        var data = {
                id_sto:id_sto,
                tgl_input:tgl_input,
                update_by: update_by
            };

        if (id_sto === '' || tgl_input === '') {
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
                    // Swal.fire({
                    //     position:'center',
                    //     title: 'Success!',
                    //     icon: 'success',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // }).then((data) => {
                    //     location.reload();
                    // })

                    var table       = "trx_sto";
                    var whr         = "id";
                    var id          = id_sto;
                    var dats        = {wo_state:'Done'};

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


</script>
{{-- End JS Input WO --}}

{{-- JS Show data tables --}}
<script>
    // $('#dataTable').DataTable();
    function fetchAndUpdateData(){
       $('#dataTable').DataTable({
           "ajax": {
               "url": "{{route('listdatawo')}}",
               "dataSrc": ""
           },
           "columns": [
               {
                   "data": null,
                   "render": function (data, type, row, meta) {
                       // Menggunakan meta.row untuk mendapatkan nomor urut
                       return meta.row + 1;
                   }
               },
               { "data":"so_no"},
               { "data":"pt_no"},
               { 
                    // "data":"wo_state"
                    "data": "wo_state",
                    "render": function (data, type, row, meta) {
                    // Menggunakan meta.row untuk mendapatkan nomor urut
                        if(data === "Done"){
                            return "Finished";
                        }else{
                            return data;
                        }
                    
                    }
                },
               { "data":"wo_date"},
               { "data":"do_no"},
               { 
                    // "data":"do_state"
                    "data": "do_state",
                    "render": function (data, type, row, meta) {
                    // Menggunakan meta.row untuk mendapatkan nomor urut
                        if(data === "Done"){
                            return "Delivered";
                        }else{
                            return data;
                        }
                    
                    }
                },
               { "data":"tgl_upload"},
               // Tambahkan kolom sesuai kebutuhan Anda
           ],
           rowCallback: function (row, data) {
            // Add your logic to determine the class name based on the data
            var className       = 'action-input';
            var attributeName   = 'data-item';
            var attributeValue  = data.id+','+data.so_no+','+data.pt_no+','+data.wo_state+','+data.wo_date;
            // Add the class to the <tr> element
            $(row).addClass(className);
            $(row).attr(attributeName, attributeValue);
        }
       });
   }
</script>
{{--  End JS Show data tables --}}

<script>
    $('[data-name="date_range"]').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
    $('[data-name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        var start       = picker.startDate.format('YYYY-MM-DD');
        var end         = picker.endDate.format('YYYY-MM-DD');
    });
</script>

<script>
    $('input[data-name="tgl_input"]').datepicker({
        format: "yyyy-mm-dd",
        viewMode: "days",
        minViewMode: "days",
        autoclose: true
    });
</script>

<script>
    $(".select2-mc").select2({
        allowClear: false,
        width: '100%'
    });
</script>

<script>
    $(".select2-add").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $("#input")
    });
</script>

@stop