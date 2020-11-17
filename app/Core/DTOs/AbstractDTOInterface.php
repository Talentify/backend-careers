<?php


namespace Core\DTOs;


interface AbstractDTOInterface
{
    /**
     * O metodo não foi implementado na classe abstrata para evitar problemas
     * na implementação, pois o mesmo não serve para todos os casos, assim
     * a responsabilidade do uso fica pelo criador
     *
     * @return array
     */
    public function toModelArray(): array;
}
