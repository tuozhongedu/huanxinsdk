<?php

namespace Jiemo\Huanxin\Model;

use Jiemo\Huanxin\ModelInterface;

class User implements ModelInterface
{
    private $username;
    private $password;
    private $nickname = null;

    public function toArray()
    {
        $return = [
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
        ];

        if (null !== $this->nickname) {
            $return['nickname'] = $this->nickname;
        };

        return $return;
    }

    /**
     * Gets the value of username.
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the value of username.
     *
     * @param mixed $username the username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Gets the value of password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param mixed $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Gets the value of nickname.
     *
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Sets the value of nickname.
     *
     * @param mixed $nickname the nickname
     *
     * @return self
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }
}
