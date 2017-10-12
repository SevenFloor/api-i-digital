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
class Body
{


    /**
     *
     */
    const TYPE_TEXT = 'text';
    /**
     *
     */
    const TYPE_VIBER = 'viber';

    const CONTENT_TYPE_IMAGE = 'image';
    const CONTENT_TYPE_BUTTON = 'button';

    /**
     * @var
     */
    public $bodyType;

    /**
     * @var
     */
    public $text;
    /**
     * @var string
     */
    public $content_type;

    /**
     * @var
     */
    public $caption;
    /**
     * @var
     */
    public $action;
    /**
     * @var
     */
    public $imageUrl;


    public function __construct($bodyType, $text, $content_type = null, $caption = null, $action = null, $imageUrl = null)
    {
        $this->bodyType = $bodyType;
        $this->text = $text;
        $this->content_type = $content_type;
        $this->caption = $caption;
        $this->action = $action;
        $this->imageUrl = $imageUrl;
    }

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