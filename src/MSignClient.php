<?php
/***
 * sign验证类
 */

namespace JoyRiddle\MSign;

use Carbon\Carbon;
use JoyRiddle\MSign\Exceptions\MSignException;
use JoyRiddle\MSign\MSign;

class MSignClient extends  MSign
{


    /***
     * 生成sign
     */
    public function getSign()
    {
        $data = $this->data->except('sign');
        is_array($data)?'':$data=$data->toArray();
        ksort($data);
        return md5($this->secret . urlencode(http_build_query($data)) . $this->secret);
    }

    /**注入数据
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
        $this->setClientSecretKey();
        $this->setClientSecret();
    }

    /**设置密钥
     * @throws MSignException
     */

    public function setSecret()
    {
        $this->secret = $this->getSecret();
    }


    /**加密
     * @param $data
     * @return mixed
     */
    public function encrypt($data)
    {
        $data = collect($data);
        $this->setData($data);
        $this->getData();
        return $this->data;


    }

    /**加密生成url请求参数
     * @param $data
     * @return string
     */
    public function encryptToUrl($data)
    {
        $data = collect($data);
        $this->setData($data);
        $this->getData();
        return http_build_query($this->data);
    }

    /**获取加密数据
     * @return mixed
     */
    function getData()
    {
        $this->data['time'] = time();
        $this->data['sign']=$this->getSign();
        return $this->data;
    }

    /**
     * 客户端密钥
     */
    function setClientSecretKey()
    {
        $this->platform_key=$this->data['platform_key'] = config('msign.uc_platform_key');
    }

    /**
     * 客户端密钥
     */
    function setClientSecret()
    {
        $this->secret = config('msign.uc_platform_secret');
    }


}
