<?php
/**
 * Created by PhpStorm.
 * User: SupGL
 * Date: 2016/5/6
 * Time: 9:50
 */
namespace Admin\Controller;
use Think\Controller;

class WechatController extends Controller{
    public function auth(){
        $wechat = new  \Vendor\Wechat\Wechat(C('WECHAT_TOKEN'), TRUE);
        //首次使用需要注视掉下面这1行（26行），并打开最后一行（29行）
        echo $wechat->run();
        //首次使用需要打开下面这一行（29行），并且注释掉上面1行（26行）。本行用来验证URL
        // $wechat->checkSignature();
    }
}