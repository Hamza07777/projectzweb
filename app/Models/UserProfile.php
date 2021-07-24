<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getDobAttribute($value){
        return date('m/d/Y',strtotime($value));
    }

    public function setDobAttribute($value){
        $this->attributes['dob'] = date('Y-m-d',strtotime($value));
    }

    public function vaccineCenter(){
        return $this->belongsTo(VaccineCenter::class,'vaccine_center','id');
    }

}
