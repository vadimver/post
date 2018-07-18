<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    protected $table = 'Consignees';
    
    public function package()
    {
      return $this->hasOne('App\Package');
    }
}
