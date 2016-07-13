<?php

/** @todo UPDATE THIS PATH IF NECESSARY (probably remove the `../`) */
require __DIR__ . '/../vendor/autoload.php';

use Aziraphale\Symfony\SingleCommandApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TemplateCommand
 *
 * Much of the body of this demo class was copied from the Symfony documentation
 *
 * @todo RENAME THE CLASS
 */
class TemplateCommand extends Command
{
    protected function configure()
    {
        $this
            /** @todo SET COMMAND NAME */
            ->setName('demo:greet')
            /** @todo SET DESCRIPTION */
            ->setDescription('Greet someone')
            /** @todo SET OPTIONS */
            ->addOption(
               'yell',
               null,
               InputOption::VALUE_NONE,
               'If set, the task will yell in uppercase letters'
            )
            /** @todo SET ARGUMENTS */
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
        ;
    }

    /**
     * This method is executed before the interact() and the execute() methods.
     *  Its main purpose is to initialize variables used in the rest of the
     *  command methods.
     *
     * This can be deleted if it is not required.
     */
    protected function initialize()
    {

    }

    /**
     * This method is executed after initialize() and before execute(). Its
     *  purpose is to check if some of the options/arguments are missing and
     *  interactively ask the user for those values. This is the last place
     *  where you can ask for missing options/arguments. After this command,
     *  missing options/arguments will result in an error.
     *
     * This can be deleted if it is not required.
     */
    protected function interact()
    {

    }

    /**
     * This method is executed after interact() and initialize(). It contains
     *  the logic you want the command to execute.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @todo WRITE COMMAND BODY */
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);
    }
}

                        /** @todo UPDATE COMMAND CLASS NAME (the "TemplateCommand") */
(new SingleCommandApplication(new TemplateCommand()))->run();
