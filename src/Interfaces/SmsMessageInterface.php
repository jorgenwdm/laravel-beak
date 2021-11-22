<?php

namespace Jorgenwdm\Beak\Interfaces;

use Jorgenwdm\Beak\Sms\SmsResponse;

/**
 * Interface for all message services
 */
interface SmsMessageInterface
{
    /**
     * Set the number or array of numbers you want to send your message to.
     * 
     * @param array|string $numbers
     * @return $this
     */
    public function to(array|string $numbers): self;
    

    /**
     * Set the message text you want to send
     * 
     * @param string $text
     * @return $this
     */
    public function text(string $text): self;


    /**
     * Set the name you want the user to see as sender of the message. 
     * Note: Not all bulk message providers support this feature
     * 
     * @param string $text
     * @return $this
     */
    public function from(string $sender): self;


    /**
     * Triggers the sending proccess of a message
     * 
     * @return SmsResponse
     */
    public function send(): SmsResponse;
}