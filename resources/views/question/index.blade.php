@extends('layout.default')
@section('content')
    <div id="subject">
        <div id="main">
            <div class="good_asking">
                <div class="gl_search"><div><img src="images/public/search_bg.png" alt=""/> <span id="search_tip">@if(request('search_key')) {{request('search_key')}} @else 智慧榜家长/问题/城市 @endif</span></div></div>
                <div class="public_search"  style="display:none;" >
                    <form class="public_search_form">
                        <div class="public_search_form_div"><input class="public_search_form_input" type="text" name="search_key" value="{{request('search_key')}}" placeholder="智慧榜家长/问题/城市" ><div class="public_search_form_input_delete"></div></div>
                        <div class="public_search_form_cancel">取消</div>
                    </form>
                    <div class="public_search_hot" style="display: none">
                        <div>搜索"<span>东风</span>"</div>
                    </div>
                    <dl class="public_search_quick">
                        <dt>热门搜索</dt>
                        <dd>
                            <ul>
                                @foreach($hot_search as $item)
                                     <li data-value="{{$item}}">{{$item}}</li><!--data-value为要检索的内容-->
                                @endforeach
                            </ul>
                            <div class="clearboth"></div>
                        </dd>
                        <dt class="public_search_delete_con">最近搜索</dt><!--若没有最近搜索信息，则此dt和下面的dd不显示-->
                        <dd class="public_search_delete_con">
                            <ul class="h-search-item">

                            </ul>
                            <div class="clearboth"></div>
                        </dd>
                    </dl>
                    <div class="public_search_delete">清除搜索记录</div><!--若没有最近搜索信息,则不显示清除搜索记录-->
                </div>

                <ul class="ga_tab">
                    <li id="ga_tab_1"  @if(request('selected_tab')==1 || !request('selected_tab')) class="selected" @endif index_v="1">智慧榜</li>
                    <li id="ga_tab_2"  @if(request('selected_tab')==2) class="selected" @endif index_v="2">问题榜</li>
                    <li id="ga_tab_3"  @if(request('selected_tab')==3) class="selected" @endif index_v="3">互助榜</li>
                </ul>
                <div class="ga_div">

                    <div class="ga_div_1" @if(request('selected_tab') && request('selected_tab')!=1) style="display:none;"  @endif >
                        <ul class="ga_div_1_list" >
                            @if(!count($teachers_top) &&  !count($teachers) )
                                <div class="search_none">没有搜索到相关信息</div>
                            @else
                                @foreach($teachers_top as $item)
                                    <li>
                                        <a href="{{route('question.teacher',['id'=>$item->id])}}">
                                            <div class="ga_div_1_list_img"><img src="{{url($item->profileIcon)}}" alt=""/></div>
                                            <div class="ga_div_1_list_title">{{$item->realname or $item->nickname}}</div>
                                            <div class="ga_div_1_list_post">{{$item->tutor_honor}}</div>
                                        </a>
                                            <ul class="ga_div_1_list_information">
                                                <li class="ga_div_1_list_information_1"><img src="/images/ask/ga_div_1_list_information_1.png" alt=""/> {{$item->question->count()}}</li>
                                                <li class="ga_div_1_list_information_2"><img src="/images/ask/ga_div_1_list_information_2.png" alt=""/> {{$item->user_favor->count()}}</li>
                                                {{--<li class="ga_div_1_list_information_3">收入：<span>￥{{$item->question_amount or '0.00'}}</span></li>--}}
                                                <li class="ga_div_1_list_information_3 div_list_zambia" id="{{ $item->id }}">
                                                    @if($item->like_record->count()>0)
                                                        <img src="/images/public/zambia_on.png" alt=""/>
                                                    @else
                                                        <img  src="/images/public/zambia.png" alt="" />
                                                    @endif
                                                    <span>{{$item->likes}}</span>
                                                </li>
                                            </ul>
                                            <div class="clearboth"></div>

                                    </li>
                                @endforeach

                                @foreach($teachers as $item)
                                    <li>
                                        <a href="{{route('question.teacher',['id'=>$item->id])}}">
                                            <div class="ga_div_1_list_img"><img src="{{url($item->profileIcon)}}" alt=""/></div>
                                            <div class="ga_div_1_list_title">{{$item->realname or $item->nickname}}</div>
                                            <div class="ga_div_1_list_post">{{$item->tutor_honor}}</div></a>
                                            <ul class="ga_div_1_list_information">
                                                <li class="ga_div_1_list_information_1"><img src="/images/ask/ga_div_1_list_information_1.png" alt=""/> {{$item->question->count()}}</li>
                                                <li class="ga_div_1_list_information_2"><img src="/images/ask/ga_div_1_list_information_2.png" alt=""/> {{$item->user_favor->count()}}</li>
                                                <li class="ga_div_1_list_information_3 div_list_zambia" id="{{ $item->id }}">
                                                        @if($item->like_record->count()>0)
                                                            <img src="/images/public/zambia_on.png" alt=""/>
                                                        @else
                                                            <img  src="/images/public/zambia.png" alt="" />
                                                        @endif
                                                    <span>{{$item->likes}}</span>
                                                </li>
                                                <!--<li class="ga_div_1_list_information_3">收入：<span>￥{{$item->question_amount or '0.00'}}</span></li>-->
                                            </ul>
                                            <div class="clearboth"></div>

                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        @if($teachers->hasMorePages())
                            <div class="gl_list2_more teacher_more">点击加载更多...</div>
                        @endif
                    </div>
                    <div class="ga_div_2" @if(request('selected_tab')==2) @else style="display:none;" @endif >
                        <ul class="ga_div_ul">
                            @foreach($question_tags as $q_tag)
                                <li data-value="{{$q_tag->tag_id}}">#{{@$q_tag->tag->title}}#</li>
                            @endforeach
                        </ul>
                        <div class="clearboth"></div>

                        @if(count($questions))
                            <ul class="ga_div_2_list">
                                @foreach($questions as $item)
                                    <li>
                                        @if(!session('wechat_user'))
                                        <div class="ga_div_2_list_problem"><a href="{{route('wechat.qrcode')}}">问题：{{$item->content}}</a></div>
                                        @else
                                        <div class="ga_div_2_list_problem"><a href="{{route('wechat.question')}}?id={{$item->id}}">问题：{{$item->content}}</a></div>
                                        @endif
                                        <div class="ga_div_2_list_name">{{$item->answer_user->realname or $item->answer_user->nickname }} | {{$item->answer_user->tutor_honor}}</div>
                                        <div class="ga_div_2_list_answer">
                                            <a href="{{route('question.teacher',['id'=>$item->answer_user->id])}}"><div class="ga_div_2_list_answer_img"><img src="{{asset($item->answer_user->profileIcon)}}" alt=""/></div></a>

                                            @if($item->audio_type!=1)
                                                <div class="ga_div_2_list_answer_voice audio_can_play" style="cursor:pointer;" aid="{{$item->audio_type}}" qid="{{$item->id}}">{{ $item->audio_msg }}
                                                    <audio data-src="{{config('qiniu.DOMAIN').$item->answer_url}}"></audio>
                                                </div>
                                            @else
                                                <div class="ga_div_2_list_answer_voice audio_cant_play" style="cursor:pointer;" qid="{{$item->id}}">{{ $item->audio_msg }}
                                                </div>
                                            @endif

                                            <div class="ga_div_2_list_answer_time">{{$item->voice_long}}"</div>
                                            <div class="ga_div_2_list_answer_people">{{$item->listener_nums}}人旁听</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="search_none">没有搜索到相关信息</div>
                        @endif

                        @if($questions->hasMorePages())
                            <div class="gl_list2_more question_more">点击加载更多...</div>
                        @endif
                    </div>

                    <div class="ga_div_3" @if(request('selected_tab')==3) @else style="display:none;" @endif >
                        <ul class="ga_div_ul">
                            @foreach($talk_tags as $t_tag)
                                <li data-value="{{$t_tag->tag_id}}">#{{@$t_tag->tag->title}}#</li>
                            @endforeach
                        </ul>
                        <div class="clearboth"></div>


                        @if(count($talks))
                            <ul class="ga_div_3_list">
                                @foreach($talks as $item)
                                <li>
                                    <a href="{{route('question.talk',['id'=>$item->id])}}">
                                        <div class="ga_div_3_list_div">
                                            <div class="ga_div_3_list_img"><img src="{{url($item->ask_user->profileIcon)}}" alt=""/></div>
                                            <div class="ga_div_3_list_name">{{$item->ask_user->realname or $item->ask_user->nickname}}</div>
                                            <div class="ga_div_3_list_source">来自  {{@$item->ask_user->c_city->area_name}} {{config('constants.user_label')[$item->ask_user->label]}}</div>
                                        </div>
                                        <div class="ga_div_3_list_people">{{$item->view or 0}}人已看</div>
                                        <div class="ga_div_3_list_problem">
                                            @foreach($item->tags as $tag)
                                                  <span>#{{$tag->title}}#</span>
                                            @endforeach
                                            {{$item->title}}
                                        </div>
                                        <div class="ga_div_2_list_p two_line"><pre>{!! replace_em($item->content) !!}</pre></div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="search_none">没有搜索到相关信息</div>
                        @endif

                        @if($talks->hasMorePages())
                            <div class="gl_list2_more talk_more">点击加载更多...</div>
                        @endif
                        @if(!session('wechat_user'))
                        <a class="lcd_evaluate lcd_evaluate_fa" href="{{ route('wechat.qrcode')}}">发帖</a>
                        @else
                        <a class="lcd_evaluate lcd_evaluate_fa" href="{{ route('question.ask_talk')}}">发帖</a>
                        @endif
                    </div>
                </div>
            </div>
            @include('element.nav', ['selected_item' => 'nav4'])
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="/js/audio_play.js"></script>
    <script type="text/javascript" src="/js/history_search.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
	<style type="text/css">
	.two_line { height: 29px; overflow: hidden; }
	</style>
    <script>
     $(document).ready(function(){
         wx.config(<?php echo $wx_js->config(array("onMenuShareAppMessage", "onMenuShareTimeline"),false) ?>);
            wx.ready(function(){
                wx.onMenuShareAppMessage({
                    title: '教育孩子有困惑？去问中国好父母', // 分享标题
                    desc: '听说，情商最高的父母都在这', // 分享描述
                    link: '{{route('question')}}', // 分享链接
                    @if(@$teachers_top[0]['profileIcon'])
                    imgUrl: '{{url($teachers_top[0]['profileIcon'])}}', // 分享图标
                    @elseif(@$teachers[0]['profileIcon'])
                    imgUrl: '{{url($teachers[0]['profileIcon'])}}', // 分享图标
                    @endif
                    type: '', // 分享类型,music、video或link，不填默认为link
                    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () { 
                        // 用户确认分享后执行的回调函数
                    },
                    cancel: function () { 
                        // 用户取消分享后执行的回调函数
                    }
                });
                wx.onMenuShareTimeline({
                    title: '教育孩子有困惑？去问中国好父母', // 分享标题
                    link: '{{route('question')}}', // 分享链接
                    @if(@$teachers_top[0]['profileIcon'])
                    imgUrl: '{{url($teachers_top[0]['profileIcon'])}}', // 分享图标
                    @elseif(@$teachers[0]['profileIcon'])
                    imgUrl: '{{url($teachers[0]['profileIcon'])}}', // 分享图标
                    @endif
                    success: function () {
                        // 用户确认分享后执行的回调函数
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                    }
                });

            });

     @if ($is_guest)
         $('.lcd_evaluate, .ga_div_2_list_problem a').click(function() {
             var url = $(this).attr('href');
             Popup.init({
                 popHtml:'<p>您尚未注册，请先完成注册。</p>',
                 popOkButton:{
                     buttonDisplay:true,
                     buttonName:"去注册",
                     buttonfunction:function(){
                         window.location.href='/user/login?url='+ encodeURIComponent(url);
                         return false;
                     }
                 },
                 popCancelButton:{
                     buttonDisplay:true,
                     buttonName:"否",
                     buttonfunction:function(){}
                 },
                 popFlash:{
                     flashSwitch:false
                 }
             });
             return false;
         });
     @endif

      historySearch.init({
             localStorageKey : 'h_kwd_list'
         });

         //搜索关键词 下拉框
         var $inputs = $(".public_search_form_input");
         $inputs.on('input paste',function() {
             if($(this).val()=='')
             {
                 $('.public_search_hot').hide();
             }else{
                 $('.public_search_hot').show();
                 $('.public_search_hot span').html($(this).val());
             }
         });
	 $inputs.on('keyup', function(evt) {
		if (evt.keyCode == 13) $('.public_search_hot').trigger('click');
	 });

         //点击搜索
         $('.public_search_hot').click(function(){
             //搜索内容
             var search_key = $('>div >span',this).html();
             historySearch.store(search_key);
             location.href = '{{route('question')}}'+'?search_key='+search_key+'&selected_tab='+$(".ga_tab .selected").attr('index_v');
         })


           $(".gl_search").click(function(){//弹出搜索框
                $(this).hide();
                $(".public_search").show();

                var tmp_val =  $(".public_search_form_input").val();
                if(tmp_val =='')
                {
                   $('.public_search_hot').hide();
                }else{
                   $('.public_search_hot').show();
                   $('.public_search_hot span').html(tmp_val);
                }

                $(".public_search_form_input").focus();
            });

            $(".public_search_form_input_delete").click(function(){//清空搜索input中的内容
                $(".public_search_form_input").val("");
            });

            $(".public_search_form_cancel").click(function(){//取消搜索
                $(".public_search_form_input").val("");
                $('#search_tip').html($(".public_search_form_input").attr('placeholder'));
                $(".gl_search").show();
                $(".public_search").hide();
            });

            $(".public_search_quick li,.h-search-item li").click(function(){//快捷搜索
                var value=$(this).attr("data-value");
                historySearch.store(value);
                location.href = '{{route('question')}}'+'?search_key='+value+'&selected_tab='+$(".ga_tab .selected").attr('index_v');
            });

            $(".public_search_delete").click(function(){//删除最近搜索记录
                historySearch.empty(); //删除h_kwd_list这个键值的里面所有的值
                $(".public_search_delete").remove();
                $(".public_search_delete_con").remove();
            });

             /*----------智慧榜加载更多----------*/
             var teacher_current_page = 1, teacher_last_page = '{{$teachers->lastPage()}}';
             $(".teacher_more").click(function(){//点击加载更多按钮
                 if(teacher_last_page > teacher_current_page)
                 {
                     var sheight = $('.teacher_more').offset().top;
                     teacher_current_page ++;
                     $.ajax({
                         type: 'post',
                         url: '{{route('question.teacher_list')}}',
                         data: {page:teacher_current_page,teachers_top_uid_json:'{{ $teachers_top_uid_json }}',search_key:'{{request('search_key')}}',selected_tab:'{{request('selected_tab')}}'},
                         dataType: 'json',
                         success: function (res) {
                            if(res)
                            {
                                var teacher_data = res.data;
                                var teacher_ul_li ='';
                                $.each(teacher_data,function(k,v){
                                    var name = v.nickname;
                                    if(v.realname){
                                        name = v.realname;
                                    }

                                    if(v.question_amount == null)
                                    {
                                        v.question_amount = '0.00';
                                    }
                                    var zanStr = '<img  src="/images/public/zambia.png" alt="" />';
                                    if(!v.like_record)
                                        zanStr='<img src="/images/public/zambia_on.png" alt=""/>';
                                            {{--@else--}}
                                                {{----}}
                                    teacher_ul_li += '<li>';
                                    teacher_ul_li += '<a href="{{route('question.teacher')}}/'+ v.id+'">';
                                    teacher_ul_li += '<div class="ga_div_1_list_img"><img src="'+ v.profileIcon+'" alt=""/></div>';
                                    teacher_ul_li += '<div class="ga_div_1_list_title">'+ name+'</div>';
                                    teacher_ul_li += '<div class="ga_div_1_list_post">'+ v.tutor_honor+'</div>';
                                    teacher_ul_li += '</a>';
                                    teacher_ul_li += '<ul class="ga_div_1_list_information">';
                                    teacher_ul_li += '<li class="ga_div_1_list_information_1"><img src="/images/ask/ga_div_1_list_information_1.png" alt=""/> '+ v.question.length+'</li>';
                                    teacher_ul_li += '<li class="ga_div_1_list_information_2"><img src="/images/ask/ga_div_1_list_information_2.png" alt=""/> '+ v.user_favor.length+'</li>';
//                                    teacher_ul_li += '<li class="ga_div_1_list_information_3">收入：<span>￥'+ v.question_amount+'</span></li>';

                                    teacher_ul_li += '<li class="ga_div_1_list_information_3 div_list_zambia" id="'+ v.id +'">'+zanStr+'<span>&nbsp;'+ v.likes + '</span></li>';
                                    teacher_ul_li += '</ul>';
                                    teacher_ul_li += '<div class="clearboth"></div>';
                                    teacher_ul_li += '</li>';
                                })
                                if(teacher_ul_li!='')
                                {
                                    $('.ga_div_1_list').append(teacher_ul_li);
                                    $("html,body").animate({scrollTop:sheight}, 1000);
                                }
                            }
                         }
                     });
                     if(teacher_current_page >= teacher_last_page){
                         $(".teacher_more").hide();
                     }
                 }
             });

            /*----------问题榜加载更多----------*/
         var question_current_page = 1, question_last_page = '{{$questions->lastPage()}}';
         $(".question_more").click(function(){//点击加载更多按钮
             if(question_last_page > question_current_page)
             {
                 var qheight = $('.question_more').offset().top;
                 question_current_page ++;
                 $.ajax({
                     type: 'post',
                     url: '{{route('question.question_list')}}',
                     data: {page:question_current_page,search_key:'{{request('search_key')}}',search_tag:'{{request('search_tag')}}',selected_tab:'{{request('selected_tab')}}'},
                     dataType: 'json',
                     success: function (res) {
                         if(res) {
                             var question_data = res.data;
                             var question_ul_li ='';
                             $.each(question_data,function(k,v){
                                 var name = v.answer_user.nickname;
                                 if(v.answer_user.realname){
                                     name = v.answer_user.realname;
                                 }

                                 question_ul_li += '<li>';
                                 @if(!session('wechat_user'))
                                 question_ul_li += '<div class="ga_div_2_list_problem"><a href="{{route('wechat.qrcode')}}">问题：'+ v.content+'</a></div>';
                                 @else
                                 question_ul_li += '<div class="ga_div_2_list_problem"><a href="{{route('wechat.question')}}?id='+ v.id+'">问题：'+ v.content+'</a></div>';
                                 @endif
                                 question_ul_li += '<div class="ga_div_2_list_name">'+name+' | '+ v.answer_user.tutor_honor+'</div>';
                                 question_ul_li += '<div class="ga_div_2_list_answer">';
                                 question_ul_li += '<div class="ga_div_2_list_answer_img"><img src="'+ v.answer_user.profileIcon+'" alt=""/></div>';

                                 if(v.audio_type != 1){
                                     question_ul_li += '<div class="ga_div_2_list_answer_voice audio_can_play" style="cursor:pointer;" aid="'+ v.audio_type+'" qid="'+ v.id+'"><audio data-src="{{config('qiniu.DOMAIN')}}'+ v.answer_url+'"></audio>'+ v.audio_msg+'</div>';
                                 }else{
                                     question_ul_li += '<div class="ga_div_2_list_answer_voice audio_cant_play" style="cursor:pointer;" qid="'+ v.id+'">'+ v.audio_msg+'</div>';
                                 }

                                 question_ul_li += '<div class="ga_div_2_list_answer_time">'+ v.voice_long+'"</div>';
                                 question_ul_li += '<div class="ga_div_2_list_answer_people">'+ v.listener_nums+'人旁听</div>';
                                 question_ul_li += '</div>';
                                 question_ul_li += '</li>';
                             })
                             if(question_ul_li!='')
                             {
                                 $('.ga_div_2_list').append(question_ul_li);
                                 $("html,body").animate({scrollTop:qheight}, 1000);
                             }
                         }
                     }
                 });
                 if(question_current_page >= question_last_page){
                     $(".question_more").hide();
                 }
             }
         });


         /*----------互助榜加载更多----------*/
         var talk_current_page = 1, talk_last_page = '{{$talks->lastPage()}}';
         $(".talk_more").click(function(){//点击加载更多按钮
             if(talk_last_page > talk_current_page)
             {
                 var theight = $('.talk_more').offset().top;
                 talk_current_page ++;
                 $.ajax({
                     type: 'post',
                     url: '{{route('question.talk_list')}}',
                     data: {page:talk_current_page,search_key:'{{request('search_key')}}',search_tag:'{{request('search_tag')}}',selected_tab:'{{request('selected_tab')}}'},
                     dataType: 'json',
                     success: function (res) {
                         if(res) {
                             var talk_data = res.data;
                             var talk_ul_li ='';
                             $.each(talk_data,function(k,v){
                                 var name = v.ask_user.nickname;
                                 if(v.ask_user.realname){
                                     name = v.ask_user.realname;
                                 }
                                 var label = '暂无';
                                 if(v.ask_user.label == 2){
                                     label = '爸爸';
                                 }
                                 else if(v.ask_user.label == 3)
                                 {
                                     label = '妈妈';
                                 }

                                 talk_ul_li+= '<li>';
                                 talk_ul_li+= '<a href="{{route('question.talk')}}/'+ v.id+'">';
                                 talk_ul_li+= '<div class="ga_div_3_list_div">';
                                 talk_ul_li+= '<div class="ga_div_3_list_img"><img src="'+v.ask_user.profileIcon+'" alt=""/></div>';
                                 talk_ul_li+= '<div class="ga_div_3_list_name">'+name+'</div>';
                                 talk_ul_li+= '<div class="ga_div_3_list_source">来自  '+v.ask_user.c_city.area_name+' '+label+'</div>';
                                 talk_ul_li+= '</div>';
                                 talk_ul_li+= '<div class="ga_div_3_list_people">'+ v.view+'人已看</div>';
                                 talk_ul_li+= '<div class="ga_div_3_list_problem">';

                                 $.each(v.tags,function(kk,vv){
                                     talk_ul_li+= '<span>#'+vv.title+'#</span>';
                                 })

                                 talk_ul_li+= v.title+'</div>';
                                 talk_ul_li+= '<div class="ga_div_2_list_p two_line">'+ replace_em(v.content)+'</div>';
                                 talk_ul_li+= '</a>';
                                 talk_ul_li+= '</li>';
                             })
                             if(talk_ul_li!='')
                             {
                                 $('.ga_div_3_list').append(talk_ul_li);
                                 $("html,body").animate({scrollTop:theight}, 1000);
                             }
                         }
                     }
                 });
                 if(talk_current_page >= talk_last_page){
                     $(".talk_more").hide();
                 }
             }
         });
        });
    </script>
    <script type="text/javascript">
        //qq表情替换
        function replace_em(str){
            str = str.replace(/\</g,'&lt;');
            str = str.replace(/\>/g,'&gt;');
            str = str.replace(/\n/g,'<br/>');
            str = str.replace(/\[em_([0-9]*)\]/g,'<img src="../images/face/$1.gif" border="0" />');
            return str;
        }

        $(document).ready(function(){

            //标签搜索   问题榜/互助榜
            $(".ga_div_2 .ga_div_ul li,.ga_div_3 .ga_div_ul li").click(function(){//点击ga_div_ul中的li事件
                var value=$(this).attr("data-value");
                location.href = '{{route('question')}}'+'?search_tag='+value+'&selected_tab='+$(".ga_tab .selected").attr('index_v');
            });

            /*----------音频播放---------*/
            audioPlay.init({
                url:'{{route('question.question_listen')}}'
            });

            /*-----------需支付跳转到详情页操作------*/
            $(document).on('click','.audio_cant_play',function(){
                @if(!session('wechat_user'))
                    window.location.href = '{{route('wechat.qrcode')}}';return;
                @endif
                var qid = $(this).attr('qid');
                location.href  = '{{route('wechat.question')}}?id='+qid;
            });

            //默认加载tab
            $(".ga_tab li").each(function(){
                if($(this).attr("class")=="selected"){
                    $(".ga_div>div").hide();
                    switch($(this).attr("id")){
                        case "ga_tab_1":
                            $(".ga_div_1").show();
                            break;
                        case "ga_tab_2":
                            $(".ga_div_2").show();
                            break;
                        case "ga_tab_3":
                            $(".ga_div_3").show();
                            break;
                        default:
                            break;
                    }
                }
            });

            $(".ga_tab li").click(function(){//tab切换
                location.href = '{{route('question')}}'+'?selected_tab='+($(this).index()+1);
            });
            /*$(".ga_tab li").click(function(){//tab切换
                if($(this).attr("class")!="selected"){
                    $(".ga_tab li").attr("class","");
                    $(this).attr("class","selected");
                    $(".ga_div>div").hide();
                    var placeholder = $(".public_search_form_input").attr('placeholder');
                    switch($(this).attr("id")){
                        case "ga_tab_1":
                            location.href = '{{route('question')}}'+'?selected_tab=1';
                            placeholder = '智慧榜家长/问题/城市';
                            $(".ga_div_1").show();
                            break;
                        case "ga_tab_2":
                            location.href = '{{route('question')}}'+'?selected_tab=2';
                            placeholder = '用户名/问题/城市';
                            $(".ga_div_2").show();
                            break;
                        case "ga_tab_3":
                            location.href = '{{route('question')}}'+'?selected_tab=3';
                            placeholder = '用户名/问题/城市/话题';
                            $(".ga_div_3").show();
                            break;
                        default:
                            break;
                    }
                    $(".public_search_form_input").attr('placeholder',placeholder);
                    $('#search_tip').html(placeholder);
                }
            });*/

            //$(".ga_tab li.selected").removeClass('selected').click();

            //点赞
            var like_lock = false;
            $('.ga_div_1_list').on("click",'.ga_div_1_list_information>.div_list_zambia',function () {//点赞
                var user_id = $(this).attr("id");
                var _self = $(this);
                if (like_lock) return;
                like_lock = true;
                $.ajax({
                    type: 'post',
                    url: '{{route('question.teacher.like')}}',
                    data: {"user_id": user_id},
                    success: function (res) {
                        Popup.init({
                            popHtml: res.message,
                            popFlash: {
                                flashSwitch: true,
                                flashTime: 2000
                            }
                        });
                        if (res.code == 0) {
                            _self.html( ' <img src="/images/public/zambia_on.png" alt=""/>'+"<span>"+res.data+"</span>");
                        }
                        like_lock = false;
                    }
                });
            });
        });


    </script>
@endsection
