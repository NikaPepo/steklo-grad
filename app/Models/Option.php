<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends BaseModel
{
    protected $table = 'options';
    protected $fillable = [
      'name',
      'value',
      'created_by',
      'updated_by',
    ];
    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updater():BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
