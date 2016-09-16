<?php
namespace Admin\Controller;
use Think\Controller;

class MtestController extends Controller{
    function index(){
        // 使用D方法来实例化自定义模型
        $student = D('Student');
        $data = $student->select();
        dump($data);
    }
    
    function test(){
        //$student = M('Student');
        $student = D('Student');
        dump($student);
    }
    
    function add() {
        $this->display();
    }
    
    function addOk(){
        //1. 实例化student表模型
        $student = D('Student');
        //2. 使用create()方法来接收表单信息
        $data = $student->create();
        if(!$data){
            echo $student->getError();
        }
        $data['spasswd'] = md5($data['spasswd']);
        $data['saddtime'] = date('Y-m-d');
        dump($data);
        //$student->add($data);
    }
}