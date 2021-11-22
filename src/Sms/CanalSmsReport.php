<?php

namespace Jorgenwdm\Beak\Sms;

use Jorgenwdm\Beak\Sms\SmsReport;
use GuzzleHttp\Exception\ClientException;

class CanalSmsReport extends SmsReport
{  
    private string $apiurl;
    private string $apiuser;
    private string $apipassword;    

    
    public function __construct() 
    {
        
        // Set some default values        
        $this->apiurl = config('laravel-beak.canal_api_url') . '/getDLR.jsp';
        $this->apiuser = config('laravel-beak.canal_api_user');
        $this->apipassword = config('laravel-beak.canal_api_password');       
                
        // Use the active HTTP client
        $this->client = $this->getHttpClientInstance();     
    }


    /**
     * Triggers the report request proccess of one or more messages
     * 
     * @return SmsResponse
     */
    public function request(): SmsResponse
    {        
        $answer = new SmsResponse();
        
        // set the list of ids as a comma separated string
        $ids = is_array($this->for) ? implode(',',$this->for) : $this->for;

        try 
        {
            // initialize the http request with the api credentials the provider needs
            $request = $this->client->request('GET', $this->apiurl, [
                'query' => [
                    'userid' => $this->apiuser,
                    'password' => $this->apipassword,
                    'messageid' => $ids,
                    'redownload' => 'yes',
                    'responcetype' => 'xml'                    
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

