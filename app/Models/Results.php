<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{


    use HasFactory;

    protected $guarded = [];



    function deleteImages(){

        $filepersian = $this->filePersian;

        $fileEnglish = $this->fileEnglish;

        
        if($filepersian &&   file_exists($filepersian)){
         
            // dd('has');
            unlink($filepersian);
        }else{
            dd('no');
        }

        if($fileEnglish && file_exists(url($fileEnglish))){
            unlink(url($fileEnglish));
        }
    }

}
