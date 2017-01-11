<?php
namespace agoalofalife\targetsms\Wrappers;
use agoalofalife\targetSms\Config;

class Wrapper
{
    protected $login;
    protected $password;
    protected $url;

    public function __construct()
    {
        $this->login           = config('targetSMS.login');
        $this->password        = config('targetSMS.password');
        $this->url             = config('targetSMS.url');
    }
}