@extends('layout.default')
@section('content')
<div id="subject">
    <div id="main">
        <div class="my">
            <div class="my_data_edit" style="padding:32px 0 0 0">
                <form class="mde_form" id="profile-form">
                    <ul class="mde_list">
                        <li>
                            <div class="mde_list_title" style="color: #000">转出金额</div>
                            <div class="mde_list_input"><input type="text" placeholder="单次最多可提现200元" name="cash_amount"  id="cash_amount"></div>
                        </li>
                    </ul>
                    <div class="mde_button profile-button" id="cash_apply"><input type="button" class="mde_button"  value="提交">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#cash_apply').click(function(){
            var cash_amount = $('#cash_amount').val();
            $.ajax({
                url: '{{route('user.cash_store')}}',
                type: "post",
                data: {
                    cash_amount: cash_amount
                },
                success: function (res) {
                    if (res.code==0) {
                        Popup.init({
                            popHtml:res.message,
                            popFlash:{
                                flashSwitch:true,
                                flashTime:2000,
                                flashfunction:function(){
                                    location.href='{{route('user.balance')}}';
                                }
                            }
                        });
                    } else {
                        Popup.init({
                            popHtml:res.message,
                            popFlash:{
                                flashSwitch:true,
                                flashTime:2000
                            }
                        });
                    }
                },
                error: function (res) {
                    var errors = res.responseJSON;
                    for (var o in errors) {
                        Popup.init({
                            popHtml:errors[o][0],
                            popFlash:{
                                flashSwitch:true,
                                flashTime:2000
                            }
                        });

                        break;
                    }
                }
            })
        })
    })
</script>
@endsection