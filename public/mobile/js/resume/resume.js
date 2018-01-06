/**
 * Created by asusps on 2017/12/28.
 */
(function(){
    $("#del-resume").click(function(){ //删除简历
        $.ajax({
            url: "/resume/delResume",
            type: "get",
            success: function (data) {
                if (data['status'] === 200) {
                    $()
                } else if (data['status'] === 400) {
                    alert(data['msg']);
                }
            }
        });
    })
})();
