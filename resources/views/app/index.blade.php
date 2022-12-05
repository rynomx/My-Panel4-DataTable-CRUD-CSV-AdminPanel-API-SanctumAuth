@section('title', 'VLF LOOKUP')
@section('layout_css')
    <style>
        #box-login-personalize{
            width: 360px;
            margin: 3% auto;
        }
    </style>
@stop

<!DOCTYPE html>
<html lang="en">
    <head>

        @include('layouts.AdminLTE._includes._app_head')

    </head>
    <body style="background-color:rgb(21 64 104); color:#fff;" class="hold-transition login-page">
        <div id="box-login-personalize">
            <div class="login-logo">
                <div class="pull-right mb-2">
                    <a class="btn btn-warning" onClick="signin()" href="javascript:void(0)"><i class="fa fa-user"></i><b> Sign In </b></a>
                </div>
                <div class="mb-2">
                    @if(\App\Models\Config::find(1)->img_login == 'T')
                        <img height="50" width="50" src="{{ asset(\App\Models\Config::find(1)->caminho_img_login) }}" width="{{ \App\Models\Config::find(1)->tamanho_img_login }}%"/>
                        <br/>
                    @endif
                    VIEZU <b> APP </b>   
                </div>         
            </div>
            
            <div class="login-box-body">
                <p class="login-box-msg"><b>SELECT VEHICLE DATA</b></p>
                <form  method="POST" action="{{ route('app') }}">
                    @csrf

                    <div class="form-group mb-2 has-feedback">
                        <select id="vehicle-type" name="vehicle-type" class="cust-selectbox form-control" required>
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->vehicle_type }}">{{ $type->vehicle_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2" id="set-vehicle-make">
                        <select  class="cust-selectbox form-control" name="vehicle-make" id="vehicle-make" required>
                            <option value="">Select Make</option>
                        </select>
                    </div>

                    <div class="form-group mb-2" id="set-vehicle-model">
                        <select  class="cust-selectbox form-control" name="vehicle-model" id="vehicle-model" required>
                            <option value="">Select Model</option>
                        </select>
                    </div>

                    <div class="form-group mb-2" id="set-vehicle-fuel-type">
                        <select  class="cust-selectbox form-control" name="vehicle-fuel-type" id="vehicle-fuel-type" required>
                            <option value="">Select Fuel Type</option>
                        </select>
                    </div>

                    <div class="form-group mb-2" id="set-vehicle-variant">
                        <select  class="cust-selectbox form-control" name="vehicle-variant" id="vehicle-variant" required>
                            <option value="">Select Variant</option>
                        </select>
                    </div>

                    <div class="form-group " id="">
                        <button type="submit" style="width:100%;" class="btn btn-success" >
                            <span class="vehica-button__text"><i class="fa fa-search"></i><b> Show Gains </b></span>
                        </button>
                        <!-- <button type="button" class="vehica-button btn-block" id ="reset-filter" >
                            <span class="vehica-button__text">Reset</span>
                        </button> -->
                    </div>

                    <!-- <div class="row"> 
                        <div class="col-xs-12">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Show Gains</button>
                        </div>  
                    </div>    -->
                                   
                </form> 
            </div>
            <br>
            <div class="login-box-body">
                <p class="login-box-msg"><b>ENTER VEHICLE REGISTRATION [GB]</b></p>
                <form  method="POST" action="{{ route('app') }}">
                    @csrf

                    <div class="form-group mb-2">
                        <input id="reg" type="text" class="form-control" placeholder="Vehicle Registration" name="reg" autofocus required="" AUTOCOMPLETE='on'>
                    </div>

                    <div class="form-group " id="">
                        <button type="submit" style="width:100%;" class="btn btn-success" >
                            <span class="vehica-button__text"><i class="fa fa-search"></i><b> Show Gains </b></span>
                        </button>
                    </div>

                                   
                </form> 
            </div>

        </div>

        @include('layouts.AdminLTE._includes._app_script_footer')

        <script type="text/javascript">
            
            $(document).ready( function () {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

            });

            // Type Change
            $('#vehicle-type').change(function(){

                // Type
                var vehicle_type = $(this).val();

                // Empty the dropdown
                $('#vehicle-make').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: "{{ url('app/lookup/make') }}/"+vehicle_type,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){

                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                        // Read data and create <option >
                            for(var i=0; i<len; i++){

                                // var perm_make = response['data'][i].perm_make;
                                var vehicle_make = response['data'][i].vehicle_make;

                                var option = "<option value='"+vehicle_make+"'>"+vehicle_make+"</option>"; 

                                $("#vehicle-make").append(option); 
                            }
                        }

                    }
                });
            });

            // Make Change
            $('#vehicle-make').change(function(){

                var vehicle_make = $(this).val();

                // Empty the dropdown
                $('#vehicle-model').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: "{{ url('app/lookup/model') }}/"+vehicle_make,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){

                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                        // Read data and create <option >
                            for(var i=0; i<len; i++){

                                var vehicle_model = response['data'][i].vehicle_model;

                                var option = "<option value='"+vehicle_model+"'>"+vehicle_model+"</option>"; 

                                $("#vehicle-model").append(option); 
                            }
                        }

                    }
                });
            });

            // Model Change
            $('#vehicle-model').change(function(){

            var vehicle_model = $(this).val();

            // Empty the dropdown
            $('#vehicle-fuel-type').find('option').not(':first').remove();

            // AJAX request 
            $.ajax({
                url: "{{ url('app/lookup/fueltype') }}/"+vehicle_model,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                    // Read data and create <option >
                        for(var i=0; i<len; i++){

                            var fuel_type = response['data'][i].fuel_type;

                            var option = "<option value='"+fuel_type+"'>"+fuel_type+"</option>"; 

                            $("#vehicle-fuel-type").append(option); 
                        }
                    }

                }
            });
            });

            // Fuel Type Change
            $('#vehicle-fuel-type').change(function(){

            var fuel_type = $(this).val();
            var vehicle_model = $('#vehicle-model').val();

            // Empty the dropdown
            $('#vehicle-variant').find('option').not(':first').remove();

            // AJAX request 
            $.ajax({
                url: "{{ url('app/lookup/variant') }}/"+vehicle_model+"/"+fuel_type,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                    // Read data and create <option >
                        for(var i=0; i<len; i++){

                            var variant = response['data'][i].variant;

                            var option = "<option value='"+variant+"'>"+variant+"</option>"; 

                            $("#vehicle-variant").append(option); 
                        }
                    }

                }
            });
            });

            

            $('body').on('click', '#reset-filter', function() {

                $('#vehicle-type').val("");
                $('#vehicle-make').val("");
                $('#vehicle-model').val("");
                $('#vehicle-fuel-type').val("");
                $('#vehicle-variant').val("");

                window.location.href = "/app";
            });
        
        </script>
    </body>
</html>