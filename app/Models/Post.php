<?php

namespace App\Models;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'body'];
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
