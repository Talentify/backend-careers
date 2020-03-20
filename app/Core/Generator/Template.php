<?php

declare(strict_types=1);

namespace App\Core\Generator;

use InvalidArgumentException;

/**
 * Class Template
 *
 * @package App\Core\Generators
 */
class Template
{
    public const TEMPLATE_BASE_PATH = 'resources/generator/templates/';

    public array $stubs;

    /**
     * Template constructor.
     *
     * @param  string  $templateName
     */
    public function __construct(string $templateName)
    {
        $this->loadTemplate($templateName);
    }

    /**
     * @param $templateName
     */
    public function loadTemplate($templateName)
    {
        if (! Template::exists($templateName)) {
            throw new InvalidArgumentException('This template does not exists.');
        }

        $templateContents = file_get_contents(Template::getPath($templateName));

        $loadedTemplate = json_decode($templateContents, true);

        foreach ($loadedTemplate['stubs'] as $key => $file) {
            $this->stubs[] = new Stub($file['stub'], $file['output']);
        }
    }

    /**
     * Replace variable templates by provided values.
     *
     * @param  array  $variables
     */
    public function replaceStubVariables(array $variables): void
    {
        /** @var Stub $stub */
        foreach ($this->stubs as $key => $stub) {
            $stub->replaceVariables($variables);
        }
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        $variables = [];

        /** @var Stub $stub */
        foreach ($this->stubs as $key => $stub) {
            $variables = [...$variables, ...$stub->getVariables()];
        }

        return array_unique($variables);
    }

    /**
     * Check if template exists.
     *
     * @param $templateName
     *
     * @return bool
     */
    private static function exists($templateName): bool
    {
        return file_exists(Template::getPath($templateName));
    }

    /**
     * Get template path.
     *
     * @param  string  $templateName
     *
     * @return string
     */
    private static function getPath(string $templateName): string
    {
        return base_path(self::TEMPLATE_BASE_PATH.$templateName.'.json');
    }
}
