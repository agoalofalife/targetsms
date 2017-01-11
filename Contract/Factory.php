<?php
namespace  agoalofalife\targetsms\Contract;
/**
 * Фабрика.
 */
interface Factory
{
    public function send();
    public function setUrl($url);
    public function getError();
}