<?php
declare(strict_types=1);

namespace Modules\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    /**
     * 接口成功响应
     *
     * @param array $data 响应的业务数据
     * @param string $msg 提示信息
     * @return array
     * @author skyer.zht <405661806@qq.com>
     * @since 2020-09-01 15:05:40 To 2020-09-01 15:05:40
     */
    public function apiSuccess($data=[], $msg="success")
    {
        $return = [
            "data"=> $data,
            "code"=> 200,
            "msg"=> $msg
        ];
        return $this->response->setJsonContent($return);
    }

    /**
     * 接口失败响应 
     * 有些程序和系统异常是不能暴露给客户端，可能因为泄露信息导致服务器被攻击。 
     * 这里正式环境对外统一报错，对内日志记录分析。非pro环境完全暴露错误信息
     *
     * @param string $msg 提示信息
     * @param integer $code 错误状态码
     * @param array $data 包含了错误文件以及行数。非pro环境完全暴露错误信息
     * @return void
     * @author skyer.zht <405661806@qq.com>
     * @since 2020-09-01 15:19:31 To 2020-10-12 10:36:31
     */
    public function apiFail($msg="fail", $code=0, $data=[])
    {    
        # 进行日志记录
        // $this->di('logger')->log("apiFail", 'msg: '.$msg.PHP_EOL.json_encode($data).PHP_EOL);
        $return = [
            "data"=> APP_ENV === "pro" ? [] : $data,
            "code"=> $code,
            "msg"=> $msg
        ];
        return $this->response->setJsonContent($return);
    } 
}
