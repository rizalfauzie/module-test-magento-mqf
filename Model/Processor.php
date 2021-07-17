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
    public function execute(string $message)
    {
        logger('RUN Processor::execute');

        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://magento.requestcatcher.com'
        ]);

        try {
            $response = $client->post('/messages', [
                'json' => [ 'text' => $message ]
            ]);
            logger($response->getStatusCode() . ' : ' . $response->getReasonPhrase());
        } catch (\Exception $e) {
            logger($e->getCode() . ' : ' . $e->getMessage());
        }
    }
}
