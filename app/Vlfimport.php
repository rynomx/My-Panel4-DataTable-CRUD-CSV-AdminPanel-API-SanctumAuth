<?php

namespace App;

use App\Jobs\ProcessCsvUpload;
use Illuminate\Database\Eloquent\Model;

class Vlfimport extends Model
{
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
