@extends('layouts.AdminLTE.index')

@section('icon_page', 'dashboard')

@section('title', 'Dashboard ')

@section('menu_pagina')	

@section('content')
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $variantcount }}</h3>

          <p>Variation Data Count</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-car"></i>
        </div>
        <a href="{{ route('vlfdata') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
        <a href="{{ route('vlfdata') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $withoutgains }}</h3>

          <p>Total Records Without Gains Data</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-speedometer"></i>
        </div>
        <a href="{{ route('vlfdata') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $totalrecords }}</h3>

          <p>Total VLF Records</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-bus"></i>
        </div>
        <a href="{{ route('vlfdata') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        <td> <span class="label label-success">{{ $newupdate->title }}</span> </td>             
                        <td>{{ $newupdate->SKU }}</td> 
                        <td>{{ $newupdate->price }}</td>
                        <td><span class="badge badge-secondary">{{ $newupdate->variant }}</span></td>
                        <!-- <td>{{ $newupdate->fuel_type }}</td> -->
                        <td class="text-center">
                        @if ($newupdate->fuel_type == 'Petrol')
                            <span class="badge badge-primary">{{ $newupdate->fuel_type }}</span>
                        @endif
                        @if ($newupdate->fuel_type == 'Diesel')
                            <span class="badge badge-secondary">{{ $newupdate->fuel_type }}</span>
                        @endif
                        </td>
                        <td>{{ $newupdate->k_type }}</td>
                        <td>{{ $newupdate->original_bhp }}</td>
                        <td>{{ $newupdate->original_torque }}</td>
                        <td><span class="badge badge-secondary">{{ $newupdate->power_bhp }}</span></td>
                        <td><span class="badge badge-secondary">{{ $newupdate->torque_nm }}</span></td>
                        <td class="text-center"><span class="label label-success">{{ $newupdate->updated_at->format('d/m/Y H:i') }}</span></td>             
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
                    <th>Updated</th>
                    <!-- <th class="text-center">Actions</th>			  -->
                  </tr>
                </thead>
                <tbody>
                  @foreach($newuploads as $newupload)
                      <tr>
                        <td> <span class="label label-success">{{ $newupload->title }}</span> </td>             
                        <td>{{ $newupload->SKU }}</td> 
                        <td>{{ $newupload->price }}</td>
                        <td><span class="badge badge-secondary">{{ $newupload->variant }}</span></td>
                        <!-- <td>{{ $newupdate->fuel_type }}</td> -->
                        <td class="text-center">
                        @if ($newupload->fuel_type == 'Petrol')
                            <span class="badge badge-primary">{{ $newupload->fuel_type }}</span>
                        @endif
                        @if ($newupload->fuel_type == 'Diesel')
                            <span class="badge badge-secondary">{{ $newupload->fuel_type }}</span>
                        @endif
                        </td>
                        <td>{{ $newupload->k_type }}</td>
                        <td>{{ $newupload->original_bhp }}</td>
                        <td>{{ $newupload->original_torque }}</td>
                        <td><span class="badge badge-secondary">{{ $newupload->power_bhp }}</span></td>
                        <td><span class="badge badge-secondary">{{ $newupload->torque_nm }}</span></td>
                        <td class="text-center"><span class="label label-success">{{ $newupload->updated_at->format('d/m/Y H:i') }}</span></td>             
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
@endsection