# Laravel 3DES

Laravel 3DES加密解密，和java,ios互通，使用openssl，必须有openssl扩展

### 安装方法 ###

```php
composer require bestecho/lumen-msign
```

### 配置方法 ###

配置加密key和iv,如下。也可动态使用key和iv

```php
config文件夹下创建msign.php

内容
<?php


return [
   //key
    'uc_platform_key' => env('UC_PLATFORM_KEY', 'sfgsdfafasf'),
    //密钥
    'uc_platform_secret' => env('UC_PLATFORM_SECRET', '12312312312'),

];
```
### app.php注册provider ###

$app->register(JoyRiddle\MSign\Providers\MSignProvider::class);

### 使用方法 ###


```php
<?php

namespace App\Http\Controllers;
use JoyRiddle\MSign\Facades\MSignClient;//客户端加密
use JoyRiddle\MSign\Facades\MSign;//服务端解密
class IndexController extends Controller
{
    public function index()
    {
        // 加密
        $encrypt = MSignClient::encrypt(['data']);
    

        // 解密
        $decrypt = MSign::check($encrypt);
    }
}

```

