@extends('layout.default')
@section('content')
    <div id="subject">
        <div id="main">
            <div class="good_looking">
                <div class="gl_order_details">
                    <form class="glod_form">
                        <div class="glod_div">
                            <div class="glod_top">确认支付</div>
                        </div>
                        <div class="glod_div">
                            <div class="glod_details">
                                <div class="glod_details_img">
                                    <div class="gl_list2_xz"></div>
                                    <img src="{{admin_url($opo->picture)}}" alt=""/></div>
                                <div class="glod_details_title">{{$opo->title}}</div>
                                <div class="glod_details_price">￥{{$opo->price}}</div>
                                <div class="glod_details_people">{{$opo->purchase_num}}人已购买</div>
                            </div>
                            <ul class="glod_list">
                                @if(count($allCoupons))
                                <li>
                                    <div class="glod_list_div">
                                        @if($couponUser)
                                            {{$couponUser->c_coupon->name}}
                                            <input type="hidden" id="coupon_user_id" name="coupon_user_id" value="{{$couponUser->id}}">
                                        @else
                                            使用优惠券
                                            <input type="hidden" id="coupon_user_id" name="coupon_user_id" value="">
                                        @endif
                                    </div>
                                    <div class="glod_list_more"><a href="javascript:;"><img src="/images/public/select_right.jpg"
                                                                                 alt=""/></a></div>
                                </li>
                                @endif
                                <li>
                                    <div class="glod_list_div" id="point_label_div">可用{{$pointsAvailable}}和贝抵￥{{$pointCutAvailable}}</div>
                                    <div class="glod_list_switch">
                                        <div class="switch" data-value="{{request('use_point')==1?'open':'shut'}}"></div><!--open为开，shut为关-->
                                        <input type="hidden" name="use_point" value="{{request('use_point')}}">
                                    </div>
                                </li>
                                <li>
                                    <div class="glod_list_div" id="balance_label_dev">可用余额：￥50.00</div>
                                    <div class="glod_list_switch">
                                        <div class="switch" data-value="{{request('use_balance')==1?'open':'shut'}}"></div><!--open为开，shut为关-->
                                        <input type="hidden" name="use_balance" value="{{request('use_balance')}}">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="glod_bottom_div">
                            <div class="glod_bottom_div_price">合计 <span>￥</span><span id="total_price">{{$opo->price}}</span></div>
                            <div class="glod_bottom_div_button"><input type="button" class="glod_button" value="提交订单">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var original_price = {{$opo->price}};
            var coupon_cut = {{$couponCut}};
            var point_cut_available = {{$pointCutAvailable}};
            var balance_cut_available = {{$user->current_balance>0?$user->current_balance:0}};

            //计算各种金额
            function cal() {
                var total_amount = parseInt((original_price - coupon_cut)*100);
                console.log(total_amount);
                var point_cut = 0;
                var balance_cut = 0;
                if(total_amount<parseInt(point_cut_available*100)) {
                    $('#point_label_div').html('可用'+ parseInt(total_amount*100) +'和贝抵￥'+ (total_amount/100).toFixed(2));
                    point_cut = total_amount;
                } else {
                    $('#point_label_div').html('可用'+ parseInt(point_cut_available*100) +'和贝抵￥'+ (point_cut_available).toFixed(2));
                    point_cut = parseInt(point_cut_available*100);
                }
                if($('input[name="use_point"]').val()==1) {
                    total_amount -= point_cut;
                }

                if(total_amount<parseInt(balance_cut_available*100)) {
                    balance_cut = total_amount;
                    $('#balance_label_dev').html('可用余额：￥'+ (total_amount/100).toFixed(2));
                } else {
                    balance_cut = balance_cut_available*100;
                    $('#balance_label_dev').html('可用余额：￥'+ (balance_cut/100).toFixed(2));
                }

                if($('input[name="use_balance"]').val()==1) {
                    total_amount -= balance_cut;
                }

                $('#total_price').html((total_amount/100).toFixed(2));

            }
            cal();

            //跳转到优惠券选择
            $('.glod_list_more').parent().click(function () {
                window.location.href = '{{route('opo.choose.coupon', ['id'=>$opo->id])}}'+'?coupon_user_id='+$('input[name="coupon_user_id"]').val()+'&use_point='+$('input[name="use_point"]').val()+'&use_balance='+ $('input[name="use_balance"]').val();
                return false;
            });

            //点击开关
            $(".switch").click(function () {
                if ($(this).attr("data-value") == "open") {
                    $(this).attr("data-value", "shut");
                    $(this).parent().children('input').val(0);
                } else {
                    $(this).attr("data-value", "open");
                    $(this).parent().children('input').val(1);
                }
                cal();
            });

            //处理订单提交
            var lock = false;
            $(".glod_button").click(function(e){
                e.preventDefault();
                if (lock) return;
                lock = true;
                $.ajax({
                    type: 'post',
                    url: '{{route('opo.confirm.order', ['id'=>$opo->id])}}',
                    data: $('form').serialize(),
                    dataType: 'json',
                    success:function (res) {
                        if(res.code==0){
                            location.href = res.data;
                        } else {
                            Popup.init({
                                popHtml:'<p>'+res.message+'</p>',
                                popFlash:{
                                    flashSwitch:true,
                                    flashTime:2000
                                }
                            });
                        }
                        lock = false;
                    }
                });
                return false;
            });
        });
    </script>
@endsection