<?php
declare(strict_types=1);

namespace App\Core\Contracts;

interface CollectionContract
{
    public function add($obj, string $key = null);
    public function delete($key);
    public function get($key);
}