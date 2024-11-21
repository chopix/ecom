<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LoadCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:currencies';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads currencies from an external API and updates the database';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $response = Http::get('https://restcountries.com/v3.1/all');

        if ($response->successful()) {
            Currency::truncate();

            $countries = $response->json();
            $countryCurrencies = [];

            foreach ($countries as $country) {
                $name = $country['name']['common'];

                if (array_key_exists('currencies', $country)) {
                    $currencyCode = key($country['currencies']);
                    $currencySymbol = $country['currencies'][$currencyCode]['symbol'] ?? null;
                } else {
                    $currencyCode = null;
                    $currencySymbol = null;
                }
                
                if($currencyCode && $currencySymbol) {
                    Currency::create([
                        'country' => $name,
                        'currency' => $currencyCode,
                        'symbol' => $currencySymbol
                    ]);
                }
            }
            $this->info('Currencies have been loaded successfully!');
        
        }  else {
            $this->error('Failed to retrieve data from the API.');
        }

    }
}
