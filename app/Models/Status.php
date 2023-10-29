<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    use HasFactory;
    // one status can be in many task, foreign key status_id
    public function task(): HasMany{
        return $this->hasMany(Task::class, 'status_id', 'id');
    }
}
