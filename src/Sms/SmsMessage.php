<?php

namespace Jorgenwdm\Beak\Sms;

use GuzzleHttp\Client;
use Jorgenwdm\Beak\Sms\SmsResponse;
use Jorgenwdm\Beak\Interfaces\SmsMessageInterface;


abstract class SmsMessage implements SmsMessageInterface 
{    
    private static $httpClient;
    
    protected string $from;
    protected array|string $to;    
    protected string $text;
    
    protected $client;            
 
    /**
     * HTTP client that will be used to communcate with the HTTP API. 
     * Note: it must be instantiated only once
     * 
     * @return Client
     */
    public static function getHttpClientInstance()
    {
        if (! self::$httpClient) 
        {
            self::$httpClient = new Client();
        }

        return self::$httpClient;
    }

    /**
     * Set the name you want the user to see as sender of the message. 
     * Note: Not all bulk message providers support this feature
     * 
     * @param string $text
     * @return $this
     */
    public function from(string $sender): self
    {
        $this->from = $sender;
        return $this;
    }


    /**
    * Set the number or array of numbers you want to send your message to.
    * 
    * @param array|string $numbers
    * @return $this
    */
    public function to(array|string $numbers): self
    {
        $this->to = $numbers;
        return $this;
    }


    /**
    * Set the message text you want to send
    * 
    * @param string $text
    * @return $this
    */
    public function text(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Triggers the sending proccess of a message
     * 
     * @return bool     
     */
    abstract public function send(): SmsResponse;    
}