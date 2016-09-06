<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 06.09.16
 * Time: 2:16
 */

namespace JustOpen\ThemeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ThemeGruntCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('qps:theme:grunt')
            ->addOption('ext', null, InputOption::VALUE_NONE, 'Set scripts geterated by grunt.(CSS or JS)')
            ->setDescription('Grunt generate command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ext = $input->getOption('ext');

        //TODO: move formats to config
        if(in_array(mb_strtolower($ext),['css','js'])){
            
        }
    }
}