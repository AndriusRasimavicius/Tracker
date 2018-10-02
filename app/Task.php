<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Project relationship.
     */
    public function project()
    {
        return $this->belongsTo(Project::class)->withTrashed();
    }

    /**
     * Timer relationship.
     */
    public function timer()
    {
        return $this->hasMany(Timer::class);
    }

    /**
     * Delete related Timers.
     */
    public function delete()
    {

        $this->timer()->delete();

        return parent::delete();
    }
}
