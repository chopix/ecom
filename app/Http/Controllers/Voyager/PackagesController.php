<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Tool;
use App\Models\Package;
use App\Models\Currency;
use App\Models\PackagePrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::orderBy('created_at', 'desc')->get();

        foreach($packages as $package) {
            $included = json_decode($package->tools_included, true);
            
            if($included) {
                $processedIncludes = Tool::where('is_active', true)->whereIn('id', $included)->get();

                $package['tools_included'] = $processedIncludes;
            }
        }

        return view("voyager::packages.index", compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tools = Tool::where('is_active', true)->orderBy('created_at', 'desc')->get();

        $currencies = Currency::where('is_active', true)->pluck('currency');

        return view("voyager::packages.create", compact('tools', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $package = new Package();
        $package->title = $request->title;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->tools_included = json_encode($request->tools_included);

        $package->save();

        $this->setCountryPrices($request->country_prices, $package->id);

        return redirect()->route('admin.packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        $tools = Tool::where('is_active', true)->orderBy('created_at', 'desc')->get();

        $countryPrices = $this->getCountryPrices($package);
        
        $currencies = Currency::where('is_active', true)->pluck('currency');

        return view("voyager::packages.edit", compact('package', 'tools', 'currencies', 'countryPrices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {   
        $package = Package::find($id);
        $package->title = $request->title;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->tools_included = json_encode($request->tools_included);

        $package->save();
        
        $this->setCountryPrices($request->country_prices, $package->id);

        return redirect()->route('admin.packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function setCountryPrices($countryPrices, $id)
    {
        $countryPrices = json_decode($countryPrices, true) ?? [];
        
        $countryPrices = array_filter($countryPrices, function($value) {
            return !empty($value); 
        });

        if(!empty($countryPrices)) {
            foreach($countryPrices as $countryCode => $price) {
                PackagePrice::updateOrCreate(
                    ['package_id' => $id, 'country_code' => $countryCode],
                    ['price' => $price ? $price : 0],
                );
            }
        }
    }

    private function getCountryPrices($package)
    {
        $countryPrices = null;

        if($package) {
            $prices = $package->prices;

            foreach($prices as $priceObj) {
                $countryPrices[$priceObj->country_code] = $priceObj->price;
            }
        }

        if($countryPrices) {
            $countryPrices = json_encode($countryPrices);
        }

        return $countryPrices;
    }
}
