<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceStatus;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'http_errors' => false,
            'verify' => false, // Disable SSL verification to prevent certificate errors (cURL error 60)
        ]);
    }

    public function checkService(Service $service): ServiceStatus
    {
        $startTime = microtime(true);
        $statusCode = null;
        $responseData = null;
        $isOperational = false;

        // Log request details
        Log::info('Service check initiated', [
            'service_id' => $service->id,
            'service_name' => $service->name,
            'url' => $service->url,
            'method' => $service->method,
            'timeout' => $service->timeout,
            'expected_status_code' => $service->expected_status_code,
        ]);

        try {
            $options = [
                'timeout' => $service->timeout,
                'headers' => $service->headers ?? [],
                // 'debug' => true, // Causes error: Cannot represent a stream of type Output as a STDIO FILE*
            ];

          
            if ($service->method !== 'GET' && $service->payload) {
               
                if (is_string($service->payload)) {
                   
                    $cleanPayload = $service->payload;
                   
                    $cleanPayload = str_replace(['\r\n', '\n', '\r', '\"'], [' ', ' ', ' ', '"'], $cleanPayload);
                    
                   
                    try {
                        $jsonData = json_decode($cleanPayload, true, 512, JSON_THROW_ON_ERROR);
                        $options['json'] = $jsonData; 
                    } catch (\JsonException $e) {
                      
                        Log::warning("Invalid JSON payload for service {$service->name}: {$e->getMessage()}", [
                            'service_id' => $service->id,
                            'original_payload' => $service->payload,
                            'cleaned_payload' => $cleanPayload
                        ]);
                        
                      
                        $options['body'] = $cleanPayload;
                    }
                } else {
                  
                    $options['json'] = $service->payload;
                }
                
               
                if (!isset($options['headers']['Content-Type'])) {
                    $options['headers']['Content-Type'] = 'application/json';
                }
            }
            
           
            $this->logRequestDetails($service, $options);

            $response = $this->client->request(
                $service->method,
                $service->url,
                $options
            );

            $statusCode = $response->getStatusCode();
            
        
            $responseBody = (string) $response->getBody();
            
            $response->getBody()->rewind();
            
            try {
                $responseData = json_decode($responseBody, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $responseData = ['raw' => substr($responseBody, 0, 500)];
                }
            } catch (\Exception $e) {
                $responseData = ['raw' => substr($responseBody, 0, 500)];
            }

            $isOperational = $statusCode === $service->expected_status_code;
        
            $responseTime = (int) ((microtime(true) - $startTime) * 1000);
            $this->logResponseDetails($service, $response, $responseTime);
            
          
            Log::info('Service check response summary', [
                'service_id' => $service->id,
                'service_name' => $service->name,
                'status_code' => $statusCode,
                'is_operational' => $isOperational,
                'response_time_ms' => $responseTime
            ]);
        } catch (RequestException $e) {
          
            $request = $e->getRequest();
            $requestBody = null;
            if ($request) {
                try {
                    $requestBody = (string) $request->getBody();
                } catch (\Exception $ex) {
                   
                }
            }
            
            Log::error('API check failed for service: ' . $service->name, [
                'service_id' => $service->id,
                'service_name' => $service->name,
                'url' => $service->url,
                'error' => $e->getMessage(),
                'request_body' => $requestBody,
                'response_time_ms' => (int) ((microtime(true) - $startTime) * 1000),
            ]);

            $responseData = ['error' => $e->getMessage()];
        }

        $endTime = microtime(true);
        $responseTime = (int) (($endTime - $startTime) * 1000); // Convert to milliseconds

        return ServiceStatus::create([
            'service_id' => $service->id,
            'is_operational' => $isOperational,
            'response_time' => $responseTime,
            'status_code' => $statusCode,
            'response_data' => $responseData,
        ]);
    }

    public function checkAllServices()
    {
        $services = Service::where('active', true)->get();
        
        foreach ($services as $service) {
            $this->checkService($service);
        }
    }

    protected function logRequestDetails(Service $service, array $options): void
    {
        
        $headers = [];
        foreach ($options['headers'] ?? [] as $key => $value) {
            $headers[] = "$key: $value";
        }

        $payload = null;
        
        if (isset($options['json'])) {
            $payload = json_encode($options['json'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } elseif (isset($options['body'])) {
            $payload = "RAW BODY: " . $options['body'];
        }

        $logEntry = "=== REQUEST TO: {$service->name} ===\n" .
                    "{$service->method} {$service->url}\n" .
                    "Headers:\n" . implode("\n", $headers) . "\n";
        
        if ($payload) {
            $logEntry .= "Payload:\n$payload\n";
        }
        
        $logEntry .= "===========================";
        
        Log::info($logEntry);
    }
    
    protected function logResponseDetails(Service $service, $response, $duration): void
    {
        $statusCode = $response->getStatusCode();
        
       
        $responseBody = (string) $response->getBody();
        $response->getBody()->rewind(); 
        
     
        $prettyBody = $responseBody;
        $jsonData = json_decode($responseBody, true);
        if (json_last_error() === JSON_ERROR_NONE && $jsonData) {
            $prettyBody = json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        
        $headers = [];
        foreach ($response->getHeaders() as $key => $values) {
            $headers[] = "$key: " . implode(', ', $values);
        }
        
        $logEntry = "=== RESPONSE FROM: {$service->name} ===\n" .
                    "Status: $statusCode\n" .
                    "Duration: {$duration}ms\n" .
                    "Headers:\n" . implode("\n", $headers) . "\n" .
                    "Body:\n$prettyBody\n" .
                    "===============================";
        
        Log::info($logEntry);
    }
} 