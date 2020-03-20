<?php

declare(strict_types=1);

namespace App\Core\Generator;

use InvalidArgumentException;

/**
 * Class Stub
 *
 * @package App\Core\Generators
 */
class Stub
{
    public const STUB_BASE_PATH = 'resources/generator/stubs/';

    private string $name;
    private string $output;
    private string $content;
    private Variable $variables;

    /**
     * Stub constructor.
     *
     * @param  string  $stubName
     * @param  string  $output
     */
    public function __construct(string $stubName, string $output)
    {
        $this->name = $stubName;
        $this->output = $output;

        $this->loadContent();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables->getVariables();
    }

    /**
     * Replace stub variables.
     *
     * @param  array  $inputVariables
     */
    public function replaceVariables(array $inputVariables)
    {
        $variables = $this->variables->getFormatted($inputVariables);

        $this->content = str_replace(
            array_keys($variables),
            array_values($variables),
            $this->content
        );

        $this->output = str_replace(
            array_keys($variables),
            array_values($variables),
            $this->output
        );
    }

    /**
     * Get stub file content.
     *
     * @return void
     */
    private function loadContent(): void
    {
        if (! $this->exists()) {
            throw new InvalidArgumentException("The {$this->name} stub does not exists.");
        }

        $this->content = file_get_contents($this->getPath());

        $this->variables = new Variable($this->output.$this->content);
    }

    /**
     * Check if stub exists.
     *
     * @return bool
     */
    private function exists(): bool
    {
        return file_exists($this->getPath());
    }

    /**
     * Get stub path.
     *
     * @return string
     */
    private function getPath(): string
    {
        return base_path(self::STUB_BASE_PATH.$this->name);
    }
}
