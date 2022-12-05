@extends('layouts.AdminLTE.index')

@section('icon_page', 'gear')

@section('title', 'VLF')

@section('content')
	
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12"> 

                    <!-- <div class="container mt-2"> -->
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                <h2>VLF Database</h2>
                                </div>
                                <div class="pull-right mb-2">
                                <a class="btn btn-primary" onClick="crequest()" href="javascript:void(0)"><i class="fa fa-send"></i> Submit Change Request</a>
                                </div>
                                <div class="pull-right mb-2">
                                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"><i class="fa fa-car"></i> Add VLF Data</a>
                                </div>
                                <div class="pull-right mb-2">
                                <a class="btn btn-warning" onClick="importx()" href="javascript:void(0)"><i class="fa fa-upload"></i> Upload CSV</a>
                                </div>
                                <div class="pull-right mb-2">
                                <a class="btn btn-danger" onClick="exportx()" href="javascript:void(0)"><i class="fa fa-download"></i> Export to CSV</a>
                                </div>
                                
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                            <p>{{ $message }}</p>
                            </div>
                        @endif

                        <p>{{session('status')}}
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive nowrap" id="ajax-crud-datatable" style="width:100%">
                            <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>title</th>
                                        <th>SKU</th>
                                        <th>parent_SKU</th>
                                        <th>vehicle_type</th>
                                        <th>vehicle_make</th>
                                        <th>vehicle_model</th>
                                        <th>variant</th>
                                        <!-- <th>vlf_type</th> -->
                                        <th>fuel_type</th>
                                        <!-- <th>price</th> -->
                                        <!-- <th>k_type</th>
                                        <th>economy_gain_bhp</th>
                                        <th>economy_gain_nm</th>
                                        <th>fuel_saving</th>
                                        <th>original_bhp</th>
                                        <th>original_torque</th>
                                        <th>power_bhp</th>
                                        <th>torque_nm</th>
                                        <th>vswitch_support</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <!-- </div> -->

                    <!-- boostrap vlf model -->
                    <div class="modal fade" id="vlf-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="vlfdataModal"></h4>
                        </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="vlfForm" name="vlfForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">VLF Title</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" maxlength="100" required="">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">SKU</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="SKU" name="SKU" placeholder="Enter SKU" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Parent SKU</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="parent_SKU" name="parent_SKU" placeholder="Enter Parent SKU" maxlength="50" >
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Vehicle Type</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Enter Vehicle Type" maxlength="100" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Vehicle Make</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="vehicle_make" name="vehicle_make" placeholder="Enter Vehicle Make" maxlength="100" required="">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Vehicle Model</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" placeholder="Enter Vehicle Model" maxlength="100" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Variant</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="variant" name="variant" placeholder="Enter Variant" maxlength="50" >
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">VLF Type</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="vlf_type" name="vlf_type" placeholder="variable or variant" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Fuel Type</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Diesel or Petrol" maxlength="50">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" maxlength="50" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">K-Type</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="k_type" name="k_type" placeholder="Enter K-Type" maxlength="500" >
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Economy Gain BHP</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="economy_gain_bhp" name="economy_gain_bhp" placeholder="Enter Economy Gain BHP" maxlength="100" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Economy Gain NM</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="economy_gain_nm" name="economy_gain_nm" placeholder="Enter Economy Gain NM" maxlength="100">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Fuel Saving</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="fuel_saving" name="fuel_saving" placeholder="Enter Fuel Saving" maxlength="100" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Original BHP</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="original_bhp" name="original_bhp" placeholder="Enter Original BHP" maxlength="100" >
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Original Torque</label>
                                <div class="col-sm-12">
                                <input type="txt" class="form-control" id="original_torque" name="original_torque" placeholder="Enter Original Torque" maxlength="100" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Power BHP</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="power_bhp" name="power_bhp" placeholder="Enter Power BHP" maxlength="100" >
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Torque NM</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="torque_nm" name="torque_nm" placeholder="Enter Torque NM" maxlength="100" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">VSwitch Support</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="vswitch_support" name="vswitch_support" placeholder="Enter VSwitch Support" maxlength="150" >
                                </div>
                            </div>  
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save">Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                    </div>
                    </div>
                    </div>
                    <!-- end bootstrap model -->


                    <!-- boostrap vlf import -->
                    <div class="modal fade" id="vlfimport-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                <h4 class="modal-title" id="vlfimportModal"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <form action="javascript:void(0)" id="vlfimportForm" name="vlfForm" class="form-horizontal" method="POST" enctype="multipart/form-data"> -->
                                    <!-- <p>{{session('status')}} -->
                                    <form method="POST" action="{{ url("vlfdata") }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">VLF Title</label>
                                            <div class="col-sm-12">
                                            <input type="file" class="form-control" id="file" name="file" placeholder="Upload CSV - VLF File" required="">
                                            </div>
                                        </div>  

                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-warning" id="btn-save"><i class="fa fa-upload"></i>Upload VLF
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end bootstrap model -->

                    <!-- boostrap vlf export -->
                    <div class="modal fade" id="vlfexport-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                <h4 class="modal-title" id="vlfexportModal"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <form action="javascript:void(0)" id="vlfimportForm" name="vlfForm" class="form-horizontal" method="POST" enctype="multipart/form-data"> -->
                                    <!-- <p>{{session('status')}} -->
                                    <form method="POST" action="{{ url("vlfdata") }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="col-sm-offset-5 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-danger" id="btn-exportx"><i class="fa fa-download"></i>. Export to CSV
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end bootstrap model -->

                    <!-- boostrap change request model -->
                    <div class="modal fade" id="crequest-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="crequestModal"></h4>
                        </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="crequestForm" name="crequestForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <!-- <input type="hidden" name="id" id="id">
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="hidden" name="user_email" id="user_email"> -->
                            <div class="form-group">
                                <label for="name" class="col-sm-1 control-label">Type</label>
                                <div class="col-sm-12">
                                    <select id="type" name="type" class="form-control" size="4" aria-label="Request Type">
                                        <option selected value="General Request">General Request</option>
                                        <option value="Platform Related">Platform Related</option>
                                        <option value="Data Related">Data Related</option>
                                        <option value="Access Related">Access Related</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="name" class="col-sm-1 control-label">Description</label>
                                <div class="col-sm-12">
                                <textarea style="height: 100px;"  class="form-control" id="description" name="description" maxlength="3000" required=""></textarea>
                                </div>
                            </div>
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-cr-save"><i class="fa fa-send"></i>Send Request
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                    </div>
                    </div>
                    </div>
                    <!-- end bootstrap model -->

                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
 
    <script type="text/javascript">
    $(document).ready( function () {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('vlfdata') }}",
        columns: [
            { data: 'id', name: 'id' },
            //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'SKU', name: 'SKU'},
            {data: 'parent_SKU', name: 'parent_SKU'},
            {data: 'vehicle_type', name: 'vehicle_type'},
            {data: 'vehicle_make', name: 'vehicle_make'},
            {data: 'vehicle_model', name: 'vehicle_model'},
            {data: 'variant', name: 'variant'},
            // {data: 'vlf_type', name: 'vlf_type'},
            {data: 'fuel_type', name: 'fuel_type'},
            // {data: 'price', name: 'price'},
            // {data: 'k_type', name: 'k_type'},
            // {data: 'economy_gain_bhp', name: 'economy_gain_bhp'},
            // {data: 'economy_gain_nm', name: 'economy_gain_nm'},
            // {data: 'fuel_saving', name: 'fuel_saving'},
            // {data: 'original_bhp', name: 'original_bhp'},
            // {data: 'original_torque', name: 'original_torque'},
            // {data: 'power_bhp', name: 'power_bhp'},
            // {data: 'torque_nm', name: 'torque_nm'},
            // {data: 'vswitch_support', name: 'vswitch_support'},
            // {data: 'perm_type', name: 'perm_type'},
            // {data: 'perm_make', name: 'perm_make'},
            // {data: 'perm_model', name: 'perm_model'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
            //{data: 'action', name: 'action', orderable: false},
        ]
        //order: [[0, 'desc']]
    });
    });

    function add(){
        $('#vlfForm').trigger("reset");
        $('#vlfdataModal').html("Add VLF Data");
        $('#vlf-modal').modal('show');
        $('#id').val('');
    }   

    function importx(){
        $('#vlfimportModal').html("Upload CSV");
        $('#vlfimport-modal').modal('show');
    }   

    function exportx(){
        $('#vlfexportModal').html("Are you sure you want to Export to CSV?");
        $('#vlfexport-modal').modal('show');
    }  

    $('#btn-exportx').click(function() {
        $('#vlfexport-modal').modal('hide');

    });

    function editFunc(id){
            $.ajax({
                type:"POST",
                url: "{{ url('editvlf') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#vlfdataModal').html("Edit VLF");
                    $('#vlf-modal').modal('show');
                    $('#id').val(res.id);
                    $('#title').val(res.title);
                    $('#SKU').val(res.SKU);
                    $('#parent_SKU').val(res.parent_SKU);
                    $('#parent_id').val(res.parent_id);
                    $('#vehicle_type').val(res.vehicle_type);
                    $('#vehicle_make').val(res.vehicle_make);
                    $('#vehicle_model').val(res.vehicle_model);
                    $('#variant').val(res.variant);
                    $('#vlf_type').val(res.vlf_type);
                    $('#fuel_type').val(res.fuel_type);
                    $('#price').val(res.price);
                    $('#k_type').val(res.k_type);
                    $('#economy_gain_bhp').val(res.economy_gain_bhp);
                    $('#economy_gain_nm').val(res.economy_gain_nm);
                    $('#fuel_saving').val(res.fuel_saving);
                    $('#original_bhp').val(res.original_bhp);
                    $('#original_torque').val(res.original_torque);
                    $('#power_bhp').val(res.power_bhp);
                    $('#torque_nm').val(res.torque_nm);
                    $('#vswitch_support').val(res.vswitch_support);
                }
            });
        }


    function deleteFunc(id){
        if (confirm("You are about to Delete a VLF Record!") == true) {
            var id = id;
            // ajax
            $.ajax({
            type:"POST",
            url: "{{ url('deletevlf') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            }
            });
        }
    }

    $('#vlfForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ url('storevlf')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#vlf-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
            console.log(data);
            }
        });
    });

    function crequest(){
        $('#crequestForm').trigger("reset");
        $('#crequestModal').html("Send Change Request");
        $('#crequest-modal').modal('show');
    } 

    $('#crequestForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ url('change-request/store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#crequest-modal").modal('hide');
                $("#btn-cr-save").html('Submit');
                $("#btn-cr-save"). attr("disabled", false);
            },
            error: function(data){
            console.log(data);
            }
        });
    })


    </script>

@endsection