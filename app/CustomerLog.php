<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model{

    protected $table = 'log_customer';
    protected $fillable = ['customer','operation', 'operation_date', 'last_id', 'new_id','last_document','new_document','last_active', 'new_active'];
    public $timestamps = false;
}
