<?php

namespace App\Http\Controllers;

use App\Models\Coordinate;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CoordinateController extends Controller
{
    public function index(): Collection
    {
        return Coordinate::get();
    }

    public function store(Request $request): ?Coordinate
    {
        $validated = $request->validate([
            "longitude" => "required|string",
            "latitude" => "required|string",
            "country_id" => "required|exists:countries,id"
        ]);
        $country = Coordinate::create($validated);

        return $country;
    }

    public function getCountry(Request $request): ?Country
    {
        $validated = $request->validate([
            "longitude" => "required|string",
            "latitude" => "required|string",
        ]);
        $countryId = Coordinate::where("longitude", $validated["longitude"])->where("latitude", $validated["latitude"])->first()?->id;
        $country = $countryId ? Country::whereId($countryId)->first() : null;
        return $country;
    }

    public function getAllCordinates(Request $request): ?Collection
    {
        $validated = $request->validate([
            "longitude" => "required|string",
            "latitude" => "required|string",
        ]);
        $countryId = Coordinate::where("longitude", $validated["longitude"])->where("latitude", $validated["latitude"])->first()?->id;
        $country = $countryId ? Country::whereId($countryId)->first() : null;
        return $country?->coordinates()->get();
    }
}
