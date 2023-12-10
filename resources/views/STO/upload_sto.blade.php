@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row align-items-top">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>After STO WO-DO</span>

                        <div>
                            <button type="button" class="btn btn-primary" data-name="export">Export STO WO-DO</button>
                            <button type="button" class="btn btn-success" data-name="add">Upload After STO WO-DO</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div id="successMessage" class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">SO NO</th>
                                    <th scope="col">PT NO</th>
                                    <th scope="col">WO STATE</th>
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

{{-- Modal Upload STO --}}
<form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="input" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload STO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">File Excel</label>
                            <div class="input-group">
                                <input type="file" name="file" id="file" class="form-control">
                                <span class="input-group-text" id="basic-addon2"><i class="bi bi-file-earmark-excel-fill"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- End Modal Upload STO --}}

{{-- Modal Export STO WO DO --}}
<div class="modal fade" id="export_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Export STO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label">Date</label>
                        <div class="input-group">
                            <input type="date_export" name="date_export" id="date_export" class="form-control">
                            <input type="hidden" id="start_export">
                            <input type="hidden" id="end_export">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-event-fill"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="action_export">Export</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Export STO WO DO --}}

<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $('#file').val('');
        $("#input").modal('show');
    });

    $(document).on("click", "[data-name='export']", function (e) {
        $('#date_export').val('');
        $("#export_modal").modal('show');
    });

    $(document).on("click", "[type='submit']", function (e) {
        $(".preload-wrapper").css("display", "block");
    });

    $(document).ready(function() {
        setTimeout(fetchAndUpdateData);
    });
</script>

{{-- JS Show data tables --}}
<script>
    // $('#dataTable').DataTable();
    function fetchAndUpdateData(){
       $('#dataTable').DataTable({
           "ajax": {
               "url": "{{route('listdatasto')}}",
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
               { "data":"wo_state"},
               { "data":"do_no"},
               { "data":"do_state"},
               { "data":"tgl_upload"},
               // Tambahkan kolom sesuai kebutuhan Anda
           ]
       });
   }
</script>
{{--  End JS Show data tables --}}

{{-- JS Export STO --}}
<script>
    $(document).on("click", "[data-name='action_export']", function (e) {
        var start_export        = $('#start_export').val();
        var end_export          = $('#end_export').val();
        var parse               = start_export+','+end_export;
        var url                 = '{{ route("exportsto", ":param") }}';
        url                     = url.replace(':param', parse);

        window.location.href = url;
    });
</script>
{{-- End JS Export STO --}}

<script>
    $('#date_export').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
    $('#date_export').on('apply.daterangepicker', function(ev, picker) {
        var start       = picker.startDate.format('YYYY-MM-DD');
        var end         = picker.endDate.format('YYYY-MM-DD');

        $('#start_export').val(start);
        $('#end_export').val(end);
    });
</script>

<script>
    $('input[data-name="date"]').datepicker({
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
        dropdownParent: $("#add_schedule")
    });
</script>

@stop