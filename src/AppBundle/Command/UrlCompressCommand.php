<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Utils\UrlCompressHelper;

class UrlCompressCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('url:compress')
             ->setDescription('Compress a url')
             ->setHelp('This command give you short link of your url-address which should have the good response status')
             ->addArgument('url', InputArgument::REQUIRED, 'The url which will be converted');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $em = $this->getContainer()->get('doctrine')->getManager();
        $container = $this->getContainer();
        $url = $input->getArgument('url');
        $urlHelper = new UrlCompressHelper($container);
        $response = $urlHelper->saveUrl($url);
        $response = json_decode($response->getContent(), true);

        if ($response['status'] !== 'success') {
            $output->writeln([
                'Url Compresser',
                '==============',
                "Your base url is: {$url}",
                '',
                '==== ERROR ===',
                $response['code']
            ]);
        } else {
            $urlCompressed = $response['data']['urlCompressed'];
            $serverHost = $this->getContainer()->getParameter('server_host');
            $serverPort = $this->getContainer()->getParameter('server_port');
            $serverUrl = "{$serverHost}:{$serverPort}";

            $output->writeln([
                'Url Compresser',
                '==============',
                "Your base url is: {$url}",
                "Your compress url is: {$serverUrl}/{$urlCompressed}"
            ]);
        }
    }
}
