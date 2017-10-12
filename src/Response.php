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


    public function __construct($data)
    {
        if (empty($data)) {
            throw new \Exception('Empty response');
        }

        if ($data['code'] == 200) {
            $this->success = true;
            $this->id = $data['id'];
            $this->code = $data['code'];
            $this->timestamp = $data['timestamp '];
        }
        else{
            $this->success = false;
            $this->code = $data['code'];
            $this->timestamp = $data['timestamp '];
            $this->description  = $data['description '];
        }


    }


}