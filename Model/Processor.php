<?php

namespace Sirclo\Notification\Model;

class Processor
{
    /**
     * Process all queue message
     *
     * @param string $message
     * @return void
     */
    public function execute($message)
    {
        logger('== Processor execute');
        sleep(10);
        logger('== Processor sleep 10s end');

        $client = new \GuzzleHttp\Client([
            'base_uri' => 'http://10.0.0.1:3000'
        ]);

        try {
            if ($this->isJson($message)) {
                $json = json_decode($message);
            } else {
                $json = [ 'comment' => $message ];
            }

            $response = $client->post('/messages', [
                'json' => $json
            ]);

            logger($response->getStatusCode() . ' : ' . $response->getReasonPhrase());
        } catch (\Exception $e) {
            logger($e->getCode() . ' : ' . $e->getMessage());
        }
    }

    /**
     * Check if string is json encoded
     *
     * @param mixed $string
     * @return bool
     */
    function isJson($string)
    {
        @json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
