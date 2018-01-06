/**
 * Created by Love_sandy on 17-12-16.
 */


(function(){

    var openModal,
        closeModal,
        updateFilter,
        updateSelectedElement,
        resetSelectedElement,
        loadTabPanelContent,
        createList,
        createListItem,
        ESHAjax,
        ESHUtils = this.ESHUtils,
        stopEvent = this.ESHUtils.stopEvent,
        filterKeys = ['industry','salary','type','site','order'],
        filterData = {
            industry:{
                val: '',
                selected: null,
                tempSelected: null,
                defaultVal: '行业'
            },
            salary:{
                val: '',
                selected: null,
                tempSelected: null,
                defaultVal: '薪酬'
            },
            type:{
                val: '',
                selected: null,
                tempSelected: null,
                defaultVal: '类型'
            },
            site:{
                val: '',
                selected: null,
                tempSelected: null,
                defaultVal: '省份'
            },
            order:{
                val: '',
                selected: null,
                tempSelected: null,
                defaultVal: '热度'
            },
            toModel:function(){
                var key, i, len = filterKeys.length, model = {};

                for(i=0;i<len;i++){
                    key = filterKeys[i];
                    model[key] = filterData[key].val;
                }

                return model;


            }
        },
        ESH_CONSTANT = {
            MODAL_ID: 'esh-modal-filter',
            MODAL_BODY_ID: 'esh-modal-body',
            MODAL_BUTTON_CLASS: 'mdl-button',
            PAGE_HEADER_ID: 'esh-layout-header',
            PAGE_SUB_HEADER_ID: 'esh-layout-sub-header',
            SEARCH_FORM_ID: 'esh-search-form',
            FILTER_KEY_LIST_CLASS: 'esh-list--magnetic',
            FILTER_KEY_LIST_ITEM_CLASS: 'esh-list__item',
            FILTER_KEY_LIST_LINK_CLASS: 'esh-list__link',
            PRIMARY_LIST_ID: 'esh-primary-list',
            PRIMARY_LIST_ITEM_CLASS: 'esh-list__item',
            PRIMARY_LIST_ITEM_LOAD_CLASS: 'esh-list__item-load',
            PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS: 'esh-list__item-load-text',
            PRIMARY_LIST_ITEM_LOAD_TEXT_ID: 'esh-primary-list-load-text',
            NAV_LINK_PREFIX: 'esh-nav-link-',
            NAV_LINK_CLASS: 'esh-navigation__text',
            NAV_LINK_TEXT_CLASS: 'esh-navigation__text',
            TABS_TAB_PREFIX: 'esh-tabs-tab-',
            TABS_PANEL_PREFIX: 'esh-tabs-panel-',
            SEARCH_INPUT_ID: 'esh-search-input',
            ACTION_LOADING_MORE: 'load-more',
            ACTION_ENTER: 'enter',
            ACTION_CANCEL:'cancel'
        };

    var $modal = $('#' + ESH_CONSTANT.MODAL_ID),
        $searchForm = $('#' + ESH_CONSTANT.SEARCH_FORM_ID);

    ESHAjax = function(option){
        var settings;

        if(!option){
            return $.Deferred().reject({msg:'出错了！'});
        }

        settings = $.extend({
            type: "POST",
            data:{},
            dataType: "json"
        }, option);

        return $.ajax(settings);
    };

    openModal = function(evt){

        $modal && $modal.fadeIn(100);

        return stopEvent(evt);
    };

    closeModal = function(evt){
        $modal && $modal.fadeOut(100);

        return stopEvent(evt);
    };


    updateFilter = function(){
        var key, i, len = filterKeys.length;

        for(i=0;i<len;i++){
            key = filterKeys[i];
            $('#' + ESH_CONSTANT.NAV_LINK_PREFIX + key).children('.' + ESH_CONSTANT.NAV_LINK_TEXT_CLASS).text(filterData[key].val || filterData[key].defaultVal);
        }
    };

    updateSelectedElement = function(){
        var key, i, len = filterKeys.length;

        for(i=0;i<len;i++){
            key = filterKeys[i];
            if(!filterData[key].tempSelected) {
                continue;
            }

            filterData[key].selected = filterData[key].tempSelected;
            filterData[key].val = filterData[key].selected.find('.' + ESH_CONSTANT.FILTER_KEY_LIST_LINK_CLASS).text();
            filterData[key].tempSelected = null;
        }
    };

    resetSelectedElement = function(){
        var key, i, len = filterKeys.length;

        for(i=0;i<len;i++){
            key = filterKeys[i];
            filterData[key].tempSelected = null;
        }
    };

    createListItem = function(item,option){
        var listItem, listLink;

        option = option || {};
        listItem = document.createElement('li');
        listItem.className = 'esh-list__item';
        listItem.dataset['key'] = option.key;

        listLink = document.createElement('span');
        listLink.className = 'esh-list__link';
        listLink.textContent = item.text;

        listItem.appendChild(listLink);

        return listItem;
    };

    createList = function(list,option){
        var container,item,len,i;

        if(!Array.isArray(list) || !list.length){
            return false;
        }

        len = list.length;

        container = document.createElement('ul');
        container.className = 'esh-list esh-list--magnetic clearfix';

        option.twoColumn && container.classList.add('esh-list--magnetic-two-column');

        for(i = 0; i< len; i++){
            item = list[i];
            container.appendChild(createListItem(item, option));
        }

        return container;
    };

    loadTabPanelContent = function(data){
        var targetId, list;

        if(!data || !data.option || !data.option.targetId) {
            return false;
        }

        targetId = data.option.targetId;
        list = createList(data.listData, data.option);
        list && document.querySelector('#' + targetId).appendChild(list);
    };



    $(function(){

        updateFilter();

        var tabPanelData = [
            {
                listData:[
                    {text:'全部'},
                    {text: '俱乐部'},
                    {text: '赛事方'},
                    {text: '电竞传媒'},
                    {text: '游戏开发'},
                    {text: '游戏运营'},
                    {text: '电竞教育'},
                    {text: '电竞门户'},
                    {text: '电竞协会'},
                    {text: '其他'}
                ],
                option:{
                    targetId: 'esh-tabs-panel-industry',
                    key: 'industry',
                    twoColumn: true
                }
            },
            {
                listData:[
                    {text:'不限'},
                    {text: '3K以下'},
                    {text: '3K-5K'},
                    {text: '5K-10K'},
                    {text: '10K-15K'},
                    {text: '15K-20K'},
                    {text: '20K-25K'},
                    {text: '25K-50K'},
                    {text: '50K以上'}
                ],
                option:{
                    targetId: 'esh-tabs-panel-salary',
                    key: 'salary',
                    twoColumn: true
                }
            },
            {
                listData:[
                    {text:'全部'},
                    {text: '北京'},
                    {text: '上海'},
                    {text: '重庆'},
                    {text: '天津'},
                    {text: '广东'},
                    {text: '浙江'},
                    {text: '江苏'},
                    {text: '四川'},
                    {text: '湖南'},
                    {text: '湖北'},
                    {text: '福建'},
                    {text: '安徽'},
                    {text: '河南'},
                    {text: '河北'},
                    {text: '江西'},
                    {text: '山西'},
                    {text: '陕西'},
                    {text: '吉林'},
                    {text: '甘肃'},
                    {text: '辽宁'},
                    {text: '新疆'}

                ],
                option:{
                    targetId: 'esh-tabs-panel-site',
                    key: 'site'
                }
            },
            {
                listData:[
                    {text:'不限'},
                    {text: '兼职'},
                    {text: '实习'},
                    {text: '全职'}
                ],
                option:{
                    targetId: 'esh-tabs-panel-type',
                    key: 'type'
                }
            },
            {
                listData:[
                    {text:'热度'},
                    {text: '薪水'},
                    {text: '发布时间'}
                ],
                option:{
                    targetId: 'esh-tabs-panel-order',
                    key: 'order',
                    twoColumn: true
                }
            }
        ];

        for(var i = 0; i< tabPanelData.length; i++) {
            loadTabPanelContent(tabPanelData[i]);
        }

        $modal.on('click',function(evt){

            var $target = $(evt.target);

            if($target.attr('id') === ESH_CONSTANT.MODAL_ID) {
                closeModal(evt);
            }
            return stopEvent(evt);
        }).on('click','.' + ESH_CONSTANT.MODAL_BUTTON_CLASS, function(evt){
            var $this = $(this);

            switch($this.data('action').toLowerCase()){
                case ESH_CONSTANT.ACTION_CANCEL:
                    resetSelectedElement();
                    break;
                case ESH_CONSTANT.ACTION_ENTER:
                    updateSelectedElement();
                    updateFilter();
                    break;
                default:
                    break;
            }

            return closeModal(evt);
        });

        $('#' + ESH_CONSTANT.PAGE_SUB_HEADER_ID).on('click', '.esh-js-modal-trigger', function(evt){

            var linkId, tabName, $this = $(this);

            linkId = $this.attr('id');
            tabName = linkId && linkId.replace(ESH_CONSTANT.NAV_LINK_PREFIX, '');

            if(!tabName) {
                return stopEvent(evt);
            }

            $('#' + ESH_CONSTANT.TABS_TAB_PREFIX + tabName).siblings().removeClass('is-active').end().addClass('is-active');
            $('#' + ESH_CONSTANT.TABS_PANEL_PREFIX + tabName).siblings().removeClass('is-active').end().addClass('is-active');

            filterData[tabName].selected && filterData[tabName].selected.addClass('is-active').siblings().removeClass('is-active');
            return  openModal(evt);
        });

        $('#' + ESH_CONSTANT.MODAL_BODY_ID).on('click','.' + ESH_CONSTANT.FILTER_KEY_LIST_ITEM_CLASS, function(evt){
            var key,$this = $(this);

            key = $this.data('key');

            if(!key || !filterData[key]) {
                return stopEvent(evt);
            }

            $this.addClass('is-active').siblings().removeClass('is-active');


            filterData[key].tempSelected = $this;

            return stopEvent(evt);
        });

        $('#' + ESH_CONSTANT.SEARCH_INPUT_ID).attr('placeholder','输入职位进行搜索...').on();

        $('#' + ESH_CONSTANT.PRIMARY_LIST_ID).on('click','.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS, function(evt){
            ESHUtils.loadList({
                listData:[
                    {
                        badge: '上海',
                        salary: '月薪面议',
                        title:'资深媒介',
                        textContent: '上海长贺传媒文化有限公司 ',
                        image: 'http://www.eshunter.com/storage/profiles/2017-11-22-17-23-35-5a15421710991elogo.png',
                        dateTime: '2017-12-05',
                        info: ' 电竞运营'
                    },
                    {
                        badge: '广州',
                        salary: '6k-10k',
                        title:'电竞媒介主管',
                        textContent: '完美世界',
                        image: 'http://www.eshunter.com/storage/profiles/2017-12-27-14-40-32-5a434060832a6elogo.png',
                        dateTime: '2017-12-03',
                        info: ' 电竞传媒'
                    },
                    {
                        badge: '汕头',
                        salary: '4000-无上限 元/月',
                        title:'游戏资料收集员',
                        textContent: '汕头市正心文化传播有限公司 ',
                        image: 'http://www.eshunter.com/storage/profiles/2017-11-30-11-41-14-5a1f7ddacb2deelogo.png',
                        dateTime: '2017-12-01',
                        info: ' 俱乐部'
                    }
                ],
                option: {
                    type: 'job',
                    action: 'append',
                    targetId: ESH_CONSTANT.PRIMARY_LIST_ID,
                    hasLoad: true,
                    callback:function(data){
                        console.log('success!');
                    }
                }

            });
        }).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_CLASS,function(evt){
            var $this = $(this);

            if($this.hasClass(ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_CLASS)) {
                return stopEvent(evt);
            }

            ESHUtils.goPage({url:'jobView.html'});

        });

        $searchForm.on('submit', function(evt){
            var keyword, model;

            keyword = $('#' + ESH_CONSTANT.SEARCH_INPUT_ID).val().trim();

            if(keyword) {
                model = filterData.toModel();
                model['keyword'] = keyword;

                ESHAjax({url:'../../getPrimaryList',data:model}).done(function(data){
                    ESHUtils.loadList({listData: data, option:{targetId:ESH_CONSTANT.PRIMARY_LIST_ID}});
                });
            }

            return stopEvent(evt);
        }).on('click', '.esh-button--icon', function(evt){
            return $searchForm.trigger('submit');
        });

    });
})();