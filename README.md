
![](http://i12.pixs.ru/storage/6/3/8/smsjpg_6768148_24760638.jpg)

## **What it is?**

Is a library for the use of sending SMS with the service [TargetSms](http://targetsms.ru)


This package is **framework-dependent!**

It is used in the environment **[Laravel](https://laravel.com/)**



### **How to start using?**

You must add the service provider in file **config/app.php**


```
agoalofalife\targetsms\Providers\TargetSmsProvider::class
```

and execute the command in the console

```
php artisan vendor:publish

```
Then in the folder ** /config** you will see file **targetSMS.php**

You will need to add your settings

```
return [
'login' => '',
'password' => '',
'url' => 'https://sms.targetsms.ru', //most likely
'sender' => '' //how to sign SMS messages
];
```

Examples you can see in the folder **Example**
