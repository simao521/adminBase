<?php
namespace app\apis\model\logic;
class UserAddressModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->address=model('db.UserAddress');
        $this->validates=validate('UserAddress');
    }
     /* name:获取收货地址列表
     * purpose: 根据用户ID获取用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function get_address_list()
    {
        $post_data=input();
        if($this->validates->scene('get_address_list')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $where['status']=['gt',0];
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $rs_list=$this->address->where($where)->limit($post_data['start'],$post_data['page_size'])->order('id','desc')->select();
            if(!empty($rs_list)){
                $user=model('service.User')->get_user_row($post_data['user_id']);
                foreach($rs_list as &$ve){
                    if($user['data']['address_id']==$ve['id']){
                        $ve['is_default']=1;
                    }else{
                        $ve['is_default']=0;
                    }
                    $ve['province_text']=$ve->province_text;
                    $ve['city_text']=$ve->city_text;
                    $ve['district_text']=$ve->district_text;
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['count']=$this->address->where($where)->count();
                $rs_arr['start']=$post_data['start'];
                $rs_arr['page_size']=$post_data['page_size'];
                $rs_arr['data']=$rs_list;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:获取一行收货地址
     * purpose: 根据用户ID获取用户收货地址
     * return:  返回用户收货地址数据
     * author:longdada
     * write_time:2019/02/02 08:29
     */
    public function get_address_row()
    {
        $post_data=input();
        if($this->validates->scene('get_address_row')->check($post_data)){
            $where['id']=$post_data['id'];
            $rs_row=$this->address->where($where)->find();
            if(!empty($rs_row)){
                $user=model('service.User')->get_user_row($rs_row['user_id']);
                if($user['data']['address_id']==$rs_row['id']){
                    $rs_row['is_default']=1;
                }else{
                    $rs_row['is_default']=0;
                }
                $rs_row['province_text']=$rs_row->province_text;
                $rs_row['city_text']=$rs_row->city_text;
                $rs_row['district_text']=$rs_row->district_text;
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['data']=$rs_row;
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("GET_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:添加单个收货地址
     * purpose: 保存单个收货地址添加
     * return:  返回添加结果
     * author:longdada
     * write_time:2019/02/02 22:34
     */
    public function save_address_add()
    {
        $post_data=input();
        if($this->validates->scene('save_address_add')->check($post_data)){
            $post_data['status']=1;
            $rs_st=$this->address->allowField(true)->isUpdate(false)->save($post_data);
            if($rs_st!==false){
                if($post_data['is_default']==1){
                    model('service.user')->set_address_default($post_data['user_id'],$this->address->id);
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("SAVE_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SAVE_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
     /* name:编辑单个收货地址
     * purpose: 保存单个收货地址编辑
     * return:  返回编辑结果
     * author:longdada
     * write_time:2019/02/08 08:45
     */
    public function save_address_edit()
    {
        $post_data=input();
        if($this->validates->scene('save_address_edit')->check($post_data)){
            $rs_st=$this->address->allowField(true)->isUpdate(true)->save($post_data);
            if($rs_st!==false){
                if($post_data['is_default']==1){
                    model('service.user')->set_address_default($post_data['user_id'],$post_data['id']);
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("SAVE_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("SAVE_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['data']=$post_data;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
     /* name:删除收货地址
     * purpose: 删除收货地址,单个或者批量
     * return:  返回删除结果
     * author:longdada
     * write_time:2019/02/08 09:12
     */
    public function save_address_del()
    {
        $post_data=input();
        if($this->validates->scene('save_address_del')->check($post_data)){
            $post_data['status']=-1;
            $rs_st=$this->address->allowField(true)->isUpdate(true)->save($post_data);
            if($rs_st!==false){
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("DEL_SUCCESS");
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("DEL_ERROR");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['data']=$post_data;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
