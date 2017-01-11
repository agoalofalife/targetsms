<?php
namespace  agoalofalife\targetsms\Contract;

/**
 * Interface ISendSms
 * Интерфейс отправки смс
 * @package App\Contract
 */
interface ISendSms
{
    public function sendSMS($dataArray);
}