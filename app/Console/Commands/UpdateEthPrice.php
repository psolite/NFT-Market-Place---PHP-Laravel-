<?php

namespace App\Console\Commands;

use App\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateEthPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ethprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Ethereum price';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

    
        $api_key = 'ZEN1AJ487C2DEBY548VK4ECNSFFF8R79NX'; // Replace with your actual API key
        $endpoint = 'https://api.etherscan.io/api';
        $action = 'ethprice';
        $module = 'stats';
        $api_url = "$endpoint?module=$module&action=$action&apikey=$api_key";

        $client = new Client();
        $response = $client->get($api_url);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            if ($data['status'] == '1') {
                $ethusd = $data['result']['ethusd'];
                $ethsetting = Setting::where('id', 1)->first();
                $ethsetting->ethusd = $ethusd;
                $ethsetting->save();
                $this->info("Updated ETH price: $ethusd");
            } else {
                $this->error('Error fetching data');
            }
        } else {
            $this->error('Error fetching data');
        }
    }
 
}
