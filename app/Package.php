<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'status'
    ];
    
    public function consign()
    {
       return $this->belongsTo('App\Consignee');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function start_office()
    {
        return $this->belongsTo('App\Office');
    }
    
    public function finish_office()
    {
        return $this->belongsTo('App\Office');
    }
}
