<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'location_id',
        'instructor_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'preferred_date',
        'preferred_time',
        'number_of_participants',
        'experience_level',
        'special_requests',
        'total_price',
        'status',
        'is_paid',
        'payment_method',
        'payment_reference',
        'paid_at',
        'admin_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
        'total_price' => 'decimal:2',
        'is_paid' => 'boolean',
        'paid_at' => 'datetime',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the package that belongs to the booking.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the location that belongs to the booking.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the instructor that belongs to the booking.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Get the lesson sessions for the booking.
     */
    public function lessonSessions(): HasMany
    {
        return $this->hasMany(BookingLessonSession::class);
    }
}
