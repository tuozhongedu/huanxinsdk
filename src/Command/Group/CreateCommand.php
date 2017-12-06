<?php

namespace Jiemo\Huanxin\Command\Group;

use Jiemo\Huanxin\ClientFactory;
use Jiemo\Huanxin\Model\Group as GroupModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    public function configure()
    {
        $this->setName('huanxin:group:create');
        $this->setDescription('创建环信群组');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $client = ClientFactory::getClient('group');

        $groupModel = new GroupModel();
        $groupModel->setGroupname('test_' . time())
            ->setApproval((bool) 1)
            ->setIsPublic((bool) 0)
            ->setDesc('fffff')
            ->setOwner('congpeijun3')
            ->setMaxUsers(100);
        $r = $client->create($groupMode);
        print_r($r);
    }
}
