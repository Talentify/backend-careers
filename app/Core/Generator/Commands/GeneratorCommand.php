<?php

declare(strict_types=1);

namespace App\Core\Generator\Commands;

use App\Core\Generator\Generator;
use Exception;
use Illuminate\Console\Command;

/**
 * Class GeneratorCommand
 *
 * @package App\Console\Commands
 */
class GeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate files from template';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $generator = new Generator($this->argument('name'));

            $this->askForVariables($generator);

            $generator->save();

            $this->info('Files created successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param  Generator  $generator
     */
    private function askForVariables(Generator $generator)
    {
        $responses = [];

        foreach ($generator->getVariables() as $variable) {
            $responses[$variable] = $this->ask(
                "Insert the value for <fg=black;bg=green>${variable}</>"
            );
        }

        $generator->defineVariables($responses);
    }
}
