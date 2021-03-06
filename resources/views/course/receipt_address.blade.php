@extends('layout.default')
@section('content')

<div id="subject">
    <div id="main">
        <div class="address_choice">
            <div class="address_choice_div1">
                <!-- 收货地址列表 -->
                <ul class="address_choice_list">
                    
                </ul>
                <div class="address_choice_list_button">添加地址</div>
            </div>
            <div class="address_choice_div2" style="display:none;">
                <form class="address_choice_form">
                    <input type="hidden" class="acf_id" name="acf_id" value="">
                    <div class="address_choice_form_div">
                        <span>收货人</span><input type="text" value="" name="acf_name" class="acf_name">
                    </div>
                    <div class="address_choice_form_div">
                        <span>电话</span><input type="text" value="" name="acf_phone" class="acf_phone">
                    </div>
                    <div class="address_choice_form_div">
                        <span>选择地区</span>
                        <ul id="linkage">
                            @if(!empty($area))
                                @foreach($area as $parent)
                                    <li data-area-id="{{$parent['area_id']}}">
                                        <span>{{$parent['area_name']}}</span>
                                        @if(!empty($parent['children']))
                                            <ul>
                                                @foreach($parent['children'] as $child)
                                                    <li data-area-id="{{$child['area_id']}}">
                                                        <span>{{$child['area_name']}}</span>
                                                        @if(!empty($child['children']))
                                                            <ul>
                                                                @foreach($child['children'] as $grandchild)
                                                                    <li data-area-id="{{$grandchild['area_id']}}">
                                                                        <span>{{$grandchild['area_name']}}</span>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="address_choice_form_div">
                        <span>详细地址</span><input type="text" value="" name="acf_address" class="acf_address">
                    </div>
                </form>
                    <div class="address_choice_form_button">提交</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!--Mobiscroll插件调用文件开始-->
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

    <link href="/css/Mobiscroll/mobiscroll.animation.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.icons.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.android.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.android-holo.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.ios-classic.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.ios.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.jqm.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.sense-ui.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.frame.wp.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.android.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.android-holo.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.ios-classic.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.ios.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.jqm.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.sense-ui.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.scroller.wp.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.image.css" rel="stylesheet" type="text/css" />

    <link href="/css/Mobiscroll/mobiscroll.android-holo-light.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.wp-light.css" rel="stylesheet" type="text/css" />
    <link href="/css/Mobiscroll/mobiscroll.mobiscroll-dark.css" rel="stylesheet" type="text/css" />
