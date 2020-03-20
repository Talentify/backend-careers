<?php

declare(strict_types=1);

namespace App\Core\Generator;

use File;
use InvalidArgumentException;

/**
 * Class Generator
 *
 * @package App\Core\Generators
 */
class Generator
{
    public const OUTPUT_BASE_PATH = '';

    private Template $template;

    /**
     * Generator constructor.
     *
     * @param  string  $templateName
     */
    public function __construct(string $templateName)
    {
        $this->defineTemplate($templateName);
    }

    /**
     * Load template.
     *
     * @param $templateName
     *
     * @throws InvalidArgumentException
     */
    public function defineTemplate($templateName): void
    {
        $this->template = new Template($templateName);
    }

    /**
     * Get variables list.
     *
     * @return array
     */
    public function getVariables(): array
    {
        return $this->template->getVariables();
    }

    /**
     * Replace template variables based on input.
     *
     * @param  array  $variables
     */
    public function defineVariables(array $variables): void
    {
        $this->template->replaceStubVariables($variables);
    }

    /**
     * Save files to disk.
     */
    public function save(): void
    {
        /** @var Stub $stub */
        foreach ($this->template->stubs as $key => $stub) {
            $path = self::OUTPUT_BASE_PATH.$stub->getOutput();
            $dir = dirname($path);

            if (! is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            File::put($path, $stub->getContent());
        }
    }
}
