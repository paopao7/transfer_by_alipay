<?php
namespace Org;
class AliWapPay{
 //支付宝单笔转账接口
    public function alipay_transfer($trans_username,$trans_fee){
        require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'aop/AopClient.php';
        require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'aop/request/AlipayFundTransToaccountTransferRequest.php';

        //生成订单编号
        $out_trade_no = uniqid();

        //根据订单号查找对应订单
        $model_order = D('Order');

        $new_data['out_trade_no'] = $out_trade_no;
        $new_data['payee_account'] = $trans_username;
        $new_data['amount'] = $trans_fee;
        $new_data['create_time'] = time();

        $order_info = $model_order->data($new_data)->add();


        $aop = new \AopClient ();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = '';
        $aop->rsaPrivateKey = '';
        $aop->alipayrsaPublicKey='';
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset='utf-8';
        $aop->format='json';

        $request = new \AlipayFundTransToaccountTransferRequest ();



        //收款方账户类型为：ALIPAY_LOGONID：支付宝登录号，支持邮箱和手机号格式。
        $request->setBizContent("{" .
            "\"out_biz_no\":\"".$out_trade_no."\"," .
            "\"payee_type\":\"ALIPAY_LOGONID\"," .
            "\"payee_account\":\"".$trans_username."\"," .
            "\"amount\":\"".$trans_fee."\"," .
            "\"payer_show_name\":\"商家付款\"," .
            "\"remark\":\"商家付款\"" .
        "}");

        $result = $aop->execute ($request);
        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;


        if(!empty($resultCode)&&$resultCode == 10000){
            //根据订单号修改用户优惠券状态
            $new_order['has_notify'] = 1;
            $new_order['update_time'] = time();

            $where_order['out_trade_no'] = array('eq',$out_trade_no);

            $flag = $model_order->where($where_order)->data($new_order)->save();

            if($flag){
                return true;
            }else{
                return false;
            }
        }
    }    
}