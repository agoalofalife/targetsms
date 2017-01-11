<?php
namespace agoalofalife\targetsms;
use agoalofalife\targetsms\Contract\Factory;


/**
 * Создание сообщения.
 */
class Messages extends Request implements Factory
{
    /**
     * Создаем новое сообщение.
     *
     * @param string $sender отправитель SMS. Именно это значение будет выводиться на телефоне абонента в поле от кого SMS
     * @param string $text   текст обычного SMS или описание WAP ссылки
     * @param string $type   тип отправляемого SMS сообщения
     *
     * @return Message
     */
    public function createNewMessage($sender, $text, $type = 'sms')
    {
        return new Message($sender, $text, $type);
    }

    /**
     * Функция для добавления сообщения.
     *
     * @param object $obj объект сообщение
     */
    public function addMessage($obj)
    {
        $this->item[] = (object) $obj;
    }

    /**
     * Функция для формирования url.
     *
     * @return string
     */
    protected function getUrl()
    {
        return (string) "{$this->url}/xml/";
    }

    /**
     * @param $xml
     * @return array|void
     */
    protected  function parseXml($xml)
    {
        $domXml = simplexml_load_string($xml);
        $arr    = array();

        if (isset($domXml->error)) {
            $this->error = (string) $domXml->error;

            return;
        } else {
            $i = 0;
            foreach ($domXml->information as $val) {
                $arr[$i]['value'] = (string) $val;
                foreach ($val->attributes() as $attrName => $attrValue) {
                    $arr[$i][$attrName] = (string) $attrValue;
                }
                ++$i;
            }

            return $arr;
        }
    }

    /**
     * @return string
     */
    protected function generateXml()
    {
        $domtree = new \DOMDocument('1.0', 'utf-8');
        $request = $domtree->appendChild($domtree->createElement('request'));

        //создание дерева security
        $security = $request->appendChild($domtree->createElement('security'));

        $domLogin = $domtree->createElement('login');
        $newDomLogin = $security->appendChild($domLogin);
        $newDomLogin->setAttribute('value', $this->login);

        $domPassword = $domtree->createElement('password');
        $newDomPassword = $security->appendChild($domPassword);
        $newDomPassword->setAttribute('value', $this->password);

        //создание дерева с сообщениями
        foreach ($this->item as $item) {
            $domMessage = $request->appendChild($domtree->createElement('message'));
            $domMessage->appendChild($domtree->createElement('sender', $item->getSender()));
            $domMessage->appendChild($domtree->createElement('text', $item->getText()));

            foreach ($item->abonents as $abonent) {
                $domAbonent = $domMessage->appendChild($domtree->createElement('abonent'));
                $domAbonent->setAttribute('phone', $abonent->getPhone());

                if ($abonent->getNumberSms()) {
                    $domAbonent->setAttribute('number_sms', $abonent->getNumberSms());
                }

                if ($abonent->getClientIdSms()) {
                    $domAbonent->setAttribute('client_id_sms', $abonent->getClientIdSms());
                }

                if ($abonent->getTimeSend()) {
                    $domAbonent->setAttribute('time_send', $abonent->getTimeSend());
                }

                if ($abonent->getValidityPeriod()) {
                    $domAbonent->setAttribute('validity_period', $abonent->getValidityPeriod());
                }
            }

            //добавление атрибута к message
            $domMessage->setAttribute('type', $item->getType());
        }

        return $domtree->saveXML();
    }
}