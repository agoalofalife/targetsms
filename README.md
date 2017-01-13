

![](https://s02d.storage.yandex.net/rdisk/f8c49bda60317aef95f576617915b0e0029e7ae48ea9ab5353853043ab86a5b8/5878a563/rWjvywuL93VvzaqBECRpgvJIicB5KTm_Y0KWe2XcatNmKzuf2n8Sk6ZqElT5EUg4HxCEvrBb3hBq5VJUXx3zug==?uid=0&filename=sms.jpg&disposition=inline&hash=&limit=0&content_type=image%2Fjpeg&fsize=1188232&hid=9257d346b19661990328c8126c428edd&media_type=image&tknv=v2&etag=1ed7ff1434c2d2ab5add244943f4dbfc&rtoken=6lCpoXr2RvYR&force_default=no&ycrid=na-c2b188c3ca0263342a593c817ea6e412-downloader10d&ts=545f6e999dec0&s=d825cb9202295e9e03b996b7268cd5d3e076591d788e962f6f5940e2580857fc&bp=/41/3/data-0.17:50651222804:1188232&pb=U2FsdGVkX19OeOjSjj_FdNW6O3wTEG1m6mQlZrjXhHD-tnscucO4LPVKAC_xkfbU8zAhpknK09hSKTv6S2fp2tNLCS9k6gYMj_RgDW-LlPY=)

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
