<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'company_email_address',
        'supplier_number',
        'status',
        'step1',
        'step2',
        'step3',
        'step4',
        'step6',
    ];

    protected $casts = [
        'step1' => 'json',
        'step2' => 'json',
        'step3' => 'json',
        'step4' => 'json',
        'step6' => 'json',
    ];
}
