<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'category_id',
        'start_time',
        'end_time',
        'location',
        'latitude',
        'longitude',
        'max_attendees',
        'price',
        'image_url',
    ];

    protected $dates = ['created_at', 'updated_at', 'start_time', 'end_time'];


    // Define la relación con el modelo Organizer
    public function organizer()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_attendees', 'event_id', 'user_id')
            ->withPivot('registered_at');
    }
}
