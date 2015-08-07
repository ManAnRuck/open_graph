<?php

namespace maru\og;

/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 13:20
 */
class Profile
{
    protected $priority;
    protected $firstName;
    protected $lastName;
    protected $username;
    protected $gender;
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
                    case 'firstname':
                        $this->setFirstName($value);
                        break;
                    case 'lastname':
                        $this->setLastName($value);
                        break;
                    case 'username':
                        $this->setUsername($value);
                        break;
                    case 'gender':
                        $this->setGender($value);
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }






}