<?php

defined('THINK_PATH') or exit();

class alter_scoreBehavior extends Behavior {

    public function run(&$_data){
    	C(F('score_rule'));
        $this->_alter_score($_data);
    }

    /**
     * 改变用户积分
     * 配置操作行为必须和标签名称一致
     */
    private function _alter_score($_data) {
        $score = C('ik_srule_'.$_data['action']); //获取积分变量
        if (intval($score) == 0) return false; //积分为0
        if ($this->_check_num($_data['uid'], $_data['action'])) {
        	//获取当前积分
        	$cutscore = D('user')->field('count_score')->where(array('userid'=>$_data['uid']))->getField('count_score');
        	echo $cutscore;die;
        	$newscore = $cutscore + abs($score);
        	$dataScore['score_start'] = array('gt','gt ') 
        	$strRole = D('user_role')->where(array('score_start'))
            $score_data = array('count_score'=>$newscore);
            D('user')->where(array('userid'=>$_data['uid']))->setField($score_data); //改变用户积分
            //积分日志
            $score_log_mod = M('user_score_log');
            $score_log_mod->create(array(
                'uid' => $_data['uid'],
                'uname' => $_data['uname'],
                'action' => $_data['action'],
                'score' => $score,
            ));
            $score_log_mod->add();
        }
    }

    /**
     * 检查次数限制
     */
    private function _check_num($uid, $action){
        $return = false;
        $user_stat_mod = M('user_stat');
        //登陆次数限制
        $max_num = C('ik_srule_'.$action.'_nums'); 
        //先检查统计信息
        $stat = $user_stat_mod->field('num,last_time')->where(array('uid'=>$uid, 'action'=>$action))->find();
        if (!$stat) {
            $user_stat_mod->create(array('uid'=>$uid, 'action'=>$action,'last_time'=>time()));
            $user_stat_mod->add();
        }
        $new_num = $stat['num'] + 1;
        if ($max_num == 0) {
            $return = true; //为0则不限制
        } else {
            if ($stat['last_time'] < todaytime()) {
                $new_num = 1;
                $return = true;
            } else {
                $return = $stat['num'] >= $max_num ? false : true;
            }
        }
        //更新统计
        $user_stat_mod->create(array('num'=>$new_num));
        $user_stat_mod->where(array('uid'=>$uid, 'action'=>$action))->save();
        return $return;
    }

}