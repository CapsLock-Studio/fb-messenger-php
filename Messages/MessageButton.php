<?php

namespace pimax\Messages;

/**
 * Class MessageButton
 * @package pimax\Messages
 */
class MessageButton
{
    /**
     * Web url button type
     */
    const TYPE_WEB = "web_url";

    /**
     * Postback button type
     */
    const TYPE_POSTBACK = "postback";

    /**
     * Phone number button type
     */
    const TYPE_PHONE_NUMBER = "phone_number";

    /**
     * Element share button type
     */
    const TYPE_ELEMENT_SHARE = "element_share";

    /**
     * Button type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * Button title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Button url
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * MessageButton constructor.
     *
     * @param string $type
     * @param string $title
     * @param string $url url or postback
     */
    public function __construct($type, $title = '', $url = '')
    {
        $this->type = $type;
        $this->title = $title;

        if (!$url) {
            $url = $title;
        }

        $this->url = $url;
    }

    /**
     * Get Button data
     *
     * @return array
     */
    public function getData()
    {
        $result = [
            'type' => $this->type,
            'title' => $this->title,
        ];

        switch($this->type)
        {
            case self::TYPE_ELEMENT_SHARE:
                unset($result['title']);
            break;
            case self::TYPE_PHONE_NUMBER:
            case self::TYPE_POSTBACK:
                $result['payload'] = $this->url;
            break;

            case self::TYPE_WEB:
                $result['url'] = $this->url;
            break;
        }

        return $result;
    }
}
