<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = "leave";
    protected $primaryKey = 'leaveID';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'leaveID',
        'studentID',
        'type',
        'symptoms',
        'reason',
        'days',
        'allergies',
        'description',
        'status'
    ];
}
