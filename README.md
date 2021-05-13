# lumen 加密解密

lumen加密解密

### 安装方法 ###

```php
composer require bestecho/lumen-msign
```

### 配置方法 ###

配置加密key和密钥,如下。

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

