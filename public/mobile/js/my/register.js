/**
 * Created by root on 18-1-5.
 */
(function(){
    var ESHUtils = this.ESHUtils;

    $(function(){
        var $registerWay = $('.esh-reg-way'),
            $currentWay = $registerWay.find('.esh-active'),
            prevId = $currentWay && $currentWay.data('target'),
            $account = $('#account'),
            $errorMsg = $('.error-msg'),
            timer = null,
            timerRunning = 0,
            totalTime = 120,
            $verifyBlock = $('.esh-form-verify'),
            registerData = {
                mail: {
                    label: '邮箱',
                    placeholder: '请输入邮箱…',
                    validate: /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i
                },
                phone: {
                    label: '手机号',
                    placeholder: '请输入手机号…',
                    validate: /^1\d{10}$/
                }
            };

        $registerWay.on('click','.esh-reg-phone,.esh-reg-mail',function(evt){
            var $this = $(this),
                id = $this.data('target');

            if(prevId !== id){
                $this.siblings().removeClass('esh-active').end().addClass('esh-active');
                $account.attr('placeholder',(registerData[id] && registerData[id].placeholder) || '').focus();
                $verifyBlock.toggle(id === 'phone');
                prevId = id;
                $currentWay = $this;
            }

            return ESHUtils.stopEvent(evt);
        });

        $verifyBlock.on('click','.mdl-js-button',function(evt){
            var $this = $(this);

            if(timerRunning){
                return ESHUtils.stopEvent(evt);
            }

            timer = setInterval(function(){
                var time = totalTime - timerRunning;
                if(!time){
                    $this.text('获取验证码');
                    timerRunning = 0;
                    clearInterval(timer);
                }else {
                    timerRunning++;
                    $this.text('获取验证码(' + time + ' s)');
                }

            },1000);

            $.ajax({
                type: "POST",
                url: '../../getRegisterCode',
                dataType: "json",
                success:function(data){

                }
            });

            return ESHUtils.stopEvent(evt);
        });

        $('.esh-form-footer').on('click', '.mdl-js-button', function(evt){
            var postData = {},
                key = registerData[prevId] || {},
                account = $account.val().trim(),
                pwd1 = $('#registerPwd1').val().trim(),
                pwd2 = $('#registerPwd2').val().trim(),
                verifyCode = $('#verifyCode').val().trim(),
                isValid = false;

            if(key.validate && key.validate.test(account)){
                postData['accountType'] = prevId;
                postData['account'] = account;
                isValid = true;
            }else {
                isValid = false;
                $errorMsg.text('输入的' + (key.label || '注册帐号') + '不正确！');
            }
            
            if(isValid){
                if(pwd1.length > 7 && pwd2.length > 7){
                    if(pwd1 !== pwd2) {
                        isValid = false;
                        $errorMsg.text('两次输入的密码不相同！');
                    }else {
                        postData['password'] = pwd1;
                        isValid = true;
                    }
                }else {
                    isValid = false;
                    $errorMsg.text('密码和确认密码长度必须大于等于8位！');
                }
            }
            
            if(isValid && prevId === 'phone'){
                if(verifyCode.length === 4 && /[0-9]{4}/.test(verifyCode)) {
                    postData['verifyCode'] = verifyCode;
                    isValid = true;
                }else {
                    isValid = false;
                    $errorMsg.text('验证码错误！');
                }
            }

            if(isValid){
                if($('#agreement').is(':checked')){
                    postData['agreement'] = true;
                    isValid = true;
                }else {
                    isValid = false;
                    $errorMsg.text('请同意用户协议！');
                }
            }

            if(isValid) {
                postData['registerType'] = $('.esh-reg-type').find('.mdl-radio__button:checked').val();

                $.ajax({
                    type: "POST",
                    url: '../../register',
                    dataType: "json",
                    data: postData,
                    success:function(data){
                        if(data.result === 'success') {
                            
                        }else {
                            $errorMsg.text(data['error']);
                        }
                    },
                    error:function(error){
                        $errorMsg.text('网络错误，请稍后再试！');
                    }
                });
            }

            return ESHUtils.stopEvent(evt);
        });
    });

})();