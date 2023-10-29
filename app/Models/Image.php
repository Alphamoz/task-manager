<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    // one image can be in many task, foreign key image_id
    public function task(): HasMany{
        return $this->hasMany(Task::class, 'image_id', 'id');
    }
}
