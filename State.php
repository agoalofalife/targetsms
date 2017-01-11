<?php
namespace agoalofalife\targetsms;
use agoalofalife\targetsms\Contract\Factory;

/**
 * Получение статуса сообщения/сообщений.
 */
class State extends Request implements Factory
{
    /**
     * Функция для добавления id сообщения.
     *
     * @param int $id_sms id сообщения
     */
    public function addIdSms($id_sms)
    {
        $this->item[] = (int) $id_sms;
    }

    /**
     * Функция для формирования url.
     *
     * @return string
     */
    protected function getUrl()
    {
        return (string) "{$this->url}/xml/state.php";
    }

    /**
     * @param $xml
     * @return array|void
     */
    protected function parseXml($xml)
    {
        $domXml = simplexml_load_string($xml);
        $arr = array();
        if (isset($domXml->error)) {
            $this->error = (string) $domXml->error;

            return;
        } else {
            $i = 0;
            foreach ($domXml->state as $val) {
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
        $domState = $request->appendChild($domtree->createElement('get_state'));

        foreach ($this->item as $id) {
            $domState->appendChild($domtree->createElement('id_sms', $id));
        }

        return $domtree->saveXML();
    }
}