<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    // protected $fillable = ['user_id','image_id', 'title','description', 'status_id', 'published_at'];
    // primary key on other table
    // satu task punya satu image
    public function image(): BelongsTo{
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
    // satu task punya satu status
    public function status(): BelongsTo{
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    // satu task punya satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
