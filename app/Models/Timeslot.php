<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'location_id',
        'is_active',
    ];

    /**
     * Get the location that owns the timeslot.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the bookings for this timeslot.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if this timeslot is available on a specific date
     */
    public function isAvailable(string $date): bool
    {
        // Count bookings for this timeslot on the specific date
        $bookingsCount = $this->bookings()
            ->where('preferred_date', $date)
            ->where('status', '!=', 'Cancelled')
            ->count();

        // Determine maximum capacity based on location or a default value
        $maxCapacity = $this->location->max_capacity ?? 1;

        // The timeslot is available if the number of bookings is less than the max capacity
        return $bookingsCount < $maxCapacity;
    }

    /**
     * Get the number of remaining spots for a specific date
     */
    public function remainingSpots(string $date): int
    {
        $bookingsCount = $this->bookings()
            ->where('preferred_date', $date)
            ->where('status', '!=', 'Cancelled')
            ->count();

        $maxCapacity = $this->location->max_capacity ?? 1;

        return max(0, $maxCapacity - $bookingsCount);
    }

    /**
     * Format the time range for display
     */
    public function getFormattedTimeAttribute(): string
    {
        return date('H:i', strtotime($this->start_time)) . ' - ' . date('H:i', strtotime($this->end_time));
    }
}
