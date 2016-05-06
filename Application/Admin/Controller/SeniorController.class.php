<?php
/**
 * Created by PhpStorm.
 * User: SupGL
 * Date: 2016/5/6
 * Time: 10:36
 */
namespace Admin\Controller;

use Vendor\Wechat\Menu;

class SeniorController extends BaseController{
    protected $menu;
    function _initialize(){
        $this->menu = D('Menu');
    }

    public function menu_index(){
        print_r(Menu::getMenu());
        $this->display('menu_index');
    }
    public function menu_add(){
        $menu = $this->menu->field('m_id,m_name')->where(array('m_pid'=>0))->select();
        $type = array(
            0=>array('key'=>'click','value'=>'点击推事件'),
            1=>array('key'=>'view','value'=>'跳转URL'),
            2=>array('key'=>'scancode_push','value'=>'扫码推事件'),
            3=>array('key'=>'scancode_waitmsg','value'=>'扫码推事件且弹出“消息接收中”提示框'),
            4=>array('key'=>'pic_sysphoto','value'=>'弹出系统拍照发图'),
            5=>array('key'=>'pic_photo_or_album','value'=>'弹出拍照或者相册发图'),
            6=>array('key'=>'pic_weixin','value'=>'弹出微信相册发图器'),
            7=>array('key'=>'location_select','value'=>'弹出地理位置选择器'),
            8=>array('key'=>'media_id','value'=>'下发消息（除文本消息）'),
            9=>array('key'=>'view_limited','value'=>'跳转图文消息URL')
        );
        $id = I('id',0);
        if($id){
            $row = $this->menu->where(array('m_id'=>$id))->find();
            $this->assign('info',$row);
        }
        if(IS_POST){
            if (!$this->menu->create()){
                return $this->ajaxReturn(array('status'=>false,'msg'=>$this->menu->getError()));
            }else{
                $rel = $this->menu->add();
            }
            $this->return_save_result($rel);
        }
        $this->assign('menu',$menu);
        $this->assign('type',$type);
        $this->display('menu_add');
    }
    public function menu_list(){
        $start = I('start');
        $limit = I('length');
        $icolumn = I('columns');
        $sort_num = I('iSortCol_0','');
        $sort = I('mDataProp_'.$sort_num,'m_pid');
        $dir = I('sSortDir_0','ASC');
        $order=array($sort=>$dir);
        $isearch = I('sSearch','');
        $isearch?$where="`m_name` like '%$isearch%'":$where='';
        $list=$this->menu->where($where)->limit($start,$limit)->order($order)->select();
        $num =$this->menu->where($where)->count();
        foreach ($list as &$l) {
            if($l['m_pid']){
                $row = $this->menu->field('m_name')->where(array('m_id'=>$l['m_pid']))->find();
                $l['m_pname'] = $row['m_name'];
            }else{
                $l['m_pname'] = '一级菜单';
            }
        }

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
            $rel = $this->menu->delete($id);
        else
            return $this->ajaxReturn(array('status'=>false,'msg'=>'没有数据！'));
        $this->return_save_result($rel,'删除成功！','删除失败！');
    }

    public function menu_to_weixin(){
        $mid = trim(I('mid',0),',');
        if($mid){
            $map['m_id'] = array('in',$mid);
            $this->menu->where($map)->save(array('m_state'=>2));
            $list = $this->menu->where("m_id in($mid)")->select();
            foreach ($list as &$r) {
                $a['id']=$r['m_id'];
                $a['pid']=$r['m_pid'];
                $a['name']=$r['m_name'];
                $a['type']=$r['m_type'];
                $a['code']=$r['m_attr'];
                $newarr[]=$a;
            }
            $rel = Menu::setMenu($newarr);
            if($rel===true){
                return $this->ajaxReturn(array('status'=>true,'msg'=>'上传菜单成功！'));
            }else{
                return $this->ajaxReturn(array('status'=>false,'msg'=>$rel['errmsg']));
            }
        }else{
            return $this->ajaxReturn(array('status'=>false,'msg'=>'没有选择菜单！'));
        }
    }
    public function weixin_menu_delete(){
        Menu::delMenu();
        $this->menu->save(array('m_state'=>2));
        return $this->ajaxReturn(array('status'=>true,'msg'=>'微信菜单删除成功！'));
    }
}