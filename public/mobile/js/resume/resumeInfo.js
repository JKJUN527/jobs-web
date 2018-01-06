/**
 * Created by asusps on 2018/1/1.
 */
(function(){
    $(function(){
        $("#esh-edit-name").click(function(){
            var inputVal = $("#esh-resume-name").html();
            $("body").addClass("esh-sweetalert");
            swal({
                    title: "修改简历名称",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputValue: inputVal,
                    confirmButtonText: "确定",
                    cancelButtonText: "取消"

                },
                function(inputValue){
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("请输入简历名称！");
                        return false
                    }

                    $("#esh-resume-name").html(inputValue);
                    swal.close();
                   /* var formData = new FormData();
                    formData.append('rid', rid.val());
                    formData.append('name', resumeName.val());
                    $.ajax({
                        url: '/resume/rename',
                        type: 'post',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if(result.status="success"){
                                $("#esh-resume-name").html(inputValue);
                                swal.close();
                            }
                        }
                    });*/

                });
        });
    });
}).call(this)