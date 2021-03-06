<?php
namespace app\apis\validate;
use think\Validate;
class MsgValidate extends Validate
{   
    /* name:消息验证规则
     * purpose: 对消息进行验证
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $rule = [
       
    ];
    /* name:自定义验证规则错误信息
     * purpose: 自定义验证规则错误信息
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $message = [
    ];
    /* name:消息验证场景
     * purpose: 按照不同的场景定义不同的验证规则更加灵活 
     * return:  无
     * author:longdada
     * write_time:2019/02/02 18:09
     */
    protected $scene = [
        'get_region_list'  =>  ['parent_id']
    ];
}
