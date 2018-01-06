/**
 * Created by root on 18-1-4.
 */
(function(){
    var ESHUtils = this.ESHUtils;

    $(function(){
        var $errorMsg = $('#errorMsg');

        $('#loginForm').on('click','.mdl-button',function(evt){
            var user, pwd, validated;
            user = $('#account').val().trim();
            pwd = $('#pwd').val().trim();

            validated = false;

            if(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(user)){
                validated = true;
            }

            if(!validated && user.length === 11 && /^1\d{10}$/.test(user)){
                validated = true;
            }

            if(validated && pwd.length < 7){
                validated = false;
            }

            if(!validated){
                $errorMsg.text('帐号或密码错误！');
            }else {
                $errorMsg.text('');
                $.ajax({
                    type: "POST",
                    url: '../../login',
                    data:{user: user, pwd: pwd},
                    dataType: "json",
                    success:function(data){
                        if(data.result === 'success') {
                            ESHUtils.goPage({url:'../home/home.html'});
                        }else {
                            $errorMsg.text(data['error']);
                        }
                    },
                    error: function(){
                        $errorMsg.text('网络错误，请稍后再试！');
                    }
                });
            }

            return ESHUtils.stopEvent(evt);
        }).on('input','.form-ctrl',function(evt){

            $errorMsg.text() && $errorMsg.text('');

            return ESHUtils.stopEvent(evt);
        });


    });
})();