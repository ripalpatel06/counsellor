<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jackpopp\GeoDistance\GeoDistanceTrait;

class Listing extends Model
{
    use GeoDistanceTrait;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->lngColumn = 'longitude';
        $this->latColumn = 'latitude';
    }

    protected $fillable = [
        'id',
        'name',
        'postal_code',
        'latitude',
        'longitude'
    ];

    public static function getCoordinates($location)
    {
        $encodedLocation = urlencode($location);

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedLocation}&key=ENTERYOURGOOGLEAPIKEY";

        $details=file_get_contents($url);

        $result = json_decode($details, true);
        // echo '<pre>'; print_r($result); exit;
        if (!count($result['results'])) {
            return false;
        }

        return [
            'latitude'  => $result['results'][0]['geometry']['location']['lat'],
            'longitude' => $result['results'][0]['geometry']['location']['lng']
        ];
    }

    /**
     * Accessors and mutators
     */

    public function setPostalCodeAttribute($value)
    {
        $this->attributes['postal_code'] = strtoupper(preg_replace('/\s+/', '', $value));
    }

    public function getIsVerifiedAttribute()
    {
        if (!$this->exists) {
            return false;
        }

        return $this->attributes['location_verified'] === 1;
    }

    public function getIsPublishedAttribute()
    {
        if (!$this->exists) {
            return false;
        }

        return $this->attributes['published'] === 1;
    }

    public function getDistanceAttribute()
    {
        return round($this->attributes['distance'], 0);
    }

    /**
     * Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }

    /**
     * Scopes
     */

    public function scopePublished($query)
    {
        return $query->where('published', '=', 1);
    }
}