<?php
namespace agoalofalife\targetsms\Wrappers;


use agoalofalife\targetsms\Contract\ISendSms;
use agoalofalife\targetsms\Messages;

/**
 * Class WrapperSendSms
 * Обертка для отправки смс
 * @package agoalofalife\targetSms\Wrappers
 */
class WrapperSendSms extends Wrapper implements ISendSms
{
    const TYPE = 'sms';

    # Конфигурационные данные для отправки смс
    protected $senderName;

    public function __construct()
    {
        parent::__construct();
        $this->senderName      = config('targetSMS.sender');
    }
    
    /**
     * @param string $senderName
     */
    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
    }
    
    /**
     * Отправка смс
     * @param array $dataArray
     * @return array|string
     */
    public function sendSMS($dataArray = [])
    {
        $this->checkOnVaidateParameters($dataArray);

            $messages =  new Messages( $this->login , $this->password);
            $messages->setUrl( $this->url );

            $mes     = $messages->createNewMessage($this->senderName , $dataArray['messages'], WrapperSendSms::TYPE);

        for ( $counter = 0; $counter + 1 < count( $dataArray ); $counter++ )
        {
            $abonent = $mes->createAbonent( $dataArray[$counter]['phone'] );
            $abonent->setNumberSms($counter + 1);
            $mes->addAbonent($abonent);

           if (  isset($dataArray[$counter]['TimeSend']) )
           {
               $abonent->setClientIdSms($dataArray[$counter]['TimeSend']);
           }

            if (  isset($dataArray[$counter]['ValidityPeriod']) )
            {
                $abonent->setValidityPeriod($dataArray[$counter]['ValidityPeriod']);
            }
            $messages->addMessage($mes);
        }

        if ( !$messages->send() ) {
            return $messages->getError();
        } else {
            return $messages->getResponse();
        }
    }


    /**
     * Проверка массива на валидность
     * @param $dataArray
     */
    private function checkOnVaidateParameters($dataArray)
    {
        if ( !count($dataArray) )
        {
            $this->errorParameter('empty array');
        }

        if( !isset($dataArray['messages']) ) {
            $this->errorParameter('messages');
        }

        for ( $counter = 0; $counter + 1 < count($dataArray); $counter++)
        {
            if ( !$this->isPhone($dataArray[$counter]['phone']) )
            {
                $this->errorParameter('phone error');
            }

            if ( isset($dataArray[$counter]['uniqIdSMS']) ) {
                if ( !is_integer($dataArray[$counter]['uniqIdSMS']) )
                {
                    $this->errorParameter('uniqIdSMS expected integer');
                }
            }

            if ( isset($dataArray[$counter]['TimeSend']) ) {
                if ( !$this->isTime($dataArray[$counter]['TimeSend']) )
                {
                    $this->errorParameter('TimeSend error');
                }
            }

            if ( isset($dataArray[$counter]['ValidityPeriod']) )
            {
                if ( !$this->isTime($dataArray[$counter]['ValidityPeriod']) )
                {
                    $this->errorParameter('ValidityPeriod error');
                }
            }

        }
    }


    /**
     * Проверка на валидность номер телефона
     * @param $phone
     * @return int
     */
    private function isPhone($phone)
    {
        return preg_match('/^7|8[0-9]{10}/', $phone);
    }

    /**
     * / Проверка параматра времени
     * @param $data
     * @return int
     */
    private function isTime($data)
    {
        return preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}/', $data);
    }


    /**
     * Ошибка параметров
     * @throws \Exception
     */
    private function errorParameter($message)
    {
        throw new \Exception('Проверьте вводимые параметры : '.$message);
    }
}
