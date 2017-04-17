@extends('layout.default')
@section('content')
    <div id="subject">
        <div id="main">
            <div class="login">
                <form action="" method="" class="login_form">
                    <input type='hidden' name='_token' value="{{csrf_token()}}">
                    <input type='hidden' name='url' value="{{$url}}">
                    <input type='hidden' name='invite_user' value="{{$invite_user}}">
                    <div class="login_div">
                        <div class="login_banner"><img src="{{$bannerUrl}}" alt=""/></div>
                    </div>
                    <div class="login_div">
                        <div style="border-bottom:1px solid #f6f6f6;">
                            <ul class="mde_list" style="padding:0 41px;font-size:18px;margin-bottom:0px;background:url(../images/look/address_bg.png) 18px center no-repeat;"><li>
                            <div class="mde_list_title" style="font-size:18px;">所在城市</div>
                            <div class="mde_list_input">
                                <ul id="mde_input_city">
                                    @if(!empty($area))
                                        @foreach($area as $parent)
                                            <li data-area-id="{{$parent['area_id']}}">
                                                <span>{{$parent['area_name']}}</span>
                                                @if(!empty($parent['children']))
                                                    <ul>
                                                        @foreach($parent['children'] as $child)
                                                            <li data-area-id="{{$child['area_id']}}">
                                                                <span>{{$child['area_name']}}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <input type="hidden" name="province" value="{{$userInfo['province']}}">
                                <input type="hidden" name="city" value="{{$userInfo['city']}}">
                            </div>
                            </li></ul>
                        </div>
                        <div class="login_div_input"><input type="text" placeholder="输入手机号" name="login_phone"
                                                            class="login_phone"></div>
                        <div class="login_div_input">
                            <input type="text" placeholder="验证码" name="login_code" class="login_code">
                            <div class="login_code1">获取验证码</div>
                            <div class="login_code2">获取验证码（5）</div>
                        </div>
                        <div class="login_div_input" style="font-size:14px;margin-left:70px;line-height: 44px;">
                        <input type="checkbox" style="width:15px;height:15px;margin:0px;padding:0px; padding-top:2px;" checked="checked" class="chkclass" />阅读并接受<a style="font-size:14px;color:#999" href="{{route('article',['id'=>1])}}">《和润万青服务协议》</a>
                        </div>
                    </div>
                    <div class="login_div_button"><input type="submit" value="确定" class="login_button"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link rel="stylesheet" href="/js/cropper/cropper.min.css">

    <link href="/css/Mobiscroll/mobiscroll.animation.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.icons.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.android.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.android-holo.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.ios-classic.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.ios.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.jqm.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.sense-ui.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.frame.wp.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.android.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.android-holo.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.ios-classic.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.ios.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.jqm.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.sense-ui.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.scroller.wp.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.image.css" rel="stylesheet" type="text/css"/>

    <link href="/css/Mobiscroll/mobiscroll.android-holo-light.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.wp-light.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Mobiscroll/mobiscroll.mobiscroll-dark.css" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
    <script src="/js/Mobiscroll/mobiscroll.zepto.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.core.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.scroller.js"></script>

    <script src="/js/Mobiscroll/mobiscroll.util.datetime.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.datetimebase.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.datetime.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.select.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.listbase.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.image.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.treelist.js"></script>

    <script src="/js/Mobiscroll/mobiscroll.frame.android.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.android-holo.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.ios-classic.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.ios.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.jqm.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.sense-ui.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.frame.wp.js"></script>

    <script src="/js/Mobiscroll/mobiscroll.android-holo-light.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.wp-light.js"></script>
    <script src="/js/Mobiscroll/mobiscroll.mobiscroll-dark.js"></script>

    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.cs.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.de.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.en-UK.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.es.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.fa.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.fr.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.hu.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.it.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.ja.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.nl.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.no.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.pl.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.pt-BR.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.pt-PT.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.ro.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.ru.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.ru-UA.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.sk.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.sv.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.tr.js"></script>
    <script src="/js/Mobiscroll/i18n/mobiscroll.i18n.zh.js"></script>
    <script language="JavaScript">
        $(document).ready(function () {
            var province_id = $('input[name="province"]').val();
            var city_id = $('input[name="city"]').val();

            var defaultValue = [$('li[data-area-id="'+province_id+'"]').index(), $('li[data-area-id="'+city_id+'"]').index()];

            $('#mde_input_city').mobiscroll().treelist({//调用Mobiscroll
                theme: "android-holo",
                mode: "scroller",
                display: "bottom",
                lang: "zh",
                placeholder: "请选择所在城市",
                labels: ['省', '市'],
                formatResult: function (array) { //返回自定义格式结果
                    $('input[name="province"]').val('');
                    $('input[name="city"]').val('');
                    var res = '';
                    if(array[0] != null&&array[0] != -1) {
                        var province = $('#mde_input_city>li').eq(array[0]);
                        res += province.children('span').html();
                        $('input[name="province"]').val(province.data('area-id'));
                        if(array[1] != null) {
                            var city = province.children('ul').children('li').eq(array[1]);
                            res += city.children('span').html();
                            $('input[name="city"]').val(city.data('area-id'));
                            if(array[2]!=null) {
                                var district = city.children('ul').children('li').eq(array[2]);
                                res += district.children('span').html();
                                $('input[name="district"]').val(district.data('area-id'));
                            }
                        }
                    }
                    return res;
                },
                defaultValue: defaultValue,
                onInit: function (inst) {
                    //需要输出编辑前的地址
                    var res = '';
                    var province_id = $('input[name="province"]').val();
                    if($('li[data-area-id="'+province_id+'"]').length)
                        res += $('li[data-area-id="'+province_id+'"]').find('span').html();
                    var city_id = $('input[name="city"]').val();
                    if($('li[data-area-id="'+city_id+'"]').length)
                        res += $('li[data-area-id="'+city_id+'"]').find('span').html();
                    var district_id = $('input[name="district"]').val();
                    if($('li[data-area-id="'+district_id+'"]').length)
                        res += $('li[data-area-id="'+district_id+'"]').find('span').html();
                    $("#mde_input_city_dummy").val(res);
                }
            });



            var lockc = false;
            $(".login_code1").click(function () {//获取验证码
                if (lockc) {
                    return;
                }
                var mobile = $('input[name="login_phone"]').val();
                if (!mobile.match(/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$/)) {
                    Popup.init({
                        popHtml: '<p>请先输入正确的手机号码</p>',
                        popFlash: {
                            flashSwitch: true,
                            flashTime: 2000,
                            flashfunction: function () {
                            }
                        }
                    });
                    return false;
                }
                /*-----ajax事件开始-----*/
                lockc = true;
                var form_data = $('form').serialize();
                $.post("{{route('user.get_code')}}", form_data, function (data) {
                    if (data.status) {
                        Popup.init({
                            popHtml: '<p>' + data.msg + '</p>',
                            popFlash: {
                                flashSwitch: true,
                                flashTime: 2000,
                            }
                        });
                        lockc = false;
                        chronography(60);
                    } else {
                        if (typeof data.msg == "string") {
                            Popup.init({
                                popHtml: '<p>' + data.msg + '</p>',
                                popFlash: {
                                    flashSwitch: true,
                                    flashTime: 2000,
                                }
                            });
                        } else {
                            for (i in data.msg) {
                                Popup.init({
                                    popHtml: '<p>' + data.msg[i] + '</p>',
                                    popFlash: {
                                        flashSwitch: true,
                                        flashTime: 2000,
                                    }
                                });
                            }
                        }
                        ;
                        lockc = false;
                        chronography(0);
                    }
                }, 'json');
                return false;
                /*-----ajax事件结束-----*/
            });
            var lock = false;
            $(".login_button").click(function () {
                if (lock) {
                    return;
                }
                var mobile = $('input[name="login_phone"]').val();
                var code = $('input[name="login_code"]').val();
                var province = $('input[name="province"]').val();
                var city = $('input[name="city"]').val();
                //判断是否已经阅读服务协议
                if($(".chkclass").is(':checked')==false){
                	Popup.init({
                        popHtml: '<p>请选择已阅读并接受和润万青服务协议</p>',
                        popFlash: {
                            flashSwitch: true,
                            flashTime: 2000,
                            flashfunction: function () {
                            }
                        }
                    });
                    return false;
                }
                if (province == ""||city == "") {
                    Popup.init({
                        popHtml: '<p>请选择所在城市</p>',
                        popFlash: {
                            flashSwitch: true,
                            flashTime: 2000,
                            flashfunction: function () {
                            }
                        }
                    });
                    return false;
                }
                if (!mobile.match(/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$/)) {
                    Popup.init({
                        popHtml: '<p>请输入正确的手机号码</p>',
                        popFlash: {
                            flashSwitch: true,
                            flashTime: 2000,
                            flashfunction: function () {
                            }
                        }
                    });
                    return false;
                }
                if (code == "") {
                    Popup.init({
                        popHtml: '<p>请输入验证码</p>',
                        popFlash: {
                            flashSwitch: true,
                            flashTime: 2000,
                            flashfunction: function () {
                            }
                        }
                    });
                    return false;
                }
                var form_data = $('form').serialize();
                lock = true;
                /*-----ajax事件开始-----*/
                $.post("{{route('user.do_login')}}", form_data, function (data) {
                    if (data.status) {
                        Popup.init({
                            popHtml: '<p>' + data.msg + '</p>',
                            popFlash: {
                                flashSwitch: true,
                                flashTime: 2000,
                            }
                        });
                        if (data.url) {
                            location.href = '{{ url($url) }}';
                        } else {
                            location.href = '{{ url("/") }}';
                        }
                    } else {
                        Popup.init({
                            popHtml: '<p>' + data.msg + '</p>',
                            popFlash: {
                                flashSwitch: true,
                                flashTime: 2000,
                            }
                        });
                        lock = false;
                    }
                }, 'json')
                        .fail(function (jqXHR) {
                            if (jqXHR.status == 422) {
                                var str = '';
                                $.each($.parseJSON(jqXHR.responseText), function (key, value) {
                                    str += value + '<br>';
                                });
                                Popup.init({
                                    popHtml: '<p>' + str + '</p>',
                                    popFlash: {
                                        flashSwitch: true,
                                        flashTime: 2000,
                                    }
                                });
                                lock = false;
                            }
                        });
                /*-----ajax事件结束-----*/
                return false;
            });
        });
        function chronography(value) {//验证码倒计时
            if (value == 0) {
                $('.login_code1').css("display", "block");
                $('.login_code2').css("display", "none");
            } else {
                $('.login_code2').css("display", "block");
                $('.login_code1').css("display", "none");
                value--;
                $('.login_code2').html("获取验证码(" + value + ")");
                setTimeout("chronography(" + value + ")", 1000);
            }
        }
    </script>
@endsection
