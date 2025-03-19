<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressService
{
    protected string $baseUrl = "https://extranet.asmorphic.com/api/";
    protected ?string $bearerToken = null;

    public function authenticate()
    {
        $response = Http::post($this->baseUrl . 'login', [
            'email' => 'project-test@projecttest.com.au',
            'password' => 'oxhyV9NzkZ^02MEB',
        ]);

        if ($response->successful()) {
            $this->bearerToken = $response->json('result')['token'];
        } else {
            throw new \Exception('Failed to authenticate API');
        }
    }

    public function getBearerToken()
    {
        if (!$this->bearerToken) {
            $this->authenticate();
        }
        return $this->bearerToken;
    }

    public function findAddress($companyId,$streetName, $suburb, $postcode, $state, $streetType = null, $streetNumber = null)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getBearerToken(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post($this->baseUrl . 'orders/findaddress', [
            'company_id' => $companyId,
            'street_number' => $streetNumber,
            'street_name' => $streetName,
            'street_type' => $streetType,
            'suburb' => $suburb,
            'postcode' => $postcode,
            'state' => $state,
        ]);

        return $response->json();
    }

    public function qualifyService($directoryId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getBearerToken(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post($this->baseUrl . 'orders/qualify', [
            'company_id' => 17,
            'qualification_identifier' => $directoryId,
            'service_type_id' => 3,
        ]);

        return $response->json();
    }
}
