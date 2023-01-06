<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imageStory()
    {
        return $this->hasMany(ImageStory::class, 'user_id','user_id');
    }

    public function view(){
        return $this->hasMany(View::class);
    }

}
