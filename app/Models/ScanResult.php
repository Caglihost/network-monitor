<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScanResult extends Model
{
    // On montre à laravel quel genre de données il va manipuler.
    protected $fillable = ['ip', 'hostname', 'status', 'open_ports', 'scan_time'];
}
