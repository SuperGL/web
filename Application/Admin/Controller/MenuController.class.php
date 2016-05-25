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
        $limit['limit'] = I('limit',0);
        $limit['offset'] = I('offset',0);
        $list = $this->memu_model->field('m_name')->limit($limit)->select();
        $count = $this->memu_model->count();
        $result['rows']=$list;
        $result['total']=$count;
        return $this->ajaxReturn($result);
    }
}