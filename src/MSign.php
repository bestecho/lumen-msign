<?php
/***
 * sign验证类
 */

namespace JoyRiddle\MSign;

use Carbon\Carbon;
use JoyRiddle\MSign\Models\Platform;
use JoyRiddle\MSign\Exceptions\MSignException;

class MSign
{

    public function __contract()
    {
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


}
