<?php

namespace maru\og;

/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 13:20
 */
class Video
{
    protected $priority;
    protected $url;
    protected $actor;
    protected $actorRole;
    protected $director;
    protected $writer;
    protected $duration;
    protected $releaseDate;
    protected $tags = array();
    protected $series;
    protected $secureUrl;
    protected $type;
    protected $width;
    protected $height;
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
                    case 'actor':
                        $this->setActor($value);
                        break;
                    case 'actorrole':
                        $this->setActorRole($value);
                        break;
                    case 'director':
                        $this->setDirector($value);
                        break;
                    case 'writer':
                        $this->setWriter($value);
                        break;
                    case 'duration':
                        $this->setDuration($value);
                        break;
                    case 'releasedate':
                        $this->setReleaseDate($value);
                        break;
                    case 'tags':
                        $this->setTags($value);
                        break;
                    case 'series':
                        $this->setSeries($value);
                        break;
                    case 'secureurl':
                        $this->setSecureUrl($value);
                        break;
                    case 'type':
                        $this->setType($value);
                        break;
                    case 'width':
                        $this->setWidth($value);
                        break;
                    case 'heigt':
                        $this->setHeight($value);
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
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * @param mixed $actor
     */
    public function setActor($actor)
    {
        $this->actor = $actor;
    }

    /**
     * @return mixed
     */
    public function getActorRole()
    {
        return $this->actorRole;
    }

    /**
     * @param mixed $actorRole
     */
    public function setActorRole($actorRole)
    {
        $this->actorRole = $actorRole;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @param mixed $writer
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param mixed $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }

    /**
     * @return mixed
     */
    public function getSecureUrl()
    {
        return $this->secureUrl;
    }

    /**
     * @param mixed $secureUrl
     */
    public function setSecureUrl($secureUrl)
    {
        $this->secureUrl = $secureUrl;
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
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }








}