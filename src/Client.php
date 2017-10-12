<?php

namespace sevenfloor\apiidigital;


/**
 * Class Client
 * @package sevenfloor\apiidigital
 */
class Client
{

    /**
     * @var
     */
    public $node_id;
    /**
     * @var
     */
    public $password;

    /** @var \GuzzleHttp\Client $_client */
    public $_client;

    /**
     * @var string
     */
    public $base_uri;


    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->_client = new \GuzzleHttp\Client(['base_uri' => $this->base_uri]);
    }


    /**
     * @param Body $body
     * @param $source
     * @param $destination
     * @param bool $requestDelivery
     * @internal param int $expirationDate
     * @return Response
     */
    public function message(Body $body, $source, $destination, $requestDelivery = true, $expirationDate = 1502807357000)
    {
        $message = [
            '@type' => 'outbound',
            'addresses' => ['source' => $source, 'destination' => $destination],
            'body' => $body->getBody(),
            'nodeId' => $this->node_id,
            'requestDelivery' => $requestDelivery,
            'expirationDate' => $expirationDate
        ];

        return $this->_send('message', $message);

    }

    /**
     *
     */
    public function pack()
    {
    }

    /**
     *
     */
    public function receive()
    {
    }

    /**
     * @param $path
     * @param $body
     * @internal param $date
     * @return Response
     */
    private function _send($path, $body)
    {
        $credentials = base64_encode($this->node_id . ':' . $this->password);

        $response = $this->_client->post($path, [
            'json' => $body,
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
            ]
        ]);

        return new Response($response);
    }

}