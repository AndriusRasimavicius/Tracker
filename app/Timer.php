<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Task relationship.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
