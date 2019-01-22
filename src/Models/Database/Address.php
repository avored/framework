<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Models\Contracts\ConfigurationInterface;

class Address extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'address_number',
        'address_complement',
        'postcode',
        'city',
        'state',
        'country_id',
        'phone',
    ];

    /**
     * The address belongs to an Country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * To Check If Country Id is Null then it Returns Default Country ID from Configuration
     *
     * @return int|null $countryId
     */
    public function getCountryIdAttribute()
    {
        if (isset($this->attributes['country_id']) && $this->attributes['country_id'] > 0) {
            return $this->attributes['country_id'];
        }

        $configRepository = app(ConfigurationInterface::class);
        $defaultCountry = $configRepository->getValueByKey('user_default_country');

        if (isset($defaultCountry)) {
            return $defaultCountry;
        }

        return null;
    }
}
