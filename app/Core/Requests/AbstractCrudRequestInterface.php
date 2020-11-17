<?php


namespace Core\Requests;


use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModelInterface;

interface AbstractCrudRequestInterface
{
    /**
     * Metodo criado porque PHP não oferece suporte à Generics
     * @return AbstractDTOInterface
     */
    public function getDTO(): AbstractDTOInterface;

    public function getModel(): AbstractModelInterface;

    public function validateID($id);

    public function validateToDTO(): AbstractDTOInterface;

    public function getGetOneRules(): array;

    public function getSaveOneRules(): array;

    public function getUpdateOneRules(): array;

    public function getDeleteOneRules(): array;
}
