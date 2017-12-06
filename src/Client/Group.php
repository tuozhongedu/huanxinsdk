<?php

namespace Jiemo\Huanxin\Client;

use Jiemo\Huanxin\BaseClient;
use Jiemo\Huanxin\Model\Group as GroupModel;

class Group extends BaseClient
{
    /**
     * 创建群组
     * @param  GroupModel $group [description]
     * @return array
     */
    public function create(GroupModel $group)
    {
        try {
            $response = $this->client->post(
                $this->buildUrl('/chatgroups'),
                $this->getRequestOptions($group->toArray())
            );
            return $this->getJson($response);
        } catch (\Exception $e) {
            // $h = $e->getRequest()->getHeaders();
            // var_dump($h);
            throw $e;
        }
    }

    /**
     * 更新群组
     * @param  int $groupid 群组ID
     * @return array
     */
    public function update(GroupModel $group)
    {
        $data = array(
            'groupname' => $group->getGroupname(),
            'description' => $group->getDesc(),
            'maxusers' => $group->getMaxUsers(),
        );

        try {
            $response = $this->client->put(
                $this->buildUrl('/chatgroups/' . $group->getGroupid()),
                $this->getRequestOptions($data)
            );
            return $this->getJson($response);
        } catch (\Exception $e) {
            // echo $h = $e->getRequest()->getMethod();
            // echo $e->getResponse()->getBody();
            // var_dump($h);
            throw $e;
        }
    }

    /**
     * 删除群组
     * @param  int 群组ID
     * @return array
     */
    public function delete($groupId)
    {
        return $this->getJson($this->client->delete(
            $this->buildUrl('/chatgroups/' . $groupId),
            $this->getRequestOptions()
        ));
    }

    /**
     * 添加群组成员
     * @param int $groupId
     * @param string $username
     */
    public function addMember($groupId, $username)
    {
        return $this->getJson($this->client->post(
            $this->buildUrl('/chatgroups/' . $groupId . '/users/' . $username),
            $this->getRequestOptions()
        ));
    }

    /**
     *　批量添加群组成员
     * @param int $groupId
     */
    public function addMembers($groupId)
    {
        $options = $this->getRequestOptions();

        $options['json'] = ['usernames' => $this->members];
        return $this->getJson($this->client->post(
            $this->buildUrl('/chatgroups/' . $groupId . '/users'),
            $options
        ));
    }

    /**
     * 移除群组成员
     * @param  int $groupId
     * @return array
     */
    public function removeMembers($groupId)
    {
        return $this->getJson($this->client->delete(
            $this->buildUrl('/chatgroups/' . $groupId . '/users/' . implode(',', $this->members)),
            $this->getRequestOptions()
        ));
    }
}