<!--Mobiscroll插件调用文件结束-->

    <script type="text/javascript">
    $(document).ready(function(){
        var addresses=<?php echo $user_receipt_address; ?>;
        // 没有收货地址时为新增
        if (addresses.length<1) {
            $(".address_choice_div1").hide();
            $(".address_choice_div2").show();
            $(".address_choice_div2 input").val("");   
        }
        output();
        function output(){//输出收货地址列表
            var html="";
            for(var i=0;i<addresses.length;i++){
                var html_default="";
                var html_default2="";
                if(addresses[i].default==true){
                    html_default='<div class="address_choice_list_default">默认地址</div>';
                }else{
                    html_default2='<div class="address_choice_default" data-id="'+addresses[i].id+'">设为默认地址</div>';
                }
                html+='<li data-id="'+addresses[i].id+'">\
                        '+html_default+'\
                        <div class="address_choice_button" data-id="0" data-addressid="'+addresses[i].id+'">\
                            <p>收货人：'+addresses[i].name+'</p>\
                            <p>手机：'+addresses[i].phone+'</p>\
                            <p>收货地址：'+addresses[i].region+addresses[i].address+'</p>\
                        </div>\
                        '+html_default2+'\
                        <div class="address_choice_edit" data-id="'+addresses[i].id+'">编辑</div>\
                        <div class="address_choice_delete" data-id="'+addresses[i].id+'">删除</div>\
                    </li>';
            }
            $(".address_choice_list").html(html);
        }
        $('#linkage').mobiscroll().treelist({//调用Mobiscroll
            theme: "android-holo",
            mode: "scroller",
            display: "bottom",
            lang: "zh",
            labels: ['省', '市', '县'],
            formatResult: function (array) { //返回自定义格式结果
                var res = '';
                if(array[0] != null&&array[0] != -1) {
                    var province = $('#linkage>li').eq(array[0]);
                    res += province.children('span').html();
                    if(array[1] != null) {
                        var city = province.children('ul').children('li').eq(array[1]);
                        res += city.children('span').html();
                        if(array[2]!=null) {
                            var district = city.children('ul').children('li').eq(array[2]);
                            res += district.children('span').html();
                        }
                    }
                }
                return res;
            }
        });
        $(".address_choice_list_button").click(function(){//点击添加地址
            $(".address_choice_div1").hide();
            $(".address_choice_div2").show();
            $(".address_choice_div2 input").val("");
        });
        $(document).on("click",".address_choice_edit",function(){//点击编辑
            for(var v=0;v<addresses.length;v++){
                if($(this).attr("data-id")==addresses[v].id){
                    $(".acf_name").val(addresses[v].name);
                    $(".acf_phone").val(addresses[v].phone);
                    $("#linkage_dummy").val(addresses[v].region);
                    $(".acf_address").val(addresses[v].address);
                    $(".acf_id").val($(this).attr("data-id"));
                }
            }
            $(".address_choice_div1").hide();
            $(".address_choice_div2").show();
        });
        $(document).on("click",".address_choice_form_button",function(){//编辑地址/提交新地址
            /*--------ajax开始--------*/
                //将信息提交到数据库，并返回新的address
                var id = $(".acf_id").val();
                var name = $(".acf_name").val();
                var phone = $(".acf_phone").val();
                var region = $("#linkage_dummy").val();
                var address = $(".acf_address").val();
                // 判断是否填写完全
                if (name.length < 1) {
                    alert('请填写收货人');
                    return false;
                }
                if (phone.length < 1) {
                    alert('请填写手机号');
                    return false;
                }
                if (region.length < 1) {
                    alert('请选择地区');
                    return false;
                }
                if (address.length < 1) {
                    alert('请填写详细地址');
                    return false;
                }
                if (id) {
                    $.ajax({
                        type: 'post',
                        url: '{{route('my.addresses.edit')}}',
                        data: {id: id,name: name,phone: phone,region: region,address: address},
                        success: function (res) {
                            if (res.code == 0) {
                                //将id信息提交到数据库，并返回新的address
                                addresses = res.data;
                                output();//重新输出收货地址列表
                            } else {
                                alert(res.message);
                            }
                        }
                    });
                }else{
                    $.ajax({
                        type: 'post',
                        url: '{{route('my.addresses.add')}}',
                        data: {name: name,phone: phone,region: region,address: address},
                        success: function (res) {
                            if (res.code == 0) {
                                //将id信息提交到数据库，并返回新的address
                                addresses = res.data;
                                output();//重新输出收货地址列表
                            } else {
                                alert(res.message);
                            }
                        }
                    });
                }
                
                $(".address_choice_div2").hide();
                $(".address_choice_div1").show();
            /*--------ajax结束--------*/
        });
        $(document).on("click",".address_choice_delete",function(){//删除地址
            var id=$(this).attr("data-id");
            if (confirm("确定删除该收货地址?")) {
                $.ajax({
                    type: 'post',
                    url: '{{route('my.addresses.delete')}}',
                    data: {id: id},
                    success: function (res) {
                        if (res.code == 0) {
                            //将id信息提交到数据库，并返回新的address
                            addresses = res.data;
                            output();//重新输出收货地址列表
                        } else {
                            alert(res.message);
                        }
                    }
                });
            }else{
                return false;
            }
        });
        $(document).on("click",".address_choice_default",function(){//修改默认地址
            var id=$(this).attr("data-id");
            if (confirm("确定设为默认地址?")) {
                $.ajax({
                    type: 'post',
                    url: '{{route('my.addresses.default')}}',
                    data: {id: id},
                    success: function (res) {
                        if (res.code == 0) {
                            //将id信息提交到数据库，并返回新的address
                            addresses = res.data;
                            output();//重新输出收货地址列表
                        } else {
                            alert(res.message);
                        }
                    }
                });
            }else{
                return false;
            }
        });

        $(document).on("click",".address_choice_button",function(){//点击将收货地址带到上一页
            var url = "{{ route('course.join_charge',['id'=>$course->id]) }}";
            var address_id = $(this).data('addressid');

            var package_flg = '{{$package_flg}}';// 套餐类别
            var package_prices = '{{$package_prices}}';// 单人/套餐价格
            var number = '{{$number}}';// 购买数量
            var coupon_id = '{{$coupon_id}}';// 优惠券
            var is_point = '{{$is_point}}';// 积分开关
            var usable_point = '{{$usable_point}}';// 可用积分
            var usable_money = '{{$usable_money}}';// 积分可抵用现金
            var is_balance = '{{$is_balance}}';// 可用余额开关
            var usable_balance = '{{$usable_balance}}';// 可用余额
            var total_price = '{{$total_price}}';// 总计


            window.location.href = url + "?temp=1" + "&address_id=" + address_id + "&package_flg=" + package_flg + "&package_prices=" + package_prices + "&number=" + number + "&coupon_id=" + coupon_id 
                + "&is_point=" + is_point + "&usable_point=" + usable_point + "&usable_money=" + usable_money + "&is_balance=" + is_balance
                + "&usable_balance=" + usable_balance + "&total_price=" + total_price;
        });
    });
    </script>

@endsection

