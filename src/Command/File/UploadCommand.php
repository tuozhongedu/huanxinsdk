<?php

namespace Jiemo\Huanxin\Command\File;

use Jiemo\Huanxin\ClientFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UploadCommand extends Command
{
    public function configure()
    {
        $this->setName('huanxin:file:upload');
        $this->setDescription('上传文件')
            ->addArgument('filename', InputArgument::REQUIRED, '文件路径');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('filename');
        $client = ClientFactory::getClient('file');
        $res = $client->upload($file);
        print_r($res);
    }
}
