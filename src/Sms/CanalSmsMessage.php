<?php

namespace Jorgenwdm\Beak\Sms;

use GuzzleHttp\Exception\ClientException;
use Jorgenwdm\Beak\Sms\SmsMessage;
use Jorgenwdm\Beak\Sms\SmsMessageResponse;

class CanalSmsMessage extends SmsMessage
{  
    // Private properties
    private string $apiurl;
    private string $apiuser;
    private string $apipassword;   


    public function __construct() 
    {
        
        // Set initial values        
        $this->apiurl = config('laravel-beak.canal_api_url') . '/sendsms.jsp';
        $this->apiuser = config('laravel-beak.canal_api_user');
        $this->apipassword = config('laravel-beak.canal_api_password');               
        $this->from = config('laravel-beak.canal_api_sender');

        // Use the active HTTP client
        $this->client = $this->getHttpClientInstance();
    }    


    /**
     * Triggers the sending proccess of a message
     * 
     * @return SmsMessageResponse     
     */
    public function send(): SmsResponse
    {        
        $answer = new SmsResponse();

        // set the list of numbers as a comma separated string
        $mobiles = is_array($this->to) ? implode(',',$this->to) : $this->to;

        try 
        {            
            // initialize the http request with the api credentials the provider needs
            $request = $this->client->request('GET', $this->apiurl, [
                'query' => [
                    'user' => $this->apiuser,
                    'password' => $this->apipassword,
                    'mobiles' => $mobiles ,
                    'senderid' => $this->from,                    
                    'sms' =>  stripslashes($this->text),
                    'unicode' => 0, 
                ]                
            ]);      
            
            $answer->setRaw($request->getBody()->getContents(), SmsResponse::RAW_TYPE_XML);
        } 

        catch (ClientException $e) 
        {        
            $answer->setException($e);
            
            logger()->error('HTTP Exception in '.__CLASS__.': '.__METHOD__.'=>'.$e->getMessage());  // log the exception        
        } 

        catch (\Exception $e) 
        {
            $answer->setException($e);

            logger()->error('SMS Exception in '.__CLASS__.': '.__METHOD__.'=>'.$e->getMessage());  // log the exception          
        }

        return $answer;
       
    }
}

