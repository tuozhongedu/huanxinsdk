<?php
namespace Jiemo\Huanxin\Command\Message;

use Jiemo\Huanxin\ClientFactory;
use Jiemo\Huanxin\Model\Message as MessageModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendCommand extends Command
{
    public function configure()
    {
        $this->setName('huanxin:message:send');
        $this->setDescription('发送环信消息');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $client = ClientFactory::getClient('message');

        $message = new MessageModel();
        $message->setFrom('congpeijun3')->setMsg('test')->addTarget('congpeijun4');
        $r = $client->send($message);

        print_r($r);
    }
}
