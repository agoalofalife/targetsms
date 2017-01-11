<?php
namespace agoalofalife\targetsms\Wrappers;
use agoalofalife\targetSms\Contract\IGetStatus;
use agoalofalife\targetSms\State;

class WrapperGetSmsStatus extends Wrapper implements IGetStatus
{
    /**
     * @param $arrayData
     */
    public function getStatus($arrayData)
    {
        $state = new State( $this->login, $this->password );

        $state->setUrl( $this->url );
        foreach ($arrayData as $item)
        {
            $state->addIdSms($item);
        }

        if (!$state->send()) {
            echo $state->getError();
        } else {
            print_r($state->getResponse());
        }
    }
}