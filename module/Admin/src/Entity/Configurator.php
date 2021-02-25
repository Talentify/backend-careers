<?php

namespace Admin\Entity;

class Configurator
{
    public static function configure($target, $options, $tryCall = false)
    {
        if (!is_object($target)) {
            throw new \Exception('Target should be an object');
        }
        if (!($options instanceof Traversable) && !is_array($options)) {
            throw new \Exception('$options should implement Traversable');
        }

        $tryCall = (bool)$tryCall && method_exists($target, '__call');

        foreach ($options as $name => &$value) {
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));

            if ($tryCall || method_exists($target, $setter)) {
                call_user_func(array($target, $setter), $value);
            } else {
                continue; // instead of throwing an exception
            }
        }
        return $target;
    }

}