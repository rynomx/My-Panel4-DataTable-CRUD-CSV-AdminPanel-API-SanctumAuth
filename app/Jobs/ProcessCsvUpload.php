<?php

namespace App\Jobs;

use App\Models\vlfdata as Vlfimport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('upload-csv')->allow(1)->every(30)->then(function () {
            
          
            dump("Proccessing this file: -- ", $this->file);
            $csv = array_map('str_getcsv', file($this->file)); 
            //dd($csv);
            
            foreach($csv as $row){
                //$row_arr = explode (";", $row[0]);  

                //dd($row);
                Vlfimport::updateOrCreate([
                    //'policy_id' => $row[0]
                    'SKU' => $row[1]
                ],[
                    // 'county' => $row[1],
                    // 'lat' => $row[2],
                    // 'lng' => $row[3]
                    'title' => $row[0],
                    //'SKU' => $row[1], 
                    'parent_SKU' => $row[2],
                    'parent_id' => $row[3],
                    'vehicle_type' => $row[4],
                    'vehicle_make' => $row[5], 
                    'vehicle_model' => $row[6],
                    'variant' => $row[7],
                    'vlf_type' => $row[8],
                    'fuel_type' => $row[9],
                    'price' => $row[10],
                    'k_type' => $row[11], 
                    'economy_gain_bhp' => $row[12],
                    'economy_gain_nm' => $row[13],
                    'fuel_saving' => $row[14],
                    'original_bhp' => $row[15],
                    'original_torque' => $row[16],
                    'power_bhp' => $row[17],
                    'torque_nm' => $row[18],
                    'vswitch_support' => $row[19],
                    'perm_type' => $row[20],
                    'perm_make' => $row[21],
                    'perm_model' => $row[22],
                ]);

                // Insurance::insert([
                //     'policy_id' => $row_arr[0],
                //     'county' => $row_arr[1],
                //     'lat' => $row_arr[2],
                //     'lng' => $row_arr[3]
                // ]);
            }
            dump("End the proccess from this file: -- ", $this->file);
            unlink($this->file);
        }, function () {
            // Could not obtain lock...
            return $this->release(30);
        });
        
    }
}
