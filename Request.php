<?php

namespace agoalofalife\targetsms;

abstract class Request
{
    public $login;
    public $password;
    public $url;
    public $error;
    public $response;
    public $item = array();

    /**
     * Создание подключения.
     *
     * @param string $login    логин в системе
     * @param string $password пароль в системе
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Получить подробный ответ
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Получить сообщение ошибки.
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Установить значение url.
     *
     * @param string $url url например https://my5.t-sms.ru/
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Отправка xml на сервер
     * @return array
     */
    public function send()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CRLF, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->generateXml());
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        $result = curl_exec($ch);
        curl_close($ch);
        $this->response = $this->parseXml($result);

        return  $this->parseXml($result);
    }
}