<?php

declare(strict_types=1);

namespace App\Core\Generator;

use Str;

class Variable
{
    public const OPEN_TAG = '{{';
    public const CLOSE_TAG = '}}';

    private array $variables;
    private array $formattedVariables;
    private array $modifiers;
    private array $functions;

    public function __construct(string $content)
    {
        $this->loadVariables($content);
    }

    /**
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    public function getFormatted(array $inputVariables)
    {
        foreach ($inputVariables as $variable => $value) {
            foreach ($this->modifiers as $modifier) {
                $formattedVariable = $this->convertVariableToTemplateFormat($variable, $modifier);
                $formattedValue = $this->getFormattedValue($value, $modifier);

                $this->formattedVariables[$formattedVariable] = $formattedValue;
            }
        }

        foreach ($this->functions as $function) {
            $this->formattedVariables[$function] = $this->getFunctionValue(str_replace(['{{@', '}}'], '', $function));
        }

        return $this->formattedVariables;
    }

    /**
     * Get a list of all variables in template.
     *
     * @param  string  $content
     *
     * @return void
     */
    private function loadVariables(string $content): void
    {
        $extractedVariables = [];
        $extractedFunctions = [];
        $variables = [];

        preg_match_all(
            '/'.self::OPEN_TAG.'\w[^}\s]*'.self::CLOSE_TAG.'/',
            $content,
            $extractedVariables
        );

        foreach ($extractedVariables[0] as $variable) {
            $variables[] = preg_split(
                self::OPEN_TAG.'|\||'.self::CLOSE_TAG,
                $variable,
                -1,
                PREG_SPLIT_NO_EMPTY
            );
        }

        $this->variables = array_unique(array_map(fn($var) => $var[0], $variables));

        $this->modifiers = array_unique(array_map(fn($var) => $var[1] ?? null, $variables));

        preg_match_all(
            '/'.self::OPEN_TAG.'@\w[^}\s]*'.self::CLOSE_TAG.'/',
            $content,
            $extractedFunctions
        );

        $this->functions = array_unique(
            array_map(fn($var) => $var[0], array_filter($extractedFunctions)
            )
        );
    }

    /**
     * @param $variable
     * @param $modifier
     *
     * @return string
     */
    private function convertVariableToTemplateFormat($variable, $modifier)
    {
        if ($modifier) {
            return self::OPEN_TAG.$variable.'|'.$modifier.self::CLOSE_TAG;
        }

        return self::OPEN_TAG.$variable.self::CLOSE_TAG;
    }

    /**
     * @param $variable
     * @param $format
     *
     * @return string
     */
    private function getFormattedValue($variable, $format)
    {
        switch ($format) {
            case 'cammel':
                return Str::camel($variable);
            case 'kebab':
                return Str::kebab($variable);
            case 'lower':
                return strtolower($variable);
            case 'plural':
                return Str::plural($variable);
            case 'singular':
                return Str::singular($variable);
            case 'snake':
                return Str::snake($variable);
            case 'studly':
                return Str::studly($variable);
            case 'upper':
                return strtoupper($variable);
            case 'toArray':
                return "['".implode("', '", explode(',', $variable))."']";
            default:
                return $variable;
        }
    }

    private function getFunctionValue($function)
    {
        switch ($function) {
            case 'migrationTimeFormat':
                return now()->format('Y_m_d_His');
            default:
                throw new \InvalidArgumentException("Function $function does not exists.");
        }
    }
}
