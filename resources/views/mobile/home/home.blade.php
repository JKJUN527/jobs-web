<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('mobile/styles/mdl/material.min.css')}}">
    <link rel="stylesheet" href="{{asset('mobile/styles/default/styles.css')}}">
    <title>首页</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed" id="esh-header">
        <div class="mdl-layout__header-row esh-layout__header-row">
            <span class="mdl-layout__title esh-layout__title" id="esh-headline">电竞猎人</span>
        </div>
    </header>
    <main class="mdl-layout__content" id="esh-content">
        <div class="esh-panel esh-panel--default">
            <div class="esh-tabs esh-tabs--secondary esh-tabs--icon-large">
                <a class="esh-tabs__tab" href="../job/job.html">
                    <i class="material-icons">find_in_page</i>
                    <span class="esh-tabs__text">找工作</span>
                </a>
                <a class="esh-tabs__tab" href="../resume/resume.html">
                    <i class="material-icons">portrait</i>
                    <span class="esh-tabs__text">我的简历</span>
                </a>
                <a class="esh-tabs__tab" href="../my/myApplyRecord.html">
                    <i class="material-icons">comment</i>
                    <span class="esh-tabs__text">申请记录</span>
                </a>
                <a class="esh-tabs__tab" href="../company/company.html">
                    <i class="material-icons">domain</i>
                    <span class="esh-tabs__text">招聘企业</span>
                </a>
            </div>

            <div class="esh-separator__container esh-separator__container--small mdl-color--white">
                <div class="esh-separator esh-separator--line mdl-typography--text-center">
                    <div class="esh-title-text">热门招聘</div>
                </div>
            </div>

            <ul class="mdl-list esh-media-list esh-media-list--text mdl-color--white" id="esh-info-primary-list">
                @foreach($data['position']['position'] as $position)
                <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-list__item--two-line">
                    <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                        <span class="esh-list_item-title"> {{$data['username']['username']}}急聘: {{$position->title}} </span>
                        <span class="mdl-list__item-text-body esh-list__item-text-body">
                    <span class="esh-list__item-secondary-info">
                        @if(empty($position->byname))
                            {{mb_substr($position->ename, 0, 14, 'utf-8')}}
                        @else
                            {{mb_substr($position->byname, 0, 14, 'utf-8')}}
                        @endif
                    </span>
                </span>
                    </div>
                </li>
                @endforeach

                <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-list__item--two-line">
                    <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                        <span class="esh-list_item-title"> 急聘: 游戏运营 </span>
                        <span class="mdl-list__item-text-body esh-list__item-text-body">
                    <span class="esh-list__item-secondary-info">上海快屏网络科技有限公司</span>
                </span>
                    </div>
                </li>

                <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-list__item--two-line">
                    <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                        <span class="esh-list_item-title"> 急聘: 游戏运营 </span>
                        <span class="mdl-list__item-text-body esh-list__item-text-body">
                    <span class="esh-list__item-secondary-info">上海快屏网络科技有限公司</span>
                </span>
                    </div>
                </li>

                <li class="esh-list__item esh-list__item-load">
                    <span class="esh-list__item-load-text">更多职位&nbsp;&gt;&gt;</span>
                </li>
            </ul>
        </div>
    </main>
    <footer class="esh-tabs-container" id="esh-footer">
        <div class="esh-tabs" id="esh-tabs">
            <a class="esh-tabs__tab is-active" id="esh-tab-home" href="/m/index">
                <i class="material-icons">home</i>
                <span class="esh-tabs__text">首页</span>
            </a>
            <a class="esh-tabs__tab" id="esh-tab-job" href="/m/position/advanceSearch">
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
</div>

<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
{{--<script src="{{asset('mobile/js/utils/utils.js')}}"></script>--}}
<script src="{{asset('mobile/js/home/home.js')}}"></script>
</body>
</html>