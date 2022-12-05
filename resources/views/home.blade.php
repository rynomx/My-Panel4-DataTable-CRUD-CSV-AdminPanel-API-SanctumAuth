@extends('layouts.AdminLTE.index')

@section('icon_page', 'dashboard')

@section('title', 'Dashboard ')

@section('menu_pagina')	

@section('content')
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $variantcount }}</h3>

          <p>Child Data Count</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-car"></i>
        </div>
        <!-- <a href="{{ route('vlfdata') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
          <h3>{{ $modelcount }}</h3>

          <p> Vehicle Models Count</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-speedometer-outline"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      @if ($withoutgains == 0)
        <div class="small-box bg-green">
      @else
        <div class="small-box bg-red">
      @endif
        <div class="inner">
          <h3>{{ $withoutgains }}</h3>

          <p>Total Records Without Gains Data</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-speedometer"></i>
        </div>
        <a onClick="nogains()" href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $totalrecords }}</h3>

          <p>Total VLF Records</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-bus"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row ///////////////////// -->

  
  <div class="row">

      <!-- UPDATE List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>

          <h3 class="box-title">Recent VLF Updates</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
              <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                <thead>
                  <tr>			 
                    <th>Name</th>	
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Variant</th>
                    <th>Fuel Type</th>	
                    <th>K-Type</th>	
                    <th>Eco.BHP</th>	
                    <th>Eco.NM</th>	
                    <th>Fuel.Saving</th>	
                    <th>Ori.BHP</th>
                    <th>Ori.NM</th>
                    <th>Power.BHP</th>
                    <th>Torque.NM</th>
                    <th>Updated</th>
                    <!-- <th class="text-center">Actions</th>			  -->
                  </tr>
                </thead>
                <tbody>
                  @foreach($newupdates as $newupdate)
                    
                      <tr>
                        <td><a href="javascript:void(0)" data-toggle="tooltip" onClick="getMotherChild({{ $newupdate->id }})" data-original-title="View" class="btn btn-secondary">
                           <b>{{ $newupdate->title }}</b> </a> </td>             
                        <td>{{ $newupdate->SKU }}</td> 
                        <td>{{ $newupdate->price }}</td>
                        <td><span class="badge ">{{ $newupdate->variant }}</span></td>

                        <!-- <td>{{ $newupdate->fuel_type }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->fuel_type == 'Petrol')
                            <span class="badge btn-primary">{{ $newupdate->fuel_type }}</span>
                        @endif
                        @if ($newupdate->fuel_type == 'Diesel')
                            <span class="badge badge-secondary">{{ $newupdate->fuel_type }}</span>
                        @endif
                        </td>

                        <!-- <td>{{ $newupdate->k_type }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->k_type == 'nan' || $newupdate->k_type == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            {{ $newupdate->k_type }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupdate->economy_gain_bhp }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->economy_gain_bhp == '0' || $newupdate->economy_gain_bhp == '')
                            <span class="badge btn-warning">?</span>
                        @else
                            {{ $newupdate->economy_gain_bhp }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupdate->economy_gain_nm }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->economy_gain_nm == '0' || $newupdate->economy_gain_nm == '')
                            <span class="badge btn-warning">?</span>
                        @else
                            {{ $newupdate->economy_gain_nm }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupdate->fuel_saving }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->fuel_saving == '0' || $newupdate->fuel_saving == '')
                            <span class="badge btn-warning">?</span>
                        @else
                            {{ $newupdate->fuel_saving }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupdate->original_bhp }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->original_bhp == '0' || $newupdate->original_bhp == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            {{ $newupdate->original_bhp }}
                        @endif
                        </td>
                        
                        <!-- <td>{{ $newupdate->original_torque }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->original_torque == '0' || $newupdate->original_torque == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            {{ $newupdate->original_torque }} 
                        @endif
                        </td>

                        <!-- <td><span class="badge badge-secondary">{{ $newupdate->power_bhp }}</span></td> -->
                        <td class="text-center">
                        @if ($newupdate->power_bhp == '0' || $newupdate->power_bhp == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            <span class="badge ">{{ $newupdate->power_bhp }}</span>
                        @endif
                        </td>

                        <!-- <td><span class="badge badge-secondary">{{ $newupdate->torque_nm }}</span></td> -->
                        <td class="text-center">
                        @if ($newupdate->torque_nm == '0' || $newupdate->torque_nm == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            <span class="badge ">{{ $newupdate->torque_nm }}</span>
                        @endif
                        </td>
                        <td class="text-center">{{ $newupdate->updated_at->format('d/m/Y H:i') }}</td>             
                      </tr>

                  @endforeach
                </tbody>
                <tfoot>
                  <tr>		 
                    <th></th>			 
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>			 
                    <th class="text-center"></th>			 
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>


  <div class="row">

      <!-- NEW List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>

          <h3 class="box-title">NEW VLF Uploads</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
              <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                <thead>
                  <tr>			 
                    <th>Name</th>	
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Variant</th>
                    <th>Fuel Type</th>	
                    <th>K-Type</th>	
                    <th>Ori.BHP</th>
                    <th>Ori.NM</th>
                    <th>Power.BHP</th>
                    <th>Torque.NM</th>
                    <th>Created</th>
                    <!-- <th class="text-center">Actions</th>			  -->
                  </tr>
                </thead>
                <tbody>
                  @foreach($newuploads as $newupload)
                  <tr>
                        <td> <b>{{ $newupload->title }}</b> </td>             
                        <td>{{ $newupload->SKU }}</td> 
                        <td>{{ $newupload->price }}</td>
                        <td><span class="badge ">{{ $newupload->variant }}</span></td>

                        <!-- <td>{{ $newupload->fuel_type }}</td> -->
                        <td class="text-center">
                        @if ($newupload->fuel_type == 'Petrol')
                            <span class="badge btn-primary">{{ $newupload->fuel_type }}</span>
                        @endif
                        @if ($newupload->fuel_type == 'Diesel')
                            <span class="badge badge-secondary">{{ $newupload->fuel_type }}</span>
                        @endif
                        </td>

                        <!-- <td>{{ $newupload->k_type }}</td> -->
                        <td class="text-center">
                        @if ($newupload->k_type == 'nan' || $newupload->k_type == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            {{ $newupload->k_type }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupload->economy_gain_bhp }}</td> -->
                        <td class="text-center">
                        @if ($newupload->economy_gain_bhp == '0' || $newupload->economy_gain_bhp == '')
                            <span class="badge btn-warning">?</span>
                        @else
                            {{ $newupload->economy_gain_bhp }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupload->economy_gain_nm }}</td> -->
                        <td class="text-center">
                        @if ($newupload->economy_gain_nm == '0' || $newupload->economy_gain_nm == '')
                            <span class="badge btn-warning">?</span>
                        @else
                            {{ $newupload->economy_gain_nm }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupdate->fuel_saving }}</td> -->
                        <td class="text-center">
                        @if ($newupload->fuel_saving == '0' || $newupload->fuel_saving == '')
                            <span class="badge btn-warning">?</span>
                        @else
                            {{ $newupload->fuel_saving }}
                        @endif
                        </td>

                        <!-- <td>{{ $newupload->original_bhp }}</td> -->
                        <td class="text-center">
                        @if ($newupload->original_bhp == '0' || $newupload->original_bhp == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            {{ $newupload->original_bhp }}
                        @endif
                        </td>
                        
                        <!-- <td>{{ $newupload->original_torque }}</td> -->
                        <td class="text-center">
                        @if ($newupload->original_torque == '0' || $newupload->original_torque == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            {{ $newupload->original_torque }} 
                        @endif
                        </td>

                        <!-- <td><span class="badge badge-secondary">{{ $newupload->power_bhp }}</span></td> -->
                        <td class="text-center">
                        @if ($newupload->power_bhp == '0' || $newupload->power_bhp == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            <span class="badge ">{{ $newupload->power_bhp }}</span>
                        @endif
                        </td>

                        <!-- <td><span class="badge badge-secondary">{{ $newupload->torque_nm }}</span></td> -->
                        <td class="text-center">
                        @if ($newupload->torque_nm == '0' || $newupload->torque_nm == '')
                            <span class="badge btn-danger">?</span>
                        @else
                            <span class="badge ">{{ $newupload->torque_nm }}</span>
                        @endif
                        </td>

                        <td class="text-center">{{ $newupload->created_at->format('d/m/Y H:i') }}</td>             
                      </tr>

                  @endforeach
                </tbody>
                <tfoot>
                  <tr>		 
                    <th></th>			 
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>			 
                    <th class="text-center"></th>			 
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>
      
  <div class="row">

    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">

      <!-- Map box -->
       
      <!-- /.box -->

      <!-- solid sales graph -->
      
      <!-- /.box -->

      <!-- Calendar -->
      
      <!-- /.box -->

    </section>
    <!-- right col -->
  </div>
  <!-- /.row -->
  <!-- /.row /////////////////////-->

  <!-- boostrap vlf noGains -->
  <div class="modal fade" id="noGains-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="noGainsModal"></h4>
        </div>
        <div class="modal-body">

            <div class="box-body">
              <div class="table-responsive">
                  <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                    <thead>
                      <tr>			 
                        <th>Name</th>	
                        <th>SKU</th>
                        <th>Variant</th>
                        <th>Fuel Type</th>	
                        <th width="50px">K-Type</th>	
                        <th>Ori.BHP</th>
                        <th>Ori.NM</th>
                        <th>Power.BHP</th>
                        <th>Torque.NM</th>
                        <!-- <th>Updated</th> -->
                        <!-- <th class="text-center">Actions</th>			  -->
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($nogains as $nogain)
                          <tr>
                            <td> {{ $nogain->title }} </td>             
                            <td>{{ $nogain->SKU }}</td> 
                            <td>{{ $nogain->variant }}</td>
                            <td>{{ $nogain->fuel_type }}</td>
                            <td>{{ $nogain->k_type }}</td>
                            <td>{{ $nogain->original_bhp }}</td>
                            <td>{{ $nogain->original_torque }}</td>
                            <td>{{ $nogain->power_bhp }}</td>
                            <td>{{ $nogain->torque_nm }}</td>
                            <!-- <td class="text-center">{{ $nogain->updated_at->format('d/m/Y H:i') }}</td>              -->
                          </tr>
                      @endforeach
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

  <!-- boostrap vlf Mother and child data -->
  <div class="modal fade" id="motherChild-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="motherChildModal"></h4>
        </div>
        <div class="modal-body">

            <div class="box-body">
              <div class="table-responsive">
                  <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                    <tbody>                        
                        <tr><td>Title<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="title" name="title"> </td> 
                            <td>SKU<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="SKU" name="SKU"> </td>
                        </tr>         
                        <tr><td>Parent SKU<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="parent_SKU" name="parent_SKU"> </td>
                            <td>Vehicle Type<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="vehicle_type" name="vehicle_type"> </td>
                        </tr>
                        <tr><td>Vehicle Make<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="vehicle_make" name="vehicle_make"> </td>
                            <td>Vehicle Model<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="vehicle_model" name="vehicle_model"> </td>
                        </tr>
                        <tr><td>Variant<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="variant" name="variant"> </td>
                            <td>VLF Type<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="vlf_type" name="vlf_type"> </td>
                        </tr>
                        <tr><td>Fuel Type<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="fuel_type" name="fuel_type"> </td>
                            <td>Regular Price<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="price" name="price"> </td>
                        </tr>
                        <tr><td>K-Type<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="k_type" name="k_type"> </td>
                            
                        </tr>
                        <tr><td>Economy Gain Torque<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="economy_gain_nm" name="economy_gain_nm"> </td>
                            <td>Fuel Saving<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="fuel_saving" name="fuel_saving"> </td>
                        </tr>
                        <tr><td>Original BHP<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="original_bhp" name="original_bhp"> </td>
                            <td>Original Torque<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="original_torque" name="original_torque"> </td>
                        </tr>
                        <tr><td>Power BHP<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="power_bhp" name="power_bhp"> </td>
                            <td>Torque NM<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="torque_nm" name="torque_nm"> </td>
                        </tr>
                        <tr><td>VSwitch Support<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="vswitch_support" name="vswitch_support"> </td>
                            <td>Economy Gain BHP<input readonly="readonly" type="text" style="background-color:#184562; color:#fff" class="form-control" id="economy_gain_bhp" name="economy_gain_bhp"> </td>
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

    function getMotherChild(id){
      $.ajax({
        type:"POST",
        url: "{{ url('parentdata') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
          $('#motherChildModal').html("View VLF");
          $('#motherChild-modal').modal('show');
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

    // function getMotherChild(){
    //     $('#motherChildModal').html("Full Data");
    //     $('#motherChild-modal').modal('show');
    // } 

    function nogains(){
        $('#noGainsModal').html("Records Without Gains");
        $('#noGains-modal').modal('show');
    } 

  </script>



@endsection