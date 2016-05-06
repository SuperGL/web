<?php
/**
 * Created by PhpStorm.
 * User: SupGL
 * Date: 2016/5/6
 * Time: 10:36
 */
namespace Admin\Controller;

class SeniorController extends BaseController{
    protected $menu;
    function _initialize(){
        $this->menu = D('Menu');
    }

    public function menu_index(){
        $this->display('menu_index');
    }
    public function menu_add(){
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
        $this->assign('type',$type);
        $this->display('menu_add');
    }
    public function menu_list(){
        $start = I('start');
        $limit = I('length');
        $icolumn = I('columns');
        $sort_num = I('iSortCol_0','');
        $sort = I('mDataProp_'.$sort_num,'t_id');
        $dir = I('sSortDir_0','DESC');
        $order=array($sort=>$dir);
        $isearch = I('sSearch','');
        $isearch?$where="`m_name` like '%$isearch%'":$where='';
        $list=$this->menu->where($where)->limit($start,$limit)->order($order)->select();
        $num =$this->menu->where($where)->count();
        $data = array(
            'iTotalRecords' => $num,
            'iTotalDisplayRecords' => $num,
            'aaData' => $list
        );
        echo json_encode($data);
    }
}