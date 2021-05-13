<?php
/***
 * sign验证类
 */

namespace JoyRiddle\MSign;

use Carbon\Carbon;
use JoyRiddle\MSign\Models\Platform;
use JoyRiddle\MSign\Exceptions\MSignException;

use JoyRiddle\MSign\MSign;

class MSignServer extends  MSign
{


    /**获取密钥
     * @return mixed
     */
    public function getSecret()
    {
        $platform = Platform::where('platform_key', $this->platform_key)->first();
        if (!$platform) {
            throw new MSignException('平台不存在', 401);
        }
        return $platform->platform_secret;
    }

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

    public function setData($data)
    {
        $this->data = $data;

        $this->setPlatform();
        $this->setSecret();

    }

    public function setSecret()
    {
        $this->secret = $this->getSecret();
    }

    public function setPlatform()
    {
        $this->platform_key= $this->data->platform_key;
    }

    /**时间验证
     * @throws MSignException
     */
    public function checkParam($request)
    {
        if (!$request->time || !$request->sign || !$request->platform_key) {
            throw new MSignException('参数缺失', 401);
        }

        $this->checkTime($request);
    }

    /**时间验证
     * @throws MSignException
     */
    public function checkTime($response)
    {
        $diffMinutes = Carbon::parse(date("Y-m-d H:i:s", $response->time))->diffInMinutes();
        if ($diffMinutes > 10) {
            throw new MSignException('sign过期', 401);
        }
    }

    /**
     * 验证
     */
    public function validate()
    {
        if ($this->data->sign != $this->getSign()) {
            throw new MSignException('sign验证失败', 401);
        }

    }

    /***验证
     * @param $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $this->checkParam($request);
        $this->setData($request);
        $this->validate();
    }

}
