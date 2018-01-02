<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>转账确认</title>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<style type="text/css">
	*{
		margin: 0px auto;
	}

	.trans_box{
		width: 500px;
		margin-top: 80px;
		background-color: #ececec;
		padding-top: 50px;
	}

	.trans_line{
		line-height: 70px;
	}

	.trans_label{
		margin-left: 80px;
	}

	.trans_input{
		width: 200px;
		height: 30px;
		padding-left: 10px;
		font-size: 16px;
	}

	.trans_btn_box{
		width: 100%;
		text-align: center;
	}

	.trans_btn{
		width: 120px;
		height: 50px;
		background-color: #02aaf1;
		border: solid 1px #02aaf1;
		color: #ffffff;
		margin-top: 30px;
		margin-bottom: 30px;
	}
</style>
</head>

<body>
	<div class="trans_box">
		<div class="trans_line">
			<label class="trans_label">收款账号：<label>
			<input type="text" class="trans_input" id="trans_username" />
		</div>
		<div class="trans_line">
			<label class="trans_label">支付金额：<label>
				<input type="text" class="trans_input" id="trans_fee" />
		</div>
		<div class="trans_btn_box">
			<input type="button" class="trans_btn" onclick="confirm_trans()" value="点我去支付" />
		</div>
	</div>
</body>
<script type="text/javascript">
	function confirm_trans() {
        var trans_username = $("#trans_username").val();
        var trans_fee = parseFloat($("#trans_fee").val());

        if(!trans_username){
            alert("收款账号不能为空")
        }else if(!trans_fee){
            alert("支付金额不能为空")
        }else{
            $.ajax({
                url:'Home/Pay/alipay_transfer',
                type:'POST', //GET
                async:true,    //或false,是否异步
                data:{
                    trans_username:trans_username,
                    trans_fee:trans_fee
                },
                timeout:5000,    //超时时间
                dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                beforeSend:function(xhr){
                    console.log(xhr)
                    console.log('发送前')
                },
                success:function(data,textStatus,jqXHR){
                    alert(data.message);
                    console.log(data)
                    console.log(textStatus)
                    console.log(jqXHR)
                },
                error:function(xhr,textStatus){
                    alert('错误')
                    console.log(xhr)
                    console.log(textStatus)
                },
                complete:function(){
                    console.log('结束')
                }
            })
        }

    }
</script>
</html>