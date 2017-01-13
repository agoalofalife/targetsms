
![](https://3.downloader.disk.yandex.ru/disk/e3b1d96801018f8d01ae9330f441ff69756e088b0e381ddee147954e16640c78/5878a5c5/rWjvywuL93VvzaqBECRpgrTOzbi4rhhOay5zAz2NA9RXPjMw7UnoAMi7Ej77gFDnhwZga_8DJPVUo-KFQnIJ8w%3D%3D?uid=0&filename=sms_1000x500.jpg&disposition=inline&hash=&limit=0&content_type=image%2Fjpeg&fsize=58403&hid=b93cacb10a294b98bede6178698d2a31&media_type=image&tknv=v2&etag=1048e681aa19addcf597d27a3730f6e0)

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
