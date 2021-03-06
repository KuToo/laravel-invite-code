<?php

namespace Yangzx\InviteCode;

use Hashids;
use Illuminate\Config\Repository;

/**
 * 邀请码生成类
 */
class InviteCode{
    protected $config;
    private $hashIds;

    public function __construct(Repository $config){
        $this->config = $config->get('invitecode');
        $salt = $this->config['salt'];
        if(empty($salt)){
            $salt = env('APP_KEY');
        }
        //实例化HashIds类库
        $this->hashIds = new Hashids($salt,$this->config['length'],$this->config['char']);
    }
    /**
     * 生成邀请码
     */
    public function enCode($id){
        return $this->hashIds->encode($id);
    }
    /**
     * 根据邀请码获取用户ID
     */
    public function deCode($code){
        $code = $this->hashIds->decode($code);
        if(is_array($code)){
            return current($code);
        }else{
            return $code;
        }
    }
}
