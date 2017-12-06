<?php

namespace Jiemo\Huanxin\Command\File;

use Jiemo\Huanxin\ClientFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadCommand extends Command
{
    public function configure()
    {
        $this->setName('huanxin:file:download');
        $this->setDescription('下载文件')
            ->addArgument('filename', InputArgument::REQUIRED, '文件名称')
            ->addArgument('uuid', InputArgument::REQUIRED, '文件UUID')
            ->addArgument('sharesecret', InputArgument::REQUIRED, '文件 share secret');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('filename');
        $uuid = $input->getArgument('uuid');
        $secret = $input->getArgument('sharesecret');

        $client = ClientFactory::getClient('file');
        $res = $client->download($uuid, $secret, $file);
    }
}
