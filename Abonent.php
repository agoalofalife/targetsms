<?php
namespace agoalofalife\targetsms;

class Abonent
{

    private $phone;
    private $number_sms;
    private $client_id_sms;
    private $time_send;
    private $validity_period;

    /**
     * Создание адресата.
     *
     * @param string $phone телефон в международно формате (например 79201112233)
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Установить номер сообщения в пределах отправляемого XML документа.
     *
     * @param int $number_sms номер сообщения в пределах отправляемого XML документа
     */
    public function setNumberSms($number_sms)
    {
        $this->number_sms = $number_sms;
    }

    /**
     * Функция получения номера сообщения.
     *
     * @return int номер сообщения
     */
    public function getNumberSms()
    {
        return (int) $this->number_sms;
    }

    /**
     * Установить уникальный id смс
     *
     * @param int $client_id_sms если SMS с таким номером было отправлено, то повторная отправка не производится, а возвращается номер ранее  отправленного SMS
     */
    public function setClientIdSms($client_id_sms)
    {
        $this->client_id_sms = (int) $client_id_sms;
    }

    /**
     * Функция получения id sms.
     *
     * @return int
     */
    public function getClientIdSms()
    {
        return (int) $this->client_id_sms;
    }

    /**
     * Установить дату и время отправки в формате: YYYY-MM-DD hh:mm.
     *
     * @param type $time_send lата и время отправки в формате: YYYY-MM-DD hh:mm
     */
    public function setTimeSend($time_send)
    {
        $this->time_send = $time_send;
    }

    /**
     * Получить дату и время отправки в формате: YYYY-MM-DD hh:mm.
     *
     * @return string
     */
    public function getTimeSend()
    {
        return $this->time_send;
    }

    /**
     * дата и время, после которых не будут делаться попытки доставить SMS в формате:  YYYY-MM-DD hh:mm.
     *
     * @param string $validity_period
     */
    public function setValidityPeriod($validity_period)
    {
        $this->validity_period = $validity_period;
    }

    /**
     * Получение дата и времени после которых не будут делаться попытки доставить.
     *
     * @return string
     */
    public function getValidityPeriod()
    {
        return $this->validity_period;
    }

    /**
     * Вернуть номер абонента.
     *
     * @return string номер абонента
     */
    public function getPhone()
    {
        return $this->phone;
    }
}