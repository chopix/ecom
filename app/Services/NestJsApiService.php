// app/Services/NestJsApiService.php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class NestJsApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://127.0.0.1:3001']);
    }

    public function sendPaddleWebhook($body, $signature)
    {
        try {
            $response = $this->client->post('/api/payment/paddle-webhook', [ // Note the /api prefix
                'headers' => [
                    'Content-Type' => 'application/json',
                    'paddle-signature' => $signature
                ],
                'body' => json_encode($body)
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            Log::error('Error sending request to Nest.js service', [
                'message' => $e->getMessage(),
                'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body'
            ]);

            throw new \Exception('Error communicating with Nest.js service');
        }
    }

    // Add more methods to interact with other Nest.js endpoints if needed
}