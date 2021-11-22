<?php

namespace Jorgenwdm\Beak\Sms;

class SmsResponse
{       
    // Public raw data type constants
    public const RAW_TYPE_TEXT = 0;
    public const RAW_TYPE_XML = 1;
   
    // Public properties    
    public ?string $raw;        // the raw contents of the response as simple text 
    public bool $hasException;  // if an exception happened
    public mixed $exception;    // the Exception object if something went wrong

    // Private properties
    private int $rawType;       // the type of raw contents of the response eg. text, xml
     

    public function __construct() 
    {     
        $this->raw = null;
        $this->rawType = SmsResponse::RAW_TYPE_TEXT;        
        $this->hasException = false;
        $this->exception = null;
    }   


    /**
     * Sets the exception that happened during the response
     * 
     * @param mixed $e
     */
    public function setException(mixed $e)
    {        
        $this->hasException = true;
        $this->exception = $e;
    }


    /**
     * Returns the exception object (if an exception happened)
     * 
     * @return mixed
     */
    public function getException() : mixed 
    {
        return $this->exception;
    }

    /**
     * Sets the raw data of the response
     * 
     * @param mixed $e
     */
    public function setRaw(string $data, int $data_type) 
    {        
        $this->raw = $data;
        $this->rawType = $data_type;        
    }


    /**
     * Returns the data of the response in a json object
     *     
     * @return mixed
     */
    public function getJson(): mixed
    {
        $answer= null;

        // If raw data is in xml format, we convert it to a json object
        if( $this->rawType == SmsResponse::RAW_TYPE_XML )
        {       
            $xml = simplexml_load_string( $this->raw, null, LIBXML_NOCDATA );          
            $json = json_decode( json_encode($xml) );
            $answer = $json;
        }

        return $answer;        
    }
}