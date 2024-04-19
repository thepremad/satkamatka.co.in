<?php
namespace App\Traits;

use App\Models\Notification;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

trait ResponseWithHttpRequest{


	protected function sendSuccess($message, $result = NULL)
    {
    	$response = [
            'ResponseCode'      => 200,
            'Status'            => True,
            'Message'           => $message,
        ];

        if(!empty($result)){
            $response['Data'] = $result;
        }
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendFailed($errorMessages = [], $code = 200)
    {
    	$response = [
            'ResponseCode'      => $code,
            'Status'            => False,
        ];


        if(!empty($errorMessages)){
            $response['Message'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    
   public  function sumValue($value)
    {
        $digits = str_split($value);
        $sum = array_sum($digits);
        $stringValue = (string)$sum;
        return substr($stringValue, -1);
    }


    


	

}