@extends('layout.default')
@section('content')
<div id="subject">
    <div id="main">
        <div class="my">
            <div class="my_order">
                <div class="mo_top">我区域的订单</div>
                <ul class="mo_list">
                    @foreach($orders as $value)
                        <li>
                            <div class="mo_list_top">
                                <div class="mo_list_number">订单状态</div>
                                <div @if($value->order_type=='1') class="mo_list_state mo_list_state_orange" @else class="mo_list_state mo_list_state_green" @endif>{{$order_type[$value->order_type]}}</div><!--mo_list_state_green为绿色，mo_list_state_orange为橙色-->
                            </div>
                            <div class="mo_list_text">
                                <div class="mo_list_img"><img src="{{config('constants.admin_url').@$value->course->picture}}" alt=""/></div>
                                <div class="mo_list_title">{{ @str_limit(@$value->course->title,20) }}</div>
                                <div class="mo_list_price">@if($value->free_flg=='2')￥{{$value->each_price}}@else免费@endif</div>
                                <div class="mo_list_people">{{ $value->course->participate_num or 0}}人已报名</div>
                            </div>
                            <div class="mo_list_new">
                                <div class="mo_list_new_img"><img src="{{url(@$value->user->profileIcon)}}" alt=""/></div>
                                <div class="mo_list_new_title">{{ $value->user->realname or $value->user->nickname}}</div>
                                <div class="mo_list_new_telephone">{{$value->user->mobile}}</div>
                                <div class="mo_list_new_button" data-tel="{{$value->user->mobile}}" onclick="window.location.href = 'tel://{{$value->user->mobile}}'">电话联系</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
});
</script>
@endsection