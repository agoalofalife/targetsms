<?php
namespace agoalofalife\targetsms\Wrappers;

use agoalofalife\targetsms\Balance;
use agoalofalife\targetsms\Contract\IGetBalance;

class WrapperBalance extends Wrapper implements IGetBalance
{
    public function getBalance()
    {
        $state = new Balance( $this->login , $this->password);
        $state->setUrl($this->url);

        if (!$state->send()) {
            echo $state->getError();
        } else {
            return $state->getResponse();
        }
    }
}
