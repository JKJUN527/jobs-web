/**
 * Created by Love_sandy on 17-12-16.
 */


(function(){

    var ESHUtils = this.ESHUtils;

    $(function(){
        $('.esh-media-list--text').on('click', '.esh-list__item', function(evt){

            var $this = $(this);

            if($this.hasClass('esh-list__item-load')){
                ESHUtils.goPage({url: '../job/job.html'});
            }else {
                ESHUtils.goPage({url: '../job/jobView.html'});
            }

            return ESHUtils.stopEvent(evt);
        });
    });
})();