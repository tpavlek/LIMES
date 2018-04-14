<?php

namespace App\Http\Controllers;

use App\Formatter\FormatField;
use App\Location;
use App\OpendataImporter;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class AdminController extends Controller
{
    public function index()
    {
        $locations = Location::with('posts')->get();

        return view('admin.index')->with('locations', $locations);
    }

    public function showLocation($id)
    {
        $location = Location::findOrFail($id);

        return view('admin.show_location')
            ->with('location', $location);
    }

    public function showOpendataImport()
    {
        return view('admin.opendata_import');
    }

    public function fetchOpendata(Request $request)
    {
        $formatters = [
            new FormatField($request->get('name_name'), 'name'),
            new FormatField($request->get('description_name'), 'description'),
            new FormatField($request->get('lat_name'), 'lat'),
            new FormatField($request->get('lon_name'), 'lon')
        ];

        $params = [
            'query' => [ '$limit' => $request->get('num_records') ],
        ];

        $response = (new Client([ 'defaults' => [ 'headers' => [ 'X-App-Token' => getenv("SOCRATA_API_KEY") ] ] ]))
            ->request('GET', $request->get('socrata_url'), $params);

        $data = json_decode($response->getBody()->__toString(), true);

        $result = OpendataImporter::translateRecordFormat($data, $formatters);

        foreach ($result as $location_data) {
            if ($location_data['lat'] && $location_data['lon']) {
                $name = str_random();
                Browsershot::url("https://www.instantstreetview.com/s/{$location_data['lat']},{$location_data['lon']}")
                    ->windowSize(1280, 720)
                    ->waitUntilNetworkIdle()
                    ->click('#maparrow')
                    ->save(public_path() . "/img/$name.jpg");

                $location_data['img_path'] = "$name.jpg";
            }

            Location::build($location_data['name'], $location_data);
        }

        return redirect()->route('admin.index');
    }
}
