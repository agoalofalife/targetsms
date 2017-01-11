<?php
namespace agoalofalife\targetsms;
use agoalofalife\targetsms\Contract\factoryMessages;

class Message implements factoryMessages
{
    private $type;
    private $sender;
    private $text;
    public $abonents = array();

    /**
     * @param string $sender
     * @param string $text
     * @param string $type
     */
    public function __construct($sender, $text, $type = 'sms')
    {
        $this->type = $type;
        $this->sender = $sender;
        $this->text = $text;
    }

    /**
     * Добавить номер абонента.
     * @param string $phone номер телефона в международном формате (79201112233)
     * @return Abonent
     */
    public function createAbonent($phone)
    {
        return (object) new Abonent($phone);
    }

    /**
     * Добавить абонента.
     *
     * @param object $obj сформированный объект
     */
    public function addAbonent($obj)
    {
        $this->abonents[] = (object) $obj;
    }

    /**
     * Получить тип сообщения.
     *
     * @return string тип сообщения
     */
    public function getType()
    {
        return htmlspecialchars($this->type, ENT_XML1);
    }

    /**
     * Получить отправителя.
     *
     * @return string отправитель
     */
    public function getSender()
    {
        return htmlspecialchars($this->sender, ENT_XML1);
    }

    /**
     * Получить Текст сообщения.
     *
     * @return string текст сообщения
     */
    public function getText()
    {
        return htmlspecialchars($this->text, ENT_XML1);
    }
}