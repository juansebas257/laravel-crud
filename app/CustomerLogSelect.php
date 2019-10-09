<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerLogSelect extends Model{

    protected $table = 'log_customer_select';
    protected $fillable = ['registros', 'operation_date', 'ip_address', 'host'];
    public $timestamps = false;
}
