<?php

namespace Jiemo\Huanxin\Model;

use Jiemo\Huanxin\ModelInterface;

class Message implements ModelInterface
{
    const MESSAGE_TYEP_USERS = 'users';
    const MESSAGE_TYEP_CHATGROUPS = 'chatgroups';
    const MESSAGE_TYEP_CHATROOMS = 'chatrooms';

    private $targetType = ''; // chatgroups, chatrooms
    private $target = [];
    private $type = 'txt';
    private $msg = '';
    private $from = '';
    private $ext = [];

    public function toArray()
    {
        $body = [
            'target_type' => $this->targetType ?: self::MESSAGE_TYEP_USERS,
            'target' => $this->target,
            'msg' => [
                'type' => $this->type,
                'msg' => $this->msg,
            ],
        ];

        if ($this->type == 'cmd') {
            unset($body['msg']['msg']);
            $body['msg']['action'] = $this->msg;
        }

        if ($this->ext) {
            $body['ext'] = $this->ext;
        }

        return $body;
    }

    /**
     * Sets the value of targetType.
     *
     * @param mixed $targetType the target type
     *
     * @return self
     */
    public function setTargetType($targetType)
    {
        $this->targetType = $targetType;
        return $this;
    }

    /**
     * Sets the value of target.
     *
     * @param mixed $target the target
     *
     * @return self
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Sets the value of type.
     *
     * @param mixed $type the type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Sets the value of msg.
     *
     * @param mixed $msg the msg
     *
     * @return self
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Sets the value of from.
     *
     * @param mixed $from the from
     *
     * @return self
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Sets the value of ext.
     *
     * @param mixed $ext the ext
     *
     * @return self
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    public function addTarget($target)
    {
        $this->target[] = $target;
        return $this;
    }
}
