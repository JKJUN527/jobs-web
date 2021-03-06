<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('mobile/styles/mdl/material.min.css')}}">
    <link rel="stylesheet" href="{{asset('mobile/styles/default/styles.css')}}">
    <title>首页</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed" id="esh-layout-header">
        <div class="mdl-layout__header-row esh-layout__header-row">
            <span class="mdl-layout__title esh-layout__title" id="esh-headline">电竞猎人</span>
        </div>
    </header>
    <div class="esh-layout__sub-header" id="esh-layout-sub-header">
        <div class="mdl-layout__header-row esh-layout__header-row esh-height--auto">
            <form class="mdl-textfield mdl-js-textfield esh-textfield--search" id="esh-search-form">
                <button class="mdl-button mdl-button--icon esh-button--icon">
                    <i class="material-icons">search</i>
                </button>
                <input class="mdl-textfield__input esh-textfield__input" type="search" id="esh-search-input">
            </form>
            <button class="mdl-button mdl-button--icon esh-button--sort esh-js-modal-trigger" id="esh-nav-link-order">
                <i class="material-icons">sort</i>
            </button>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-height--auto">
            <div class="mdl-navigation esh-navigation">
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-industry" href="#">
                    <span class="esh-navigation__text">link</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-type" href="#">
                    <span class="esh-navigation__text">link</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-salary" href="#">
                    <span class="esh-navigation__text">link</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-site" href="#">
                    <span class="esh-navigation__text">link</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
            </div>
        </div>
    </div>
    <main class="mdl-layout__content" id="esh-layout-content">
        <ul class="mdl-list esh-media-list" id="esh-primary-list">
            <li class="mdl-list__item mdl-list__item--three-line esh-list__item">
                <img class="esh-list__item-image" src="http://eshunter.com/storage/profiles/2017-10-18-01-22-51-59e6acebb5f2belogo.png">
                <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                    <span class="esh-list_item-title">市场总监</span>
                    <span class="mdl-list__item-text-body esh-list__item-text-body">
                        <span class="esh-list__item-secondary-info esh-list__item-badge">游戏运营</span>
                        <span class="esh-list__item-secondary-info">上海</span>
                        <span class="esh-list__item-text">浙江文鑫阳信息科技有限公司</span>
                    </span>
                </div>
                <div class="mdl-list__item-secondary-content esh-list__item-secondary-content">
                    <span class="mdl-list__item-secondary-info">9k-20k</span>
                    <span class="mdl-list__item-secondary-info">2017-12-18</span>
                </div>
            </li>
            <li class="esh-list__item esh-list__item-load" data-action="load-more" id="esh-list-load">
                <span class="esh-list__item-load-text" id="esh-primary-list-load-text">加载更多</span>
            </li>
        </ul>


    </main>
    <footer class="esh-tabs-container" id="esh-layout-footer">
        <div class="esh-tabs" id="esh-tabs">
            <a class="esh-tabs__tab" id="esh-tab-home">
                <i class="material-icons">home</i>
                <span class="esh-tabs__text">首页</span>
            </a>
            <a class="esh-tabs__tab is-active" id="esh-tab-job">
                <i class="material-icons">view_list</i>
                <span class="esh-tabs__text">职位</span>
            </a>
            <a class="esh-tabs__tab" id="esh-tab-information">
                <i class="material-icons">sms</i>
                <span class="esh-tabs__text">资讯</span>
            </a>
            <a class="esh-tabs__tab" id="esh-tab-my">
                <i class="material-icons">person</i>
                <span class="esh-tabs__text">我的</span>
            </a>
        </div>
    </footer>
    <div class="esh-modal__mask" id="esh-modal-filter">
        <div class="esh-modal__container">
            <div class="esh-modal__body" id="esh-modal-body">
                <div class="mdl-tabs esh-tabs--vertical mdl-js-tabs">
                    <div class="mdl-tabs__tab-bar esh-tabs__tab-bar">
                        <a id="esh-tabs-tab-industry" href="#esh-tabs-panel-industry" class="mdl-tabs__tab esh-tabs__tab is-active">行业</a>
                        <a id="esh-tabs-tab-type" href="#esh-tabs-panel-type" class="mdl-tabs__tab esh-tabs__tab">类型</a>
                        <a id="esh-tabs-tab-salary" href="#esh-tabs-panel-salary" class="mdl-tabs__tab esh-tabs__tab">薪资</a>
                        <a id="esh-tabs-tab-site" href="#esh-tabs-panel-site" class="mdl-tabs__tab esh-tabs__tab">省份</a>
                        <a id="esh-tabs-tab-order" href="#esh-tabs-panel-order" class="mdl-tabs__tab esh-tabs__tab">排序</a>
                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-industry"></div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-type"></div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-salary"></div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-site"></div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-order"></div>
                </div>
            </div>
            <div class="esh-modal__footer">
                <button class="mdl-button mdl-js-button mdl-button--primary esh-button--primary" data-action="enter">确定</button>
                <button class="mdl-button mdl-js-button esh-button--secondary" data-action="cancel">取消</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script src="{{asset('mobile/js/job/job.js')}}"></script>
</body>
</html>