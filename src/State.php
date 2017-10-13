<?php
/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Web Site: http://IgnatenkovNikita.ru
 */

namespace sevenfloor\apiidigital;

/**
 * Class State
 * @package sevenfloor\apiidigital
 */
class State
{
    /**
     * Идентификатор сообщения
     * @var string
     */
    public $msid;

    /**
     * Статус сообщения
     * @var string
     */
    public $status;

    /**
     * Дата формирования статуса сообщения
     * @var integer
     */
    public $creationDate;

    /**
     * Код ошибки при обработке сообщения.
     * @var integer
     */
    public $errorCode;
    /**
     * Финальный статус либо промежуточный
     * @var boolean
     */
    public $final;


    /**
     * State constructor.
     * @param $data
     */
    public function __construct($data)
    {
        foreach ($data as $key => $datum) {
            $this->{$key} = array_key_exists($key, $data)
                ? $datum
                : null;
        }
    }
}