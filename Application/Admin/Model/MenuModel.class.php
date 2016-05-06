<?php
namespace Admin\Model;
use Think\Model;

class MenuModel extends Model{

    protected $_validate = array(
//        array('t_title','require','回复规则名称必须填写！'),
//        array('t_title','','回复规则名称已经存在！',0,'unique'),
//        array('t_keyword','require','触发关键字必须填写！'),
//        array('t_content','require','回复内容必须填写！'),
    );

    protected $_auto = array (

    );
}
?>