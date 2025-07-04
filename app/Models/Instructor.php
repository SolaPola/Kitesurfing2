<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'postal_code',
        'bsn',
        'isactive',
    ];

    /**
     * Get the user that owns the instructor profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the bookings assigned to this instructor.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    
    /**
     * Get the lesson sessions for this instructor.
     */
    public function lessonSessions(): HasMany
    {
        return $this->hasMany(BookingLessonSession::class);
    }
}
