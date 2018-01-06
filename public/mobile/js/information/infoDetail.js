/**
 * Created by apple on 17/12/27.
 */
(function () {


    $(function () {
        $(document).ready(function () {

            var nid = $(".mdl-card__title-text").attr("data-content");


            var data = {
                news: {
                    content: "北京时间12月28日，知名英雄联盟选手韦神已经转型绝地求生。尽管转型绝地求生，但还是总被粉丝们要求去打英雄联盟。<br><br>[图片1]<br>近日，韦神又一次被要求去带Uzi去玩吃鸡。韦神不堪粉丝骚扰后，直言：让Uzi好好训练，不要总吃鸡，想双排他会叫我。<br><br>随后粉丝们看韦神拒绝的这么坚决，就让韦神和Uzi&nbsp;Solo。<br><br>[图片2]<br>韦神听到这个就开始了疯狂吐槽：<br><br>全明星跟他打了20把Solo赢了一把，心态都打崩了，复仇之矛打Solo太™赖了。AP打Solo就是打不过AD，你看他把多少AP都X了，就没有一个AP打得过他的，AP英雄本来就打不过AD英雄，你跟他对玩AD又玩不过别人。<br><br>[图片3]<br>看来Uzi的冠军真的是当之无愧，连韦神这么心高气傲的选手都被他征服了。",
                    created_at: "2017-12-29 11:41:39",
                    nid: 233,
                    picture: "http://www.eshunter.com/storage/newspic/1@2017-12-29-11-41-39-5a45b9734387fnews1.jpg;2@2017-12-29-11-41-39-5a45b973446b2news2.jpg;3@2017-12-29-11-41-39-5a45b97344821news3.jpg;",
                    quote: "大电竞",
                    subtitle: null,
                    tag: null,
                    title: "韦神吐槽Uzi：和他单挑了20次只赢了1次",
                    type: 1,
                    uid: 35,
                    updated_at: "2017-12-30 12:04:06",
                    view_count: 10
                }
            };

            var content = data['news']['content'];
            var images = data['news']['picture'];
            var imageTemp = images.split(";");
            var imagesArray = [];

            for (var i in imageTemp) {
                imagesArray[i + ''] = imageTemp[i + ''].split("@");
            }

            var baseUrl = imagesArray[0][0].substring(0, imagesArray[0][0].length - 1);
            imagesArray[0][0] = imagesArray[0][0].replace(baseUrl, '');

            console.log(imagesArray);
            console.log(baseUrl);

            for (var j = 0; j < imagesArray.length; j++) {
                content = content.replace("[图片" + imagesArray[j][0] + "]", "<div class='news-image'><img src='" + baseUrl + imagesArray[j][1] + "'/></div>");
            }


            $(".mdl-card__supporting-text").html(content);

//
//                 $.ajax({
//                     url: "/news/content?nid=" + nid,
//                     type: "get",
//                     success: function (data) {
//                         var content = data['news']['content'];
//                         var images = data['news']['picture'];
//                         var imageTemp = images.split(";");
//                         var imagesArray = [];
//
//                         for (var i in imageTemp) {
//                             imagesArray[i + ''] = imageTemp[i + ''].split("@");
//                         }
//
//                         var baseUrl = imagesArray[0][0].substring(0, imagesArray[0][0].length - 1);
//                         imagesArray[0][0] = imagesArray[0][0].replace(baseUrl, '');
//
// //                    console.log(imagesArray);
// //                    console.log(baseUrl);
// //                    console.log();
//
//                         for (var j = 0; j < imagesArray.length; j++) {
//                             content = content.replace("[图片" + imagesArray[j][0] + "]", "<div class='news-image'><img src='" + baseUrl + imagesArray[j][1] + "'/></div>");
//                         }
//
//                         $(".mdl-card__supporting-text").html(content);
//                     }
//                 })
        });
    })
})();