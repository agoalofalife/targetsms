<?php
namespace agoalofalife\targetsms;
use agoalofalife\targetsms\Contract\Factory;


/**
 * Получение входящих SMS
 */
class Incoming extends Request implements Factory
{
    /**
     * Функция для формирования url.
     *
     * @return string
     */
    protected function getUrl()
    {
        return (string) "{$this->url}/xml/incoming.php";
    }

    /**
     * Функция для установки периода с которого запрашиваются входящие SMS.
     *
     * @param string $start время (не включительно), с которого запрашиваются входящие SMS в формате YYYY-MM-DD hh:mm:ss
     * @param string $end   время (не включительно), по которое запрашиваются входящие SMS в формате YYYY-MM-DD hh:mm:ss
     */
    public function setTime($start, $end = null)
    {
        $this->item['start'] = $start;
        $this->item['end'] = $end;
    }

    protected  function parseXml($xml)
    {
        $domXml = simplexml_load_string($xml);
        $arr = array();
        if (isset($domXml->error)) {
            $this->error = (string) $domXml->error;

            return;
        } else {
            $i = 0;
            foreach ($domXml->sms as $val) {
                $arr['sms'][$i]['value'] = (string) $val;
                foreach ($val->attributes() as $attrName => $attrValue) {
                    $arr['sms'][$i][$attrName] = (string) $attrValue;
                }
                ++$i;
            }
            $j = 0;
            foreach ($domXml->money as $val) {
                $arr['money'][$j]['value'] = (string) $val;
                foreach ($val->attributes() as $attrName => $attrValue) {
                    $arr['money'][$j][$attrName] = (string) $attrValue;
                }
                ++$j;
            }

            return $arr;
        }
    }

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

        //создание дерева временем
        $domTime = $request->appendChild($domtree->createElement('time'));
        $domTime->setAttribute('start', $this->item['start']);
        if (!empty($this->item['end'])) {
            $domTime->setAttribute('end', $this->item['end']);
        }

        return $domtree->saveXML();
    }
}