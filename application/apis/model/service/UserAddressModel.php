<?php

namespace app\apis\model\service;
class UserAddressModel 
{
    /* name:初始化函数
     * purpose: 系统模型初始化方法,初始化系统逻辑层类对象.
     * return:  无
     * author:longdada
     * write_time:2019/01/30 14:50
     */
    public function __construct()
    {
        $this->address=model('logic.UserAddress');
    }
    /* name:获取收货地址列表
     * purpose: 根据用户ID获取用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function get_address_list()
    {
        return  $this->address-> get_address_list();
    }
    /* name:获取一行收货地址
     * purpose: 根据用户ID获取用户收货地址
     * return:  返回用户收货地址数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function get_address_row()
    {
        return  $this->address-> get_address_row();
    }
    /* name:添加单个收货地址
     * purpose: 保存单个收货地址添加
     * return:  返回添加结果
     * author:longdada
     * write_time:2019/02/02 22:34
     */
    public function save_address_add()
    {
        return  $this->address-> save_address_add();
    }
    /* name:编辑单个收货地址
     * purpose: 保存单个收货地址编辑
     * return:  返回编辑结果
     * author:longdada
     * write_time:2019/02/08 08:45
     */
    public function save_address_edit()
    {
        return  $this->address-> save_address_edit();
    }
    /* name:删除收货地址
     * purpose: 删除收货地址,单个或者批量
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/02/08 09:12
     */
    public function save_address_del()
    {
        return  $this->address-> save_address_del();
    }
}
