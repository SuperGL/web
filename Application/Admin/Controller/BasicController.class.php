<?php
namespace Admin\Controller;
use Admin\Model\TextresponseModel;
use Think\Controller;

class BasicController extends BaseController {
    protected $textresponse;
    function _initialize(){
        $this->textresponse = D('Textresponse');
    }




    public function text_response(){

        $this->display('text_response');
    }
    public function text_response_add(){
        $id = I('id',0);
        if($id){
            $row = $this->textresponse->where(array('t_id'=>$id))->find();
            $this->assign('info',$row);
        }
        if(IS_POST){
            if (!$this->textresponse->create()){
                return $this->ajaxReturn(array('status'=>false,'msg'=>$this->textresponse->getError()));
             }else{
                if($_POST['t_id']){
                    $rel = $this->textresponse->save();
                }else{
                    $rel = $this->textresponse->add();
                }
            }
            $this->return_save_result($rel);
        }
        $this->display('text_response_add');
    }

    public function text_response_list(){
        $start = I('start');
        $limit = I('length');
        $icolumn = I('columns');
        $sort_num = I('iSortCol_0','');
        $sort = I('mDataProp_'.$sort_num,'t_id');
        $dir = I('sSortDir_0','DESC');
        $order=array($sort=>$dir);
        $isearch = I('sSearch','');
        $isearch?$where="`t_keyword` like '%$isearch%'":$where='';
        $list=$this->textresponse->where($where)->limit($start,$limit)->order($order)->select();
        $num =$this->textresponse->where($where)->count();
        $data = array(
            'iTotalRecords' => $num,
            'iTotalDisplayRecords' => $num,
            'aaData' => $list
        );
        echo json_encode($data);
    }

    public function deletedata(){
        $id = I('did',0);
        if($id)
            $rel = $this->textresponse->delete($id);
        else
            return $this->ajaxReturn(array('status'=>false,'msg'=>'没有数据！'));
        $this->return_save_result($rel,'删除成功！','删除失败！');
    }

    /*系统回复*/
    public function sys_response_index(){
        $sysmodel = M('Sysresponse');
        if(IS_POST){
            if (!$sysmodel->create()){
                return $this->ajaxReturn(array('status'=>false,'msg'=>$this->textresponse->getError()));
            }else{
                if($_POST['s_id']){
                    $rel = $sysmodel->save();
                }else{
                    $rel = $sysmodel->add();
                }
            }
            $this->return_save_result($rel);
        }
        $info = $sysmodel->where('s_id=1')->find();
        $this->assign('info',$info);
        $this->display('sys_response_index');
    }
}