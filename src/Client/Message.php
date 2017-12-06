<?php
/**
 * 环信消息
 */
namespace Jiemo\Huanxin\Client;

use Jiemo\Huanxin\BaseClient;
use Jiemo\Huanxin\Model\Message as MessageModel;

class Message extends BaseClient
{
    /**
     * 发送消息
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @params Jiemo\Huanxin\Model\Message $message
     * @return array
     */
    public function send(MessageModel $message)
    {
        $response = $this->client->post(
            $this->buildUrl('/messages'),
            $this->getRequestOptions($message->toArray())
        );
        return $this->getJson($response);
    }

    /**
     * 导出消息记录
     *
     * @author dongmingdi <dongmingdi@tuozhongedu.com>
     * @params string $date
     * @return array
     */
    public function chatmessages($date = "")
    {
        if(empty($date))
        {
            return array($date);
        }
        $response = $this->client->get(
            $this->buildUrl('/chatmessages/' . $date),
            $this->getRequestOptions()
        );
        return $this->getJson($response);
    }
}
