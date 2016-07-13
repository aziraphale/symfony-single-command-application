# Symfony Single-Command Application

This is an extension of Symfony's Console application that simplifies the creation of simple, single-command PHP CLI scripts, saving a great deal of time and repeated code.

## Installation

Just use Composer:

```composer require aziraphale/symfony-single-command-application```

And then it should autoload as everything else does, so the example class in `/examples/TemplateCommand.php` should work straight away.

## Usage

See `/examples/TemplateCommand.php` to see how to use this class. It's probably easiest to simply copy `TemplateCommand.php` for every new single-command Symfony Console application that you create.
