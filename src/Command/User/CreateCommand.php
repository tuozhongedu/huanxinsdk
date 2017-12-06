<?php

namespace Jiemo\Huanxin\Command\User;

use Jiemo\Huanxin\ClientFactory;
use Jiemo\Huanxin\Model\User as UserModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    public function configure()
    {
        $this->setName('huanxin:user:create');
        $this->setDescription('创建环信用户');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $client = ClientFactory::getClient('user', ['async' => true]);
        $userModel1 = new UserModel();
        $userModel1->setUsername('11856335')->setPassword('1')->setNickname('芥末Ray');
        $userModel2 = new UserModel();
        $userModel2->setUsername('18571')->setPassword('1')->setNickname('芥末Emma');
        try {
            $r = $client->create($userModel1, false);
            print_r($r);
        } catch (\Exception $e) {
            echo $e->getResponse()->getBody();
        }

        exit;
        $users = [
            $userModel1,
            $userModel2,
        ];

        $r = $client->batchCreate($users, true, function ($response) {
            print_r($response->json());
        }, function ($error) {
            echo $error->getMessage();
        });
    }
}
