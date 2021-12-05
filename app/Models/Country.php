<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name',
        'official_name',
        'flag_emoji',
        'flag_png',
        'coat_of_arms',
        'tld',
        'independent',
        'unMember',
        'lat',
        'lng',
        'openstreetmap',
        'population',
        'female_demonym',
        'male_demonym'
    ];

    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public static function createCountryFromRestCountriesApi(array $country): self
    {
        return self::create([
            'common_name' => $country['name']['common'],
            'official_name' => $country['name']['official'],
            'flag_emoji' => $country['flag'],
            'flag_png' => $country['flags']['png'],
            'coat_of_arms' => $country['coatOfArms']['png'],
            'tld' => $country['tld'][0],
            'independent' => $country['independent'],
            'unMember' => $country['unMember'],
            'lat' => $country['latlng'][0],
            'lng' => $country['latlng'][1],
            'openstreetmap' => $country['maps']['openStreetMaps'],
            'population' => $country['population'],
            'female_demonym' => $country['demonyms']['eng']['f'],
            'male_demonym' => $country['demonyms']['eng']['m']
        ]);
    }
}
