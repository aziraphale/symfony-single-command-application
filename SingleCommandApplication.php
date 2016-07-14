<?php

namespace Aziraphale\Symfony;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class SingleCommandApplication extends Application
{
    private $singleCommand;

    public function __construct(
        Command $singleCommand
    ) {
        global $argv;
        $this->singleCommand = $singleCommand;

        // Use the command's name as the whole app's name
        $this->setName($singleCommand->getName());

        // Then set the command's name to be the name of the script file
        //  executed (as executed, regardless of symlinks, etc) - i.e.
        //  whatever's set as $argv[0] - because this name ends up displayed in
        //  the "Usage" line of the `--help` output. Though we use the executed
        //  script's base name (i.e. none of the directories leading to it)
        //  because including any parts of the directory path results in a
        //  `--help` output that's very different to all native/standard
        //  commands.
        // This will result in the "Usage" section displaying as:
        //     my-command.php [options] [--] <arguments>
        //  instead of showing the name of the command in place of
        //  'my-command.php', which is especially useful for single-command
        //  apps, as the command name is never even referenced anywhere else!
        $commandName = isset($argv[0]) ? basename($argv[0]) : 'command.php';
        $singleCommand->setName($commandName);

        parent::__construct();
        $this->add($singleCommand);
        $this->setDefaultCommand($singleCommand->getName());

        // If the command class has an 'APP_VERSION' constant defined, we use
        //  that as the entire app's version, as this seems like a much more
        //  sensible place to indicate the version than in the Application
        //  constructor which is tucked away in a non-obvious place!
        $commandClass = get_class($singleCommand);
        if (defined($commandClass.'::APP_VERSION')) {
            $this->setVersion(constant($commandClass.'::APP_VERSION'));
        }
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
