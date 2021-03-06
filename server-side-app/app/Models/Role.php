<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
  
    protected $fillable = [
        'label',
    ];
    
    /**
     * Get the users associated with the a role.
     */
    public function users(){
        return $this->hasMany('App\Models\User');
    }

}
