<?php

namespace App\Console\Commands;

use App\Models\Continent;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Count;

class WrapCountriesApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wrap:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wrap 20 pokemon from countriesapi';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->resetTables();
        $countries = Http::get('https://restcountries.com/v3.1/all')->collect()->take(20);
        $this->createCountries($countries);

        return Command::SUCCESS;
    }

    public function resetTables(): void
    {
        Schema::disableForeignKeyConstraints();
        Country::truncate();
        Region::truncate();
        Continent::truncate();
        Schema::enableForeignKeyConstraints();
    }

    public function createCountries(Collection $countries): void
    {
        $countries->each(function ($country) {
            $continent = Continent::firstOrCreate([
                'name' => $country['continents'][0]
            ]);

            $region = Region::firstOrCreate([
                'name' => $country['region']
            ]);

            $country = Country::createCountryFromRestCountriesApi($country);

            $country->continent()->associate($continent);
            $country->region()->associate($region);
            $country->save();
        });
    }
}
