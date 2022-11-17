<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\ProcessCsvUpload;

class vlfdata extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'SKU', 
        'parent_SKU', 
        'parent_id', 
        'vehicle_type', 
        'vehicle_make', 
        'vehicle_model', 
        'variant', 
        'vlf_type', 
        'fuel_type', 
        'price', 
        'k_type', 
        'economy_gain_bhp', 
        'economy_gain_nm', 
        'fuel_saving', 
        'original_bhp', 
        'original_torque', 
        'power_bhp', 
        'torque_nm', 
        'vswitch_support', 
        'perm_type', 
        'perm_make', 
        'perm_model',
    ];


    protected $guarded = [];

    public function importToDb()
    {
        //$path = resource_path('pending-files/*.csv');
        $path = resource_path('*.csv');
        $files = glob($path);
        //dd($files);
 
        foreach($files as $file){

            //dump($file);
            ProcessCsvUpload::dispatch($file);
        }
 
        //dd('done');
        
        //session()->flash('status', 'Importing to DB Done');

        //dd($g);
    }

}
