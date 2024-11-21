<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Tool;
use App\Models\User;
use App\Models\Currency;
use App\Models\ToolPrice;
use App\Facades\EmailFacade;
use Illuminate\Http\Request;
use App\Mail\NewInstallationMail;
use App\Http\Controllers\Controller;
use App\Http\Resources\ToolResource;
use Illuminate\Support\Facades\Storage;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::orderBy('created_at', 'desc')->get();

        return view("voyager::tools.index", compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::where('is_active', true)->pluck('currency');

        return view("voyager::tools.create", compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'benefits' => 'nullable|array',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'languages_links' => 'nullable',
            'extension' => 'nullable',
            'main_link' => 'nullable',
        ]);

        $nonEmptyBenefits = array_filter($request->input('benefits', []), function($value) {
            return !empty($value); 
        });

        $tool = new Tool();
        $tool->title = $request->name;
        $tool->price = $request->price;
        $tool->description = $request->description;
        $tool->benefits = json_encode($nonEmptyBenefits);
        $tool->links = $request->languages_links[0];
        $tool->main_link = $request->main_link;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/tools');
            $tool->image = Storage::url($imagePath);
        }

        if ($request->hasFile('extension')) {
            $path = $request->file('extension')->store('public/tools/extensions');
            $tool->extension = Storage::url($path);
        }

        $tool->save();
        
        $this->setCountryPrices($request->country_prices, $tool->id);

        $this->sendMail($tool);

        return redirect()->route('admin.tools.index');
    }

    public function sendMail($product)
    {
        $users = User::all();

        $currenciesObj = Currency::all();
        
        EmailFacade::sendEmails($users, function($user) use ($product, $currenciesObj) {
            $curObj = $currenciesObj->first(function($currency) use ($user) {
                return $currency->country === $user->location;
            });

            $price = $product->price;
            $currencySymbol = '$';

            if($curObj) {
                $multiPrice = $product->prices->firstWhere('country_code', $curObj->currency);
                
                if ($multiPrice && $multiPrice->price) {
                    $currencySymbol = $curObj->symbol;
                    $price = $multiPrice->price;
                }
            }

            $productArray = $product->toArray();
            $productArray['price'] = $price;
            $productArray['currencySymbol'] = $currencySymbol;
            $product = (object)$productArray;
        
            return new NewInstallationMail($product, $user);
        });
    }

    private function setCountryPrices($countryPrices, $id)
    {
        $countryPrices = json_decode($countryPrices, true) ?? [];
        
        if(!empty($countryPrices)) {
            foreach($countryPrices as $countryCode => $price) {
                ToolPrice::updateOrCreate(
                    ['tool_id' => $id, 'country_code' => $countryCode],
                    ['price' => $price ? $price : 0],
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tool = Tool::find($id);

        $countryPrices = $this->getCountryPrices($tool);

        $currencies = Currency::where('is_active', true)->pluck('currency');
        
        return view("voyager::tools.edit", compact('tool', 'countryPrices', 'currencies'));
    }

    private function getCountryPrices($tool)
    {
        $countryPrices = null;

        if($tool) {
            $prices = $tool->prices;

            foreach($prices as $priceObj) {
                $countryPrices[$priceObj->country_code] = $priceObj->price;
            }
        }

        if($countryPrices) {
            $countryPrices = json_encode($countryPrices);
        }

        return $countryPrices;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'benefits' => 'nullable|array',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'languages_links' => 'nullable',
            'extension' => 'nullable',
            'main_link' => 'nullable',
        ]);

        $nonEmptyBenefits = array_filter($request->input('benefits', []), function($value) {
            return !empty($value); 
        });

        $tool = Tool::find($id);
        $tool->title = $request->name;
        $tool->price = $request->price;
        $tool->description = $request->description;
        $tool->benefits = json_encode($nonEmptyBenefits);
        $tool->links = $request->languages_links[0];
        $tool->main_link = $request->main_link;


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/tools');
            $tool->image = Storage::url($imagePath);
        }

        if ($request->hasFile('extension')) {
            $imagePath = $request->file('extension')->store('public/tools/extensions');
            $tool->extension = Storage::url($imagePath);
        }

        $tool->save();

        $this->setCountryPrices($request->country_prices, $tool->id);

        return redirect()->route('admin.tools.index');
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
}
