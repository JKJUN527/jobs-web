/**
 * Created by asusps on 2018/1/2.
 */
(function(){
    var ESHUtils = this.ESHUtils;
    $(function(){
        ESHUtils.fillSpan();//select下拉框选项相关事件
        $(".esh-select2").select2();
        $(".esh-select .select2-container").css("width","100%");

        $("#esh-save-jobintention").click(function(){
            var formData = ESHUtils.getElementsByName("esh-job-intention");
            $.ajax({
                url: "/resume/addIntention",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.data=="success"){
                        ESHUtils.pageBack();
                    }
                }
            });
        });
//        $("#add-intention--button").click(function () {
//            var rid = $("input[name='rid']");
//            var place = $("select[name='place']");
//            var industry = $("select[name='industry']");
////            var occupation = $("select[name='occupation']");
//            var occupation = $("select[name='occupation" + industry.val() + "']");
//            var type = $("select[name='type']");
//            var salary = $("input[name='salary']");
//
//            var formData = new FormData();
//            formData.append('rid', rid.val());
//            formData.append('work_nature', type.val());
//            formData.append('occupation', occupation.val());
//            formData.append('industry', industry.val());
//            formData.append('region', place.val());
//
//
//            if (salary.val() === '') {
//                formData.append('salary', -1);
//            } else {
//                formData.append('salary', salary.val());
//            }
//
//            $.ajax({
//                url: "/resume/addIntention",
//                type: 'post',
//                dataType: 'text',
//                cache: false,
//                contentType: false,
//                processData: false,
//                data: formData,
//                success: function (data) {
//                    var result = JSON.parse(data);
//                    if(result.data=="success"){
//                        ESHUtils.pageBack();
//                    }
//                }
//            })
//        });

    });

}).call(this);