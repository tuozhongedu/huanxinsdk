<?php

namespace Jiemo\Huanxin\Model;

use Jiemo\Huanxin\ModelInterface;

class Group implements ModelInterface
{
    private $groupname;
    private $desc;
    private $isPublic = true;
    private $approval = false;
    private $owner;
    private $maxUsers = 2000;
    private $members = array();
    private $groupid;

    public function toArray()
    {
        return [
            'groupname' => $this->groupname,
            'desc' => $this->desc,
            'public' => $this->isPublic,
            'approval' => $this->approval,
            'owner' => $this->owner,
            'members' => $this->members,
            'maxusers' => $this->maxUsers,
        ];
    }

    /**
     * Gets the value of groupname.
     *
     * @return mixed
     */
    public function getGroupname()
    {
        return $this->groupname;
    }

    /**
     * Sets the value of groupname.
     *
     * @param mixed $groupname the groupname
     *
     * @return self
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;
        return $this;
    }

    /**
     * Gets the value of desc.
     *
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Sets the value of desc.
     *
     * @param mixed $desc the desc
     *
     * @return self
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    /**
     * Gets the value of isPublic.
     *
     * @return mixed
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Sets the value of isPublic.
     *
     * @param mixed $isPublic the is public
     *
     * @return self
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    /**
     * Gets the value of approval.
     *
     * @return mixed
     */
    public function getApproval()
    {
        return $this->approval;
    }

    /**
     * Sets the value of approval.
     *
     * @param mixed $approval the approval
     *
     * @return self
     */
    public function setApproval($approval)
    {
        $this->approval = $approval;
        return $this;
    }

    /**
     * Gets the value of owner.
     *
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Sets the value of owner.
     *
     * @param mixed $owner the owner
     *
     * @return self
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Gets the value of maxUsers.
     *
     * @return mixed
     */
    public function getMaxUsers()
    {
        return $this->maxUsers;
    }

    /**
     * Sets the value of maxUsers.
     *
     * @param mixed $maxUsers the max users
     *
     * @return self
     */
    public function setMaxUsers($maxUsers)
    {
        $this->maxUsers = $maxUsers;
        return $this;
    }

    /**
     * Gets the value of members.
     *
     * @return mixed
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Sets the value of members.
     *
     * @param mixed $members the members
     *
     * @return self
     */
    public function setMembers($members)
    {
        $this->members = $members;
        return $this;
    }

    /**
     * Gets the value of groupid.
     *
     * @return mixed
     */
    public function getGroupid()
    {
        return $this->groupid;
    }

    /**
     * Sets the value of groupid.
     *
     * @param mixed $groupid the groupid
     *
     * @return self
     */
    public function setGroupid($groupid)
    {
        $this->groupid = $groupid;
        return $this;
    }
}
