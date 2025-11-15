<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Trip extends Model
{
    protected $fillable = [
        'destination',
        'slug',
        'start_date',
        'end_date',
        'rank',
        'points',
        'price',
        'title',
        'subtitle',
        'image_path',
        'itinerary',
        'note',
        'path_image_note',
        'card_description_one',
        'card_description_two',
        'plazas_available',
        'requirements',
        'city',
    ];

    protected $casts = [
        'itinerary' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'plazas_available' => 'integer',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($trip) {
            if (empty($trip->slug)) {
                $trip->slug = static::generateUniqueSlug($trip->destination, $trip->start_date);
            }
        });

        static::updating(function ($trip) {
            if ($trip->isDirty('destination') || $trip->isDirty('start_date')) {
                $trip->slug = static::generateUniqueSlug($trip->destination, $trip->start_date);
            }
        });
    }

    protected static function generateUniqueSlug($destination, $startDate)
    {
        $year = Carbon::parse($startDate)->format('Y');
        $baseSlug = Str::slug($destination . ' ' . $year);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

        public function getRouteKeyName()
    {
        return 'slug';
    }

}
