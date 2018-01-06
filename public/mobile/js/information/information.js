/**
 * Created by Love_sandy on 17-12-16.
 */


(function () {

    var stopEvent = this.ESHUtils.stopEvent,
        ESH_CONSTANT = {
            ESH_INFO_LIST_PRIMARY_ID: 'esh-info-primary-list',
            PRIMARY_LIST_ITEM_CLASS: 'esh-list__item',
            PRIMARY_LIST_ITEM_LOAD_CLASS: 'esh-list__item-load',
            PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS: 'esh-list__item-load-text',
        };


    var getListData = function (action) {
        if (!action) action = 'reload';

        var infoListArr = [
            {
                image: 'http://116.62.198.110/storage/newspic/2017-12-24-12-17-33-5a3f2a5d9a7ecnews1.jpeg',
                title: '为电竞打call！ CMEG2017全国移动电子竞技大赛忠县',
                info: '发布时间: 2017-12-24'
            },
            {
                image: 'http://116.62.198.110/storage/newspic/2017-12-24-11-35-31-5a3f2083bb420news1.jpg',
                title: '一文读懂KPL秋季赛：QG缔造王朝 新军闪耀未来可期',
                info: '发布时间: 2017-12-24'
            },
            {
                image: 'http://116.62.198.110/storage/newspic/2017-12-23-11-27-27-5a3dcd1f63de4news1.png',
                title: '新版本！新赛事！PUBG GAL开战在即！',
                info: '发布时间: 2017-12-24'
            }
        ];

        return {
            listData: infoListArr,
            option: {
                type: 'information',
                action: action,
                targetId: ESH_CONSTANT.ESH_INFO_LIST_PRIMARY_ID,
                hasLoad: true,
                callback: function (data) {
                    console.log('success!');
                }
            }
        };
    };

    $(function () {

        // 加载更多点击事件监听
        $('#' + ESH_CONSTANT.ESH_INFO_LIST_PRIMARY_ID).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS, function (evt) {
            ESHUtils.loadList(getListData('append'));
        }).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_CLASS, function (evt) {
            var $this = $(this);
            if ($this.hasClass(ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_CLASS)) {
                return stopEvent(evt);
            }
            window.location.href = './infoDetail.html';
        });



    });


    ESHUtils.loadList(getListData());


})();