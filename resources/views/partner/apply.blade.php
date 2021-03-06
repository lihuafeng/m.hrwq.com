@extends('layout.default')
@section('content')
<div id="subject">
    <div id="main">
        <div class="my">
            <div class="my_be_teachers">
                <article class="my_integral_introduce">
                    {!! $article->content !!}
                </article>
                <a class="mbt_button" href="#" id="partner_apply">申请成为合伙人</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- 提交信息 -->
    <script>
        $(document).ready(function (e) {
            //合伙人申请咨询
            var partner_apply_tel = '{{config('constants.partner_apply_tel')}}';
            $("#partner_apply").click(function (e) {
                e.preventDefault();
                Popup.init({
                    popTitle: '合伙人申请电话咨询',//此处标题随情况改变，需php调用
                    popHtml: '<p><span style="color:#ff9900;">' + partner_apply_tel + '</span>是否立即拨打电话？</p>',//此处信息会涉及到变动，需php调用
                    popOkButton: {
                        buttonDisplay: true,
                        buttonName: "是",
                        buttonfunction: function () {
                            //此处填写拨打电话的脚本
                            window.location.href = 'tel://' + partner_apply_tel;
                        }
                    },
                    popCancelButton: {
                        buttonDisplay: true,
                        buttonName: "否",
                        buttonfunction: function () {
                        }
                    },
                    popFlash: {
                        flashSwitch: false
                    }
                });
                return false;
            });
        });
    </script>
@endsection