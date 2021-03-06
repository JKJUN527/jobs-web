@extends('layout.master')
@section('title', '职位搜索')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .position-search--card {
            width: 100%;
            min-height: 0;
        }

        ul {
            margin-bottom: 0;
        }

        .position-search--card ul li {
            display: block;
            padding: 10px 16px;
            margin: 0;
            vertical-align: middle;
            border-bottom: 1px solid #f5f5f5;
        }

        ul.filter-panel li label {
            padding-right: 16px;
            vertical-align: top;
        }

        ul.filter-panel .span-holder {
            display: inline-block;
            width: 900px;
        }
        .span-holder-region{
            display: inline-block;
            width: 900px;
        }

        ul.filter-panel li span.selected {
            background-color: #03A9F4;
            color: #ffffff;
        }

        ul.filter-panel li span {
            padding: 4px 6px;
            cursor: pointer;
            word-break: keep-all;
            margin: 0 4px;
        }

        .search-position {
            background-color: #f5f5f5;
            margin-bottom: 0;
            margin-top: 16px;
        }

        .search-position .form-line {
            width: 250px;
            display: inline-block;
            border-bottom: 1px solid #ebebeb;
            margin-right: 24px;
        }

        .search-position .form-line input {
            display: inline-block;
            width: 200px;
            background-color: #f5f5f5;
        }

        .search-position .sort-position {
            width: 400px;
            margin-bottom: 0;
            display: inline-block;
            vertical-align: middle;
        }

        .sort-position span.sort-item {
            margin: 0 8px;
            cursor: pointer;
        }

        .sort-position span.sort-item:hover {
            text-decoration: underline;
        }

        .sort-position span:first-child {
            margin-right: 16px;
        }

        .sort-item.active {
            color: #1976D2;
        }

        .sort-item i {
            vertical-align: middle;
        }

        .position-card {
            width: 318px;
            min-height: 0;
            max-height: 200px;
            margin: 0 4px 24px 4px;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            text-align: left;
            vertical-align: top;
        }

        .position-card .mdl-card__title {
            padding-bottom: 0;
        }

        .position-card .mdl-card__supporting-text {
            width: 100%;
            margin: 0;
        }

        .position-card:hover {
            cursor: pointer;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .position-desc {
            /*min-height: 68px;*/
        }

        .resume-list {
            width: 100%;
            display: block;
        }

        .resume-item {
            border: 1px solid #ebebeb;
            display: block;
            padding: 8px 16px;
            margin-bottom: 16px;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .resume-item:hover {
            background-color: #03A9F4;
            color: #ffffff;
        }

        .resume-item p {
            margin: 0;
        }

        .region-province-holder span {
            display: inline-block;
        }
        .region-city-holder span {
            display: inline-block;
        }
        .region-holder{
            line-height:17px;
        }
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 3,'type' =>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="form-group search-position">
                <div class="form-line">
                    <input type="text" id="name" name="name" class="form-control"
                           value="@if(isset($data['result']['keyword'])){{$data['result']['keyword']}}@endif"
                           placeholder="输入职位名称／描述进行搜索">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="publish-position"
                            onclick="goSearch()">
                        <i class="material-icons">search</i>
                    </button>
                </div>

                <p class="sort-position">
                    <span><b>排序</b>:</span>

                    @if(!isset($data['result']['orderBy']))
                        <span class="sort-item" data-content="0" id="sort-hotness">热度<i class="material-icons"></i></span>
                        <span class="sort-item" data-content="0" id="sort-salary">薪水<i
                                    class="material-icons"></i></span>
                        <span class="sort-item active" data-content="1" id="sort-publish--time">发布时间<i
                                    class="material-icons">keyboard_arrow_down</i></span>
                    @elseif($data['result']['orderBy'] == 0)
                        @if($data['result']['desc'] == 1)
                            <span class="sort-item active" data-content="1" id="sort-hotness">热度<i
                                        class="material-icons">keyboard_arrow_down</i></span>
                        @else
                            <span class="sort-item active" data-content="2" id="sort-hotness">热度<i
                                        class="material-icons">keyboard_arrow_up</i></span>
                        @endif
                        <span class="sort-item" data-content="0" id="sort-salary">薪水<i
                                    class="material-icons"></i></span>
                        <span class="sort-item" data-content="0" id="sort-publish--time">发布时间<i
                                    class="material-icons"></i></span>
                    @elseif($data['result']['orderBy'] == 1)
                        <span class="sort-item" data-content="0" id="sort-hotness">热度<i
                                    class="material-icons"></i></span>
                        @if($data['result']['desc'] == 1)
                            <span class="sort-item active" data-content="1" id="sort-salary">薪水<i
                                        class="material-icons">keyboard_arrow_down</i></span>
                        @else
                            <span class="sort-item active" data-content="2" id="sort-salary">薪水<i
                                        class="material-icons">keyboard_arrow_up</i></span>
                        @endif
                        <span class="sort-item" data-content="0" id="sort-publish--time">发布时间<i
                                    class="material-icons"></i></span>
                    @elseif($data['result']['orderBy'] == 2)
                        <span class="sort-item" data-content="0" id="sort-hotness">热度<i
                                    class="material-icons"></i></span>
                        <span class="sort-item" data-content="0" id="sort-salary">薪水<i
                                    class="material-icons"></i></span>

                        @if($data['result']['desc'] == 1)
                            <span class="sort-item active" data-content="1" id="sort-publish--time">发布时间<i
                                        class="material-icons">keyboard_arrow_down</i></span>
                        @else
                            <span class="sort-item active" data-content="2" id="sort-publish--time">发布时间<i
                                        class="material-icons">keyboard_arrow_up</i></span>
                        @endif
                    @endif
                </p>
            </div>

            <div class="position-search--card mdl-card" style="margin-bottom: 24px;">
                <form method="get" id="search-form">
                    <input type="hidden" name="industry">
                    <input type="hidden" name="region-pro">
                    <input type="hidden" name="region-city">
                    <input type="hidden" name="salary">
                    <input type="hidden" name="work_nature">
                    <input type="hidden" name="keyword">
                    <input type="hidden" name="orderBy">
                    <input type="hidden" name="desc">
                </form>

                <ul class="filter-panel">
                    <li>
                        <label>行业:</label>
                        <div class="span-holder industry-holder">
                            <span @if(!isset($data['result']['industry']))class="selected"
                                  @endif data-content="-1">全部</span>
                            @foreach($data['industry'] as $industry)
                                <span data-content="{{$industry->id}}"
                                      @if(isset($data['result']['industry']) && $data['result']['industry'] == $industry->id)
                                      class="selected"
                                        @endif
                                >{{$industry->name}}</span>
                            @endforeach
                        </div>
                    </li>

                    <li>
                        <label>省份:</label>
                        <div class="span-holder-region region-province-holder">
                            <span @if(!isset($data['result']['region-pro']))class="selected"
                                  @endif data-content="-1">全部</span>
                            @foreach($data['region-pro'] as $province)
                                <span data-content="{{$province->id}}"
                                      @if(isset($data['result']['region-pro']) && $data['result']['region-pro'] == $province->id)
                                      class="selected"
                                        @endif
                                >{{$province->name}}</span>
                            @endforeach
                        </div>
                    </li>
                    @foreach($data['region-pro'] as $province)
                    <li id="city{{$province->id}}" name="cityid"
                        @if(isset($data['result']['region-pro']) &&$data['result']['region-pro']==$province->id)
                            style="display: block">
                        @else
                            style="display: none">
                        @endif
                        <label>城市:</label>
                        <div class="span-holder-region region-city{{$province->id}}-holder">
                            <span @if(!isset($data['result']['region-city']))class="selected"
                                  @endif data-content="-1">全部</span>
                            @foreach($data['region-city'] as $city)
                                @if($province->id == $city->parent_id)
                                <span data-content="{{$city->id}}"
                                      @if(isset($data['result']['region-city']) && $data['result']['region-city'] == $city->id)
                                      class="selected"
                                        @endif
                                >{{$city->name}}</span>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    @endforeach

                    <li>
                        <label>薪酬:</label>
                        <div class="span-holder salary-holder">

                            @if(!isset($data['result']['salary']))
                                <span class="selected" data-content="-1">不限</span>
                                <span data-content="1">3K以下</span>
                                <span data-content="2">3K-5K</span>
                                <span data-content="3">5K-10K</span>
                                <span data-content="4">10K-15K</span>
                                <span data-content="5">15K-20K</span>
                                <span data-content="6">20K-25K</span>
                                <span data-content="7">25K-50K</span>
                                <span data-content="8">50K以上</span>
                            @else
                                <span data-content="-1">不限</span>
                                <span @if($data['result']['salary'] == 1) class="selected"
                                      @endif data-content="1">3K以下</span>
                                <span @if($data['result']['salary'] == 2) class="selected"
                                      @endif data-content="2">3K-5K</span>
                                <span @if($data['result']['salary'] == 3) class="selected" @endif data-content="3">5K-10K</span>
                                <span @if($data['result']['salary'] == 4) class="selected" @endif data-content="4">10K-15K</span>
                                <span @if($data['result']['salary'] == 5) class="selected" @endif data-content="5">15K-20K</span>
                                <span @if($data['result']['salary'] == 6) class="selected" @endif data-content="6">20K-25K</span>
                                <span @if($data['result']['salary'] == 7) class="selected" @endif data-content="7">25K-50K</span>
                                <span @if($data['result']['salary'] == 8) class="selected"
                                      @endif data-content="8">50K以上</span>
                            @endif
                        </div>
                    </li>

                    <li>
                        <label>类型:</label>
                        <div class="span-holder type-holder">
                            @if(!isset($data['result']['work_nature']))
                                <span class="selected" data-content="-1">不限</span>
                                <span data-content="0">兼职</span>
                                <span data-content="1">实习</span>
                                <span data-content="2">全职</span>
                            @else
                                <span data-content="-1">不限</span>
                                <span @if($data['result']['work_nature'] == 0) class="selected" @endif data-content="0">兼职</span>
                                <span @if($data['result']['work_nature'] == 1) class="selected" @endif data-content="1">实习</span>
                                <span @if($data['result']['work_nature'] == 2) class="selected" @endif data-content="2">全职</span>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>

            <p id="search-result--count">共搜索到{!!$data['result']['position']->total()!!}个结果</p>

            <div class="search-result">

                @foreach($data['result']['position'] as $position)
                    <div class="mdl-card mdl-shadow--2dp info-card position-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text" style="margin-top: 0rem;"><b>
                                @if(empty($position->title))
                                    没有填写职位名称
                                @else
                                    {{mb_substr($position->title, 0, 15, 'utf-8')}}
                                @endif
                                </b></h5>
                        </div>
                        <div class="mdl-card__title">
                            <h6 class="mdl-card__title-text">
                                @if(empty($position->byname) && empty($position->ename))
                                        未知企业
                                @elseif(!empty($position->byname))
                                    {{$position->byname}}
                                @elseif(!empty($position->ename))
                                    {{$position->ename}}
                                @endif
                            </h6>
                        </div>
                        <div class="mdl-card__supporting-text position-desc">
                            {{--<b>介绍: </b>--}}
                            {{--<span>--}}
                                {{--@if(empty($position->pdescribe))--}}
                                    {{--没有填写职位描述--}}
                                {{--@else--}}

                                    {{--{{str_replace(array('</br>','</br','</b>','</b'),"",mb_substr($position->pdescribe, 0, 40, 'utf-8'))}}--}}
                                {{--@endif--}}
                            {{--</span>--}}
                            <b>工作地区：</b><span>{{$position->name}}</span>&nbsp&nbsp
                            <b>薪资：</b><span>
                                @if($position->salary <= 0)
                                    月薪面议
                                @else
                                    {{$position->salary}}-
                                    @if($position->salary_max ==0) 无上限
                                    @else {{$position->salary_max}}
                                    @endif
                                    元/月
                                @endif
                            </span>
                        </div>

                        <div class="mdl-card__actions mdl-card--border">
                            <div class="button-panel">
                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link position-view"
                                        onclick="detail({{$position->pid}})">
                                    查看详情
                                </button>
                                @if($data['type']==0)
                                    <button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky" to="/account/login">
                                        投简历
                                    </button>
                                @elseif($position->position_status==1 ||$position->position_status==4)
                                    <button data-toggle="modal" data-target="#chooseResumeModal"
                                            data-content="{{$position->pid}}"
                                            class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                        投简历
                                    </button>
                                @else
                                    <button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                        无法投递
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div style="clear:both;"></div>

                <nav>
                    {!! $data['result']['position']->appends($data['condition'])->render() !!}
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Dialogs ====================================================================================================================== -->
    <!-- Default Size -->
    <div class="modal fade" id="chooseResumeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">选择简历</h4>
                </div>

                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">

        var sortHotness = $("#sort-hotness");
        var sortSalary = $("#sort-salary");
        var sortTime = $("#sort-publish--time");

        function resetSort() {
            sortHotness.attr('data-content', 0);
            sortSalary.attr('data-content', 0);
            sortTime.attr('data-content', 0);

            sortHotness.find("i").html("");
            sortSalary.find("i").html("");
            sortTime.find("i").html("");

            sortHotness.removeClass("active");
            sortSalary.removeClass("active");
            sortTime.removeClass("active");
        }


        $(".sort-item").click(function () {

            if ($(this).attr('data-content') === '0') {
                resetSort();
                $(this).attr('data-content', 1);
                $(this).find('i').html("keyboard_arrow_down");
                if (!$(this).hasClass('active'))
                    $(this).addClass('active');
            } else if ($(this).attr('data-content') === '1') {
                resetSort();
                $(this).attr('data-content', 2);
                $(this).find('i').html("keyboard_arrow_up");
                if (!$(this).hasClass('active'))
                    $(this).addClass('active');
            } else if ($(this).attr('data-content') === '2') {
                resetSort();
                $(this).attr('data-content', 1);
                $(this).find('i').html("keyboard_arrow_down");
                if (!$(this).hasClass('active'))
                    $(this).addClass('active');
            }

            goSearch();
        });

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $(".span-holder").find("span").click(function () {
            var clickedElement = $(this);
            clickedElement.addClass("selected");
            clickedElement.siblings().removeClass("selected");

            goSearch();
        });

        $(".span-holder-region").find("span").click(function () {
            var clickedElement = $(this);
            clickedElement.addClass("selected");
            clickedElement.siblings().removeClass("selected");
            var cityid = "city"+$(".region-province-holder").find("span.selected").attr("data-content")
            $("li[name='cityid']").css('display','none');
            $("#"+cityid).css('display','block');
            goSearch();
        });

        function goSearch() {
            var industry = $(".industry-holder").find("span.selected").attr("data-content");
            var region_pro = $(".region-province-holder").find("span.selected").attr("data-content");
            var cityid = "region-city"+region_pro+"-holder";
            var region_city = $("."+cityid).find("span.selected").attr("data-content");
            var salary = $(".salary-holder").find("span.selected").attr("data-content");
            var type = $(".type-holder").find("span.selected").attr("data-content");
            var search = $("input[name='name']").val();

//            console.log(type);
//            return;

            if (industry !== "-1")
                $("input[name='industry']").val(industry);
            if (region_pro !== "-1")
                $("input[name='region-pro']").val(region_pro);
            if (region_city !== "-1")
                $("input[name='region-city']").val(region_city);
            if (salary !== "-1")
                $("input[name='salary']").val(salary);
            if (type !== "-1")
                $("input[name='work_nature']").val(type);
            if (search !== "")
                $("input[name='keyword']").val(search);

            if (sortHotness.attr('data-content') !== '0') {
                $("input[name='orderBy']").val(0);
                $("input[name='desc']").val(sortHotness.attr("data-content"));
            }

            if (sortSalary.attr('data-content') !== '0') {
                $("input[name='orderBy']").val(1);
                $("input[name='desc']").val(sortSalary.attr("data-content"));
            }

            if (sortTime.attr('data-content') !== '0') {
                $("input[name='orderBy']").val(2);
                $("input[name='desc']").val(sortTime.attr("data-content"));
            }

            var $searchForm = $("#search-form");
            $searchForm.action = '/position/advanceSearch';
            $searchForm.submit();
        }

        function detail(pid) {
//            self.location = '/position/detail?pid=' + pid;
            var openurl = "/position/detail?pid=" + pid;
            window.open(openurl);
        }

        $(".deliver-resume").click(function () {

            var $pid = $(this).attr("data-content");

            $.ajax({
                url: "/resume/getResumeList",
                type: "get",
                success: function (data) {

                    var html = "<ul class='resume-list'>";
                    if (data.length === 0) {
                        html = "<button onclick='addResume()' " +
                            "class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky'>" +
                            "没有简历，点击添加 </button>"
                    } else {
                        for (var item in data) {

                            var resumeName = data[item]['resume_name'] === null ? "未命名的简历" : data[item]['resume_name'];
                            html += "<li class='resume-item' data-content='" + data[item]['rid'] + "' onclick='resumeChosen(this, " + $pid + ")'>" +
                                "<p>" + resumeName + "</p>" +
                                "</li>";
                        }

                        html += "</ul>";
                    }

                    $(".modal-body").html(html);
                }
            })
        });

        function resumeChosen(element, pid) {
            $("#chooseResumeModal").modal('hide');

            var rid = $(element).attr("data-content");

            var formData = new FormData();
            formData.append('rid', rid);
            formData.append('pid', pid);

            $.ajax({
                url: "/delivered/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    //console.log(data);
                    var result = JSON.parse(data);
                    checkResult(result.status, "简历投递成功", result.msg, null);
                }
            })

        }

        function addResume() {
            $.ajax({
                url: "/resume/addResume",
                type: "get",
                success: function (data) {
                    if (data['status'] === 200) {
                        self.location = "/resume/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
                        alert(data['msg']);
                    }
                }
            });
        }
    </script>
@endsection
