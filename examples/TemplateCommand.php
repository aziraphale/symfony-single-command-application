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
    /** @todo SET APP VERSION */
    // (or delete this constant if you don't want to use a version number)
    const APP_VERSION = '1.0.0';

    protected function configure()
    {
        $this
            /** @todo SET APPLICATION NAME */
            // Ordinarily this would set the name of the COMMAND, but that
            //  makes little sense for a single-command application, so instead
            //  the command name is extracted to be used as the name of the
            //  application as a whole!
            ->setName('My Example Console Application')

            /** @todo SET DESCRIPTION */
            // The description is displayed under the "Help" section of the
            //  text displayed when running the script and passing `--help`
            ->setDescription('Greet someone')

            /** @todo SET PROCESS TITLE (only if this is a long-running process/daemon) */
            ->setProcessTitle("My Example Application")

            /** @todo SET ARGUMENTS */
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )

            /** @todo SET OPTIONS */
            ->addOption(
               'yell',
               null,
               InputOption::VALUE_NONE,
               'If set, the task will yell in uppercase letters'
            )
        ;
    }

    /**
     * This method is executed before the interact() and the execute() methods.
     *  Its main purpose is to initialize variables used in the rest of the
     *  command methods.
     *
     * This can be deleted if it is not required.
     *
     * From the parent Symfony docs:
     *
     *      Initializes the command just after the input has been validated.
     *
     *      This is mainly useful when a lot of commands extends one main command
     *      where some things need to be initialized based on the input arguments and options.
     *
     *      @param InputInterface  $input  An InputInterface instance
     *      @param OutputInterface $output An OutputInterface instance
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {

    }

    /**
     * This method is executed after initialize() and before execute(). Its
     *  purpose is to check if some of the options/arguments are missing and
     *  interactively ask the user for those values. This is the last place
     *  where you can ask for missing options/arguments. After this command,
     *  missing options/arguments will result in an error.
     *
     * Note that this is ONLY executed if the application is being run in an
     *  "interactive" context (this means, amongst other things, that
     *  interact() won't be called if this application has data piped to it by
     *  the calling shell).
     *
     * This can be deleted if it is not required.
     *
     * From the parent Symfony docs:
     *
     *      Interacts with the user.
     *
     *      This method is executed before the InputDefinition is validated.
     *      This means that this is the only place where the command can
     *      interactively ask for values of missing required arguments.
     *
     *      @param InputInterface  $input  An InputInterface instance
     *      @param OutputInterface $output An OutputInterface instance
     */
    protected function interact(InputInterface $input, OutputInterface $output)
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
