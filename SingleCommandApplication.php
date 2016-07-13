<?php

namespace Aziraphale\Symfony;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class SingleCommandApplication extends Application
{
    private $singleCommand;

    public function __construct(
        Command $singleCommand,
        $name = 'UNKNOWN',
        $version = 'UNKNOWN'
    ) {
        $this->singleCommand = $singleCommand;

        parent::__construct($name, $version);

        $this->add($singleCommand);
        $this->setDefaultCommand($singleCommand->getName());
    }

    /**
     * Gets the name of the command based on input.
     *
     * @param InputInterface $input The input interface
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input)
    {
        return $this->singleCommand->getName();
    }

    /**
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = clone $this->singleCommand;

        return $defaultCommands;
    }

    /**
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
