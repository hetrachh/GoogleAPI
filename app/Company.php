<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'company_id';

    protected $fillable = [
    	'company_id',
    	'company_name',
    	'company_desc',
        'company_email',
        'company_password',
        'company_address',
        'company_logo'
    ];
}
