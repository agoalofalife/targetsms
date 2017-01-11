<?php
namespace  agoalofalife\targetsms\Contract;

interface factoryMessages
{
    /**
     * Добавить номер абонента.
     *
     * @param string $phone номер телефона в международном формате (79201112233)
     */
    public function createAbonent($phone);
}