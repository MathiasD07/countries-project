<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Routing\Controller;

class CountryController extends Controller
{
    public function index()
    {
        return Country::with(['region', 'continent'])->get();
    }
}
