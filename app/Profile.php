<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'denomination_id'
    ];

    /**
     * Accessors and mutators
     */

    public function getFullNameAttribute()
    {
        return "{$this->attributes['first_name']} {$this->attributes['last_name']}";
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function setDenominationIdAttribute($value)
    {
        $this->attributes['denomination_id'] = empty($value) ? null : $value;
    }

    /**
     * @todo implement this generically
     */

    public function getGender()
    {
        switch ($this->attributes['gender']) {
            case 'M':
                return 'Male';
                break;

            case 'F':
                return 'Female';
                break;

            default:
                return 'Unspecified';
        }
    }

    public function getDenomination()
    {
        if ($this->attributes['denomination_id']) {
            return $this->denomination->name;
        }

        return 'Unspecified';
    }

    /**
     * Relationships
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function denomination()
    {
        return $this->belongsTo('App\Denomination');
    }
}
