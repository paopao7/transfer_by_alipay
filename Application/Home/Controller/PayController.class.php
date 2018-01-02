<?php
namespace Home\Controller;
use Think\Controller;
use Org\AliWapPay;
class PayController extends Controller {
    //支付宝单笔转账接口
    public function alipay_transfer(){
        $trans_username = $_POST['trans_username'];
        $trans_fee = $_POST['trans_fee'];

        Vendor('AliWapPay','ThinkPHP/Library/Org/AliWapPay/','.class.php');
        $result = AliWapPay::alipay_transfer($trans_username,$trans_fee);

        if($result){
            $data['status'] = "yes";
            $data['message'] = "恭喜，支付成功";
        }else{
            $data['status'] = "no";
            $data['message'] = "对不起，支付失败";
        }

        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
}