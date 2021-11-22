<?php

namespace Jorgenwdm\Beak\Sms;

use GuzzleHttp\Client;
use Jorgenwdm\Beak\Sms\SmsResponse;
use Jorgenwdm\Beak\Interfaces\SmsReportInterface;

abstract class SmsReport implements SmsReportInterface
{    
    private static $httpClient;
        
    protected array|string $for;

    protected $client;    
    protected mixed $clientResponse;
    protected mixed $clientException;    
 
    /**
     * HTTP client that will be used to communcate with the HTTP API. 
     * Note: it must be instantiated only once
     * 
     * @return Client
     */
    public static function getHttpClientInstance()
    {
        if (! self::$httpClient) {
            self::$httpClient = new Client();
        }

        return self::$httpClient;
    }


    /**
     * The id or ids of the messages you want a report for
     * 
     * @param array|string $ids
     * @return $this 
     */
    public function for(array|string $ids): self
    {
        $this->for = $ids;
        return $this;
    }


    /**
     * Triggers the report request proccess of one or more messages
     * 
     * @return SmsResponse     
     */
    abstract public function request(): SmsResponse;


}