<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends BaseModel
{
    protected $table = 'contact_request';
    protected $fillable = [
        'name',
        'phone_number',
        'admin_comment',
        'date'
    ];
}
