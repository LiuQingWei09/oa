<?php
//1. 声明命名空间（路径）
namespace Admin\Model;
//2. 引入模型基类
use Think\Model;
//3. 编写模型类
class StudentModel extends Model{
    // 定义实际使用的表名
    // protected $trueTableName = 'oa_stu';
    // 定义没有前缀的表名
    protected $tableName = 'stu';
    
    // 定义了表的主键
    protected $pk = 'sno';
    // 字段信息,将表的所有字段全部写入该属性。也能省略数据表分析过程
    protected $fields = array(
        'sno','sname','spasswd','sage','ssex','sdept','saddtime'
    );
    // 字段映射定义,将表单的字段和数据表字段对应起来
    protected $_map = array(
        //表单字段 => 数据表字段
        'name' => 'sname',
        'passwd' => 'spasswd',
        'age'  => 'sage',
        'sex'  => 'ssex',
        'dept' => 'sdept'
    ); 
    // 自动验证定义
    protected $_validate = array(
        // sname : 要验证的字段
        // username : 验证方法， 自定义的规则，6-12位字母数字下划线组合
        // 学生名不能为空: 验证失败后的提示信息
        // 1 : 该字段必须验证
        // regex : 使用正则方式来验证
        // 3 : 新增和修改时都必须验证
        array('sname', 'username', '学生名必须是6-12位的字母数字下划组合', 1, 'regex', 3),
        
        // 验证密码相同
        array('re-passwd', 'spasswd', '两次密码不相同', 1, 'confirm', 3),
        
        array('sage', 'number', '学生年龄必须为数字'),
        // ssex : 要验证的字段
        // checkSex : 使用该函数来验证ssex提交的值
        // 性别不符合要求 : 验证失败后的报错
        // callback : 使用回调函数来进行验证
        array('ssex', 'checkSex', '性别不符合要求', 1, 'callback', 3),
        // sdept : 要验证的字段
        // checkDept : 验证使用的函数
        // 系别id不正确 : 报错信息
        // function : 使用函数方式，该函数定义在 Common/Common目录中
        array('sdept', 'checkDept', '系别id不正确', 1, 'function', 3),
        
    );  
    
    //参数：要验证字段的数据
    function checkSex($data){
        if(in_array($data, array('男', '女', '人妖'))){
            //返回true即验证成功 
            return true;
        } else {
            return false;
        }
    }
    
    // 自动完成定义
    protected $_auto  =  array(
        // spasswd : 要完成填充的字段
        // setMd5 : 使用PHP的MD5函数，对spasswd加密后再填充
        // 3 : 在新增和修改时，都进行填充
        // callback : 使用回调函数来填充
        array('spasswd', 'setMd5', 3, 'callback'),
        array('saddtime', 'setDateTime', 3, 'function')
    );  
    
    // 自定义函数方式
    function setMd5($data){
        return md5($data);
    }
    
    
    
    
    
    
}