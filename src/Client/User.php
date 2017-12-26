<?php
namespace Jiemo\Huanxin\Client;

use Jiemo\Huanxin\BaseClient;
use Jiemo\Huanxin\Model\User as UserModel;

class User extends BaseClient
{
    /**
     * 创建用户
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @param  UserModel $user
     * @param  boolean   $isOpen 是否为非授权注册
     * @return array
     */
    public function create(UserModel $user, $isOpen = false, $onSuccess = null, $onError = null)
    {

        $response = $this->client->post(
            $this->buildUrl('/users'),
            $this->getRequestOptions($user->toArray(), !$isOpen) + ['future' => true]
        );
        return $this->getJson($response);
    }

    /**
     * 批量创建用户
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @param  Jiemo\Huanxin\Model\User[] $users
     * @param  boolean $isOpen
     * @return array
     */
    public function batchCreate($users, $isOpen = false, $onSuccess = null, $onError = null)
    {
        $batchUser = [];
        foreach ($users as $user) {
            $batchUser[] = $user->toArray();
        }

        $response = $this->client->post(
            $this->buildUrl('/users'),
            $this->getRequestOptions($batchUser)
        );

        return $this->getJson($response);
    }

    /**
     * 获取用户
     *
     * @param  string $username
     * @return array
     */
    public function getUser($username)
    {
        $response = $this->client->get(
            $this->buildUrl(sprintf('/users/%s', $username)),
            $this->getRequestOptions()
        );

        return $this->getJson($response);
    }

    /**
     * 更改用户密码
     *
     * @param  string $username
     * @param  string $password
     *
     * @return array
     */
    public function changePassword($username, $password)
    {
        $response = $this->client->put(
            $this->buildUrl(sprintf('/users/%s/password', $username)),
            $this->getRequestOptions(['newpassword' => $password])
        );

        return $this->getJson($response);
    }

    /**
     * 更改用户昵称
     *
     * @param  string $username
     * @param  string $nickName
     *
     * @return array
     */
    public function changeNickName($username, $nickName)
    {
        $response = $this->client->put(
            $this->buildUrl(sprintf('/users/%s', $username)),
            $this->getRequestOptions(['nickname' => $nickName])
        );

        return $this->getJson($response);
    }
}
