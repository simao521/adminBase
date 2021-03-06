<?php
namespace app\apis\model\logic;
class UserCollectModel
{
    /* name:逻辑层初始化方法
     * purpose: 初始化数据库层管理员模型对象
     * return:  无
     * author:longdada
     * write_time:2019/01/22 22:00
     */
    public function __construct()
    {
        $this->user_collect=model('db.UserCollect');
        $this->validates=validate('UserCollect');
    }
    /* name:我的收藏列表
     * purpose: 获取我收藏的店铺,商铺,文章,用户列表
     * return:  返回列表数据
     * author:longdada
     * write_time:2019/02/08 17:10
     */
    public function get_collect_list()
    {
        $post_data=input();
        if($this->validates->scene('get_collect_list')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $where['type']=$post_data['type'];
            $post_data['start']=isset($post_data['start'])&&!empty($post_data['start'])?$post_data['start']:0;
            $post_data['page_size']=isset($post_data['page_size'])&&!empty($post_data['page_size'])?$post_data['page_size']:6;
            $rs_list=$this->user_collect->where($where)->limit($post_data['start'],$post_data['page_size'])->order('id','desc')->select();
            if(!empty($rs_list)){
                foreach($rs_list as &$ve){
                    
                }
                $rs_arr['code']=1;
                $rs_arr['msg']=lang("GET_SUCCESS");
                $rs_arr['count']=$this->user_collect->where($where)->count();
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
    /* name:添加收藏
     * purpose: 保存添加收藏
     * return:  返回收藏结果
     * author:longdada
     * write_time:2019/02/08 17:17
     */
    public function save_collect_add()
    {
        $post_data=input();
        if($this->validates->scene('save_follow_add')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $where['type']=$post_data['type'];
            $where['collect_id']=$post_data['collect_id'];
            $rs_row=$this->user_collect->where($where)->find();
            if(!empty($rs_row)){
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("DO_COLLECT");
            }else{
                $post_data['status']=1;
                $rs_st=$this->user_collect->allowField(true)->isUpdate(false)->save($post_data);
                if($rs_st!==false){
                    $rs_arr['code']=1;
                    $rs_arr['msg']=lang("SUB_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("SUB_ERROR");
                }
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
    /* name:取消关注
     * purpose: 保存取消关注
     * return:  返回取消关注结果
     * author:longdada
     * write_time:2019/02/08 16:40
     */
    public function save_collect_del()
    {
        $post_data=input();
        if($this->validates->scene('save_collect_del')->check($post_data)){
            $where['user_id']=$post_data['user_id'];
            $where['type']=$post_data['type'];
            $where['collect_id']=['in',$post_data['collect_id']];
            $rs_row=$this->user_collect->where($where)->find();
            if(!empty($rs_row)){
                $post_data['status']=1;
                $rs_st=$this->user_collect->where($where)->delete();
                if($rs_st!==false){
                    $rs_arr['code']=1;
                    $rs_arr['msg']=lang("DEL_SUCCESS");
                }else{
                    $rs_arr['code']=0;
                    $rs_arr['msg']=lang("DEL_ERROR");
                }
            }else{
                $rs_arr['code']=0;
                $rs_arr['msg']=lang("NOT_COLLECT");
            }
        }else{
            $rs_arr['code']=0;
            $rs_arr['msg']=$this->validates->getError();
        }
        return $rs_arr;
    }
}
