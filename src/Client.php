<?php

namespace sevenfloor\apiidigital;


/**
 * Class Client
 * @package sevenfloor\apiidigital
 */
class Client
{

    /**
     * Идентификатор ноды
     * @var
     */
    public $node_id;

    /**
     * Пароль
     * @var
     */
    public $password;

    /** @var \GuzzleHttp\Client $_client */
    public $_client;

    /**
     * Адрес сервера
     * @var string
     */
    public $base_uri;


    /**
     * Client constructor.
     */
    public function __construct($base_uri)
    {
        $this->_client = new \GuzzleHttp\Client(['base_uri' => $base_uri]);
    }

    /**
     * @param Body $body
     * @param $source
     * @param $destination
     * @param bool $requestDelivery
     * @internal param int $expirationDate
     * @return Response
     */
    public function message(Body $body, $source, $destination, $requestDelivery = true, $expirationDate = '+1 day')
    {
        $message = [
            '@type' => 'outbound',
            'addresses' => ['source' => $source, 'destination' => $destination],
            'body' => $body->getBody(),
            'nodeId' => $this->node_id,
            'requestDelivery' => $requestDelivery,
            'expirationDate' => strtotime($expirationDate)
        ];

        return $this->_send('/message', $message);

    }

    /**
     *
     */
    public function pack()
    {
    }

    /**
     * @param int $count_receive Кол-во получаемых статусов
     * @return Response
     */
    public function receive($count_receive = 5)
    {
        return $this->_send('/receive', $count_receive);
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

        $response = $this->_client->request('POST', $path, [
            'json' => $body,
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
            ]
        ]);

        return new Response($response->getBody()->getContents());
    }
}
