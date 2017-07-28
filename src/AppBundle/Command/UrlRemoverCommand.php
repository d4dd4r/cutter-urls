<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Utils\UrlCompressHelper;

class UrlRemoverCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('url:remove:old')
             ->setDescription('Compress a url')
             ->setHelp('This command give you short link of your url-address which should have the good response status');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $urlHelper = new UrlCompressHelper($container);
        $removedUrls = $urlHelper->removeOldUrls();

        if (empty($removedUrls)) $removedUrls = 'Today is a good day to save urls!';

        $output->writeln([
            'Url Remover',
            '==========',
            'Next urls have been removed:',
        ]);
        $output->writeln($removedUrls);
    }
}
