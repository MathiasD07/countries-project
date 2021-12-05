<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Routing\Controller;

class CountryController extends Controller
{
    public function index(CountryRequest $request)
    {
        $params = $request->validated();
        $fields = ['*'];

        if (isset($params['fields'])) {
            $fields = explode(',', $params['fields']);

            foreach ($fields as $field) {
                if(!in_array($field, (new Country())->getFillable())) {
                    throw new \Exception('Field '.$field.' is not allowed', 400);
                }
            }
        }

        return Country::select($fields)->get();
    }

    public function show(Country $country)
    {
        return $country->load(['continent', 'region']);
    }
}
