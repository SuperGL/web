<?php
namespace Admin\Model;
use Think\Model;

class MenuModel extends Model{

    protected $_validate = array(
        array('m_name','require','菜单名称必须填写！'),
        array('m_name','','菜单名称已经存在！',0,'unique'),
        array('m_type','require','菜单类型必须填写！')
    );

    protected $_auto = array (

    );
}
?>