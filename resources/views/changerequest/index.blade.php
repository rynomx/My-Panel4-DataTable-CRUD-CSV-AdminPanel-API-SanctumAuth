@extends('layouts.AdminLTE.index')

@section('icon_page', 'user')

@section('title', 'Change Request')

@section('menu_pagina')	
		
	<li role="presentation">
		<!-- <a href="{{ route('change-request.create') }}" class="link_menu_page">
			<i class="fa fa-plus"></i> Submit Change Request
		</a>								 -->
	</li>

@endsection

@section('content')    
        
    <div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>			 
                                    <th>User</th>		 
									<th>Type</th>
                                    <th>Description</th>
									<th class="text-center">Status</th>
									<th class="text-center">Created</th>			 
									<th class="text-center">Actions</th>			 
								</tr>
							</thead>
							<tbody>
								@foreach($crequests as $crequest)
										<tr>
											<td>{{ $crequest->user_email }}</td>             
											<td>{{ $crequest->type }}</td>
                                            <td>{{ $crequest->description }}</td>  
											<td class="text-center">
												@if($crequest->status == '1')
													<span class="label label-success">Approved</span>
												@elseif($crequest->status == '3')
													<span class="label label-default">Denied</span>
                                                @elseif($crequest->status == '0')
													<span class="label label-danger">Under Review</span>
												@endif
											</td>             
											<td class="text-center">{{ $crequest->created_at->format('d/m/Y H:i') }}</td>             
											<td class="text-center"> 
												 <a href="javascript:void(0)" data-toggle="tooltip" onClick="viewcr({{ $crequest->id }})" data-original-title="View" class="btn btn-default  btn-xs" title="View Request">
                                                    <i class="fa fa-eye">   </i>View</a>
												 <a href="javascript:void(0)" data-toggle="tooltip" onClick="deletecr({{ $crequest->id }})" data-original-title="Delete" class="btn btn-danger  btn-xs" title="Delete Request" >
                                                    <i class="fa fa-trash"></i>Delete</a>
                                                @if($crequest->status == '0')
                                                <a href="javascript:void(0)" data-toggle="tooltip" onClick="approvecr({{ $crequest->id }})" data-original-title="Approve" class="btn btn-success  btn-xs" title="Approve Request">
                                                    <i class="fa fa-pencil"></i>Approve</a>
												@endif
                                                @if($crequest->status != '3')
                                                <a href="javascript:void(0)" data-toggle="tooltip" onClick="denycr({{ $crequest->id }})" data-original-title="Deny Approval Request" class="btn btn-success  btn-xs" title="Deny Approval Request">
                                                    <i class="fa fa-pencil"></i>Deny</a>
												@endif
											</td> 
										</tr>

                                        <!-- delete modal -->
										<!-- <div class="modal fade" id="modal-delete-{{ $crequest->id }}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
													</div>
													<div class="modal-body">
														<p>Do you really want to delete?</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
														<a href="{{ route('change-request.destroy', $crequest->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
													</div>
												</div>
											</div>
										</div> -->
                                        

								@endforeach
							</tbody>
							<!-- <tfoot>
								<tr>		 
									<th>Name</th>			 
									<th>E-mail</th>
									<th class="text-center">Status</th>
									<th class="text-center">Created</th>			 
									<th class="text-center">Actions</th>			 
								</tr>
							</tfoot> -->
						</table>
					</div>

                    <!-- boostrap vlf view change request -->
                    <div class="modal fade" id="crequest-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title" id="crequestModal"></h4>
                                </div>
                                <div class="modal-body">

                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                                                <tbody>                        
                                                    <tr><td>Type<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="type" name="type"> </td> 
                                                    </tr>         
                                                    <tr><td>
                                                            <label for="name" class="col-sm-1 control-label">Description</label>
                                                            <div class="col-sm-12">
                                                                <textarea readonly="readonly" style="height: 300px; background-color:#184562; color:#fff"  class="form-control" id="description" name="description" ></textarea>
                                                            </div>
                                                            </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end bootstrap model -->

				</div>				
				<div class="col-md-12 text-center">
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

        });

        function viewcr(id){
            $.ajax({
                type:"GET",
                url: "{{ url('change-request/show') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#crequestModal').html("Request Details");
                    $('#crequest-modal').modal('show');
                    $('#type').val(res.type);
                    $('#description').val(res.description);
                }
            });
        }  

        function deletecr(id){
            if (confirm("You are about to Delete a Change Request!") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type:"GET",
                    url: "{{ url('change-request/destroy') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        location.href = "{{ url('change-request') }}";
                    }
                });
            }
        }

        function approvecr(id){
            if (confirm("You are you sure this requires approval?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type:"PUT",
                    url: "{{ url('change-request/approval') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        location.href = "{{ url('change-request') }}";
                    }
                });
            }
        }

        function denycr(id){
            if (confirm("You are you sure you want to Deny Approval?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type:"PUT",
                    url: "{{ url('change-request/denial') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        location.href = "{{ url('change-request') }}";
                    }
                });
            }
        }

    </script>

@endsection

@include('layouts.AdminLTE._includes._data_tables')