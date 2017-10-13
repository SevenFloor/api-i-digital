<?php
/**
 * Copyright (C) $user$, Inc - All Rights Reserved
 *
 *  <other text>
 * @file        Content.php
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
 * Class Content
 * @package sevenfloor\apiidigital
 */
/**
 * Class Body
 * @package sevenfloor\apiidigital
 */
/**
 * Class Body
 * @package sevenfloor\apiidigital
 */
class Body
{


    /**
     * Тип сообщения Текст
     */
    const TYPE_TEXT = 'text';
    /**
     * тип сообщения Viber
     */
    const TYPE_VIBER = 'viber';

    /**
     * Тип содержимого image
     */
    const CONTENT_TYPE_IMAGE = 'image';

    /**
     * Тип содержимого button
     */
    const CONTENT_TYPE_BUTTON = 'button';

    /**
     * Тип для отправки text|viber
     * @var
     */
    public $bodyType;

    /**
     * Текст сообщения
     * @var
     */
    public $text;

    /**
     * Тип содержимого image|button
     * @var string
     */
    public $content_type;

    /**
     * Наименование кнопки (надпись на кнопке)
     * @var
     */
    public $caption;

    /**
     * URL страницы, на которую будет отправлен абонент при нажатии на кнопку
     * @var
     */
    public $action;

    /**
     * URL изображения
     * @var
     */
    public $imageUrl;


    /**
     * Body constructor.
     * @param $bodyType
     * @param $text
     * @param null $content_type
     * @param null $caption
     * @param null $action
     * @param null $imageUrl
     */
    public function __construct($bodyType, $text, $content_type = null, $caption = null, $action = null, $imageUrl = null)
    {
        $this->bodyType = $bodyType;
        $this->text = $text;
        $this->content_type = $content_type;
        $this->caption = $caption;
        $this->action = $action;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getBody()
    {
        if ($this->bodyType == self::TYPE_TEXT) {
            $body = [
                'bodyType' => $this->bodyType,
                'content' => $this->text

            ];
        } elseif ($this->bodyType == self::TYPE_VIBER) {
            if ($this->content_type == self::CONTENT_TYPE_BUTTON) {
                $body = [
                    'bodyType' => $this->bodyType,
                    'content' => [
                        'content_type' => $this->content_type,
                        'text' => $this->text,
                        'caption' => $this->caption,
                        'action' => $this->action,
                        'imageUrl' => $this->imageUrl
                    ]
                ];
            } elseif ($this->content_type == self::CONTENT_TYPE_IMAGE) {
                $body = [
                    'bodyType' => $this->bodyType,
                    'content' => [
                        'content_type' => $this->content_type,
                        'imageUrl' => $this->imageUrl
                    ]
                ];
            } else {
                $body = [
                    'bodyType' => $this->bodyType,
                    'content' => [
                        'content_type' => $this->content_type,
                        'text' => $this->text,
                    ]
                ];
            }


        }
        if (empty($body)) {
            throw new \Exception('Body for request not set content');
        }

        return $body;
    }
}