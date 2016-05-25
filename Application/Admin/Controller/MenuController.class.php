<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends Controller {
    protected $memu_model;
    function _initialize(){
        $this->memu_model = M('Menu');
    }
    public function index(){

        $this->display();
    }

    public function data_list(){
        $limit= I('limit',0);
        $offset = I('offset',0);
        $sort = I('sort','m_id');
        $order = I('order','DESC');
        $list = $this->memu_model->limit($limit,$offset)->order($sort.' '.$order)->select();
        $count = $this->memu_model->count();
        $result['rows']=$list;
        $result['total']=$count;
        return $this->ajaxReturn($result);
    }
}