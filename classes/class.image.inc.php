<?php

namespace maru\og;

/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 13:20
 */
class Image
{
    protected $priority;
    protected $url;
    protected $secure_url;
    protected $width;
    protected $heigt;
    protected $type;
    protected $errors = array();


    /**
     * Image constructor.
     * @param $params array
     */
    public function __construct($params = array())
    {
        if (!is_array($params)) {
            if (OpenGraph::$debug) {
                throw new \Exception('Params must be an array');
            }
        } else {
            foreach ($params as $key => $value) {
                switch ($key) {
                    case 'url':
                        $this->setUrl($value);
                        break;
                    case 'secure_url':
                        $this->setSecureUrl($value);
                        break;
                    case 'width':
                        $this->setWidth($value);
                        break;
                    case 'height':
                        $this->setHeigt($value);
                        break;
                    case 'type':
                        $this->setType($value);
                        break;
                    default:
                        $this->addError($key . ' is not a valid parameter');
                        break;
                }
            }
            if(!empty($this->errors)) {
                if(OpenGraph::$debug) {
                    throw new \Exception(implode("\n AND ", $this->getErrors()));
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getSecureUrl()
    {
        return $this->secure_url;
    }

    /**
     * @param mixed $secure_url
     */
    public function setSecureUrl($secure_url)
    {
        $this->secure_url = $secure_url;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeigt()
    {
        return $this->heigt;
    }

    /**
     * @param mixed $heigt
     */
    public function setHeigt($heigt)
    {
        $this->heigt = $heigt;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function addError($message)
    {
        $this->errors[] = $message;
    }




}