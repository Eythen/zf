<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'order_sn',
        'product_id',
        'name',
        'pic',
        'num',
        'money_type',
        'money',
        'first_name',
        'last_name',
        'mobile',
        'address',
        'status',
    ];

}
