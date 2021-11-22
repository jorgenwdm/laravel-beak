<?php

namespace Jorgenwdm\Beak\Interfaces;

use Jorgenwdm\Beak\Sms\SmsResponse;

/**
 * Interface for all delivery reports
 */
interface SmsReportInterface
{
    /**
     * The id or ids of the messages you want a report for
     * 
     * @param array|string $ids
     * @return $this 
     */
    public function for(array|string $ids): self;


    /**
     * Triggers the report request proccess of one or more messages
     * 
     * @return SmsResponse
     */
    public function request(): SmsResponse;
}