<?php
/**
 * Created by PhpStorm.
 * User: SupGL
 * Date: 2016/5/5
 * Time: 15:38
 */
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller{
    /*删除*/
    protected function return_delete_result($con){
        if($con)
            return '删除成功！';
        else
            return '删除失败！';
    }
    /*删除*/
    protected function return_save_result($con,$success='保存成功！',$error='保存失败！'){
        if($con)
            return $this->ajaxReturn(array('status'=>true,'msg'=>$success));
        else
            return $this->ajaxReturn(array('status'=>false,'msg'=>$error));
    }
}