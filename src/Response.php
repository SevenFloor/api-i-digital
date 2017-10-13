<?php
/**
 * Copyright (C) $user$, Inc - All Rights Reserved
 *
 *  <other text>
 * @file        Response.php
 * @author      ignatenkovnikita
 * @date        $date$
 */

/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Web Site: http://IgnatenkovNikita.ru
 */

namespace sevenfloor\apiidigital;


/**
 * Class Response
 * @package sevenfloor\apiidigital
 */
class Response
{
    /**
     * Идентификатор сообщения
     * @var
     */
    public $id;
    /**
     * Время запроса в формате unixtime
     * @var
     */
    public $timestamp;
    /**
     * Код 200 в случае успешной обработки запроса
     * @var
     */
    public $code;
    /**
     * Описание ошибки
     * @var
     */
    public $description;

    /**
     * True если успешный запрос
     * @var bool
     */
    public $success;

    /**
     * @var array
     */
    public $states = [];

    /**
     * Response constructor.
     * @param $data
     * @throws \Exception
     */
    public function __construct($data)
    {
        $data = json_decode($data, true);
        if (empty($data)) {
            throw new \Exception('Empty response');
        }

        $this->success = $data['code'] == 200 ? true : false;
        $this->id = isset($data['id']) ? $data['id'] : null;

        $this->code = $data['code'];
        $this->timestamp = $data['timestamp'];
        $this->description = isset($data['description']) ? $data['description'] : null;

        if (isset($data['states'])) {
            foreach ($data['states'] as $state) {
                $this->states[] = new State($state);
            }
        }
    }
}