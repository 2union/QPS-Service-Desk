<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 06.09.16
 * Time: 11:46
 */

namespace JustOpen\ThemeBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ThemeBowerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('qps:theme:bower')
            ->setDescription('Run bower');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}