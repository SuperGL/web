<?php
namespace Admin\Controller;
use Think\Controller;

class BasicController extends Controller {

    function _initraze(){
        $this->textresponse = D('Textresponse');
    }


    public function text_response(){

        $this->display('text_response');
    }
    public function text_response_add(){
        if(IS_POST){
            print_r($this->textresponse->select());die();
            if (!$this->textresponse->create()){ 
                die($this->textresponse->getError());
                return $this->ajaxReturn(array('status'=>false,'msg'=>$this->textresponse->getError()));
             }else{   
                $this->textresponse->add();
            }
            return $this->ajaxReturn(array('status'=>true,'msg'=>'sss'));
        }
        $this->display('text_response_add');
    }

    public function text_response_list(){
        $start = I('start');
        $limit = I('length');
        $iorder = I('order');
        $icolumn = I('columns');
        $sort_num = I('iSortCol_0','');
        $sort = I('mDataProp_'.$sort_num,'t_id');
        $dir = I('sSortDir_0','DESC');
        $db=M('textresponse');
        $order=array($sort=>$dir);
        $isearch = I('search');
        $isearch['value']?$where="`t_title` like '%$isearch[value]%'":$where='';
        $list=$db->where($where)->limit($start,$limit)->order($order)->select();
        $num =$db->where($where)->count();
        $data = array(
            'iTotalRecords' => $num,
            'iTotalDisplayRecords' => $num,
            'aaData' => $list
        );
        echo json_encode($data);
    }
}