<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Area;
use App\Models\Article;
use App\Models\UserPartnerApply;
use App\Models\UserPartnerCard;
use App\Models\UserPartnerCardImages;
use Carbon\Carbon;
use DB,Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 合伙人申请页
     */
    public function apply()
    {
        $article = Article::whereType(9)->first();
        $article->content = replace_content_image_url($article->content);

        return view('partner.apply', ['article' => $article]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 合伙人完善资料
     */
    public function complete()
    {
        $userInfo = user_info();

        if ($userInfo['role'] != 3)
            abort(403, '不是合伙人，无法完善合伙人资料！');
        $userPartnerApply = UserPartnerApply::where('user_id', $userInfo['id'])->where('progress', 1)->orderBy('id', 'desc')->first();
        if ($userPartnerApply != null)
            return view('partner.progress', ['userInfo' => $userInfo, 'userPartnerApply' => $userPartnerApply]);
        if ($userInfo['partner_city']) {
            $areaInfo = Area::where('area_id', $userInfo['partner_city'])->first();
            $userInfo['partner_city_parent'] = $areaInfo->area_parent_id;
        }
        return view('partner.complete', ['userInfo' => $userInfo]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * 保存合伙人资料
     */
    public function partnerSave()
    {
        $user = User::with('c_province', 'c_city', 'c_district')->find(session('user_info')['id']);
        if ($user->role != 3)
            return response()->json(['code' => 2, 'message' => '不是合伙人，无法完善合伙人资料！']);

        $this->validate(request(), [
            'realname' => 'required',
            'sex' => 'required',
            'email' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
        ], [], [
            'realname' => '真实姓名',
            'sex' => '性别',
            'email' => '邮箱',
            'address' => '通讯地址',
            'province' => '期望城市',
            'city' => '期望城市',
        ]);

        $userPartnerApply = new UserPartnerApply();
        $userPartnerApply->user_id = $user->id;
        $userPartnerApply->realname = request('realname');
        $userPartnerApply->sex = request('sex');
        $userPartnerApply->email = request('email');
        $userPartnerApply->address = request('address');
        $userPartnerApply->city = request('city');
        $userPartnerApply->progress = 1;
        if ($userPartnerApply->save())
            return response()->json(['code' => 0, 'message' => '合伙人资料提交成功！']);
        return response()->json(['code' => 1, 'message' => '合伙人资料提交失败！']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * 合伙人城市检查
     */
    public function city_check()
    {
        return response()->json(['code' => 1]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 合伙人区域订单
     */
    public function orders()
    {
        $userId = session('user_info')['id'];
        $userInfo = User::where('role', '3')->where('partner_city', '>', '0')->find($userId);
        if (!$userInfo) {
            abort(403, '非合伙人无法查看合伙人区域订单!');
        }
        //将合伙人新订单 flag 置2
        $user = $userInfo;
        Order::where('partner_flg', 1)->where(function ($query) use ($user) {
            $query->where(function ($queryOne) use ($user) {
                $queryOne->whereHas('course', function ($q) use ($user) {
                    $q->where('promoter', $user->id)->where('head_flg', 2);
                });
            })
                ->orWhere(function ($queryTwo) use ($user) {
                    $queryTwo->whereHas('course', function ($q) {
                        $q->where('head_flg', 1)
                            ->where('distribution_flg', 1);
                    })
                        ->whereHas('order_course', function ($q) use ($user) {
                            $q->where('user_city', $user->partner_city);
                        });
                });
        })->update(['partner_flg' => 2]);

        //查询出合伙人订单
        $orders = Order::with([
            'course', 'user', 'order_course'
        ])
//            ->whereHas('course', function ($query) use ($userInfo) {
//                $query->where('promoter', $userInfo->id)
//                    ->where('head_flg', 2);
//
//            })
//            ->orWhere(function ($query) use ($userInfo) {
//                $query->whereHas('course', function ($query) use ($userInfo) {
//                    $query->where('head_flg', 1)
//                        ->where('distribution_flg', 1);
//                })
//                ->whereHas('order_course', function ($query) use ($userInfo) {
//                    $query->where('user_city', $userInfo->partner_city);
//                 });
//            })

            ->whereHas('user', function($query) use ($userInfo){
                $query->where('lover_id', $userInfo->id);
            })
            ->whereIn('pay_type', ['1','6'])
            ->whereIn('order_type', ['1', '2', '4'])
            ->orderBy('id', 'desc')
            ->get();
            //dd($orders);
        $order_type = config('constants.order_type');
        return view('partner.orders', ['orders' => $orders, 'order_type' => $order_type]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 运营数据
     */
    public function operate()
    {
        $user = User::find(session('user_info')['id']);
        if($user==null){
            abort(403, '合伙人信息查询失败');
        }
        //当前年份
        $cur_year = date('Y');
        //当前月份
        $cur_month = date('m');
        //累计注册用户
        $userAllCnt = User::where('lover_id', $user->id)->where('mobile', '!=', '')->count();
        $yesterdayf = date("Y-m-d 00:00:00", strtotime("-1 day"));
        $yesterdayt = date("Y-m-d 23:59:59", strtotime("-1 day"));
        $userYesterdayCnt = User::whereBetween('created_at', [$yesterdayf, $yesterdayt])
            ->where('lover_id', $user->id)->where('mobile', '!=', '')->count();
        //昨日新增用户
        return view('partner.operate', compact('userAllCnt', 'userYesterdayCnt', 'cur_year', 'cur_month'));
    }

    /**
     * 按年份统计用户
     *
     */
    public function user(Request $request)
    {
        $select_s_year = $request->input('select_s_year');
        $select_s_month = $request->input('select_s_month');

        //月份为0,按年份搜索
        if ($select_s_month == 0) {
            $this->_stat_user_by_year();
        }
        $this->_stat_user_by_month();
    }

    /**
     * 最近七天
     */
    public function day7()
    {
        $barData = $tick = $message = [];
        $day_arr = [];
        for ($i = 7; $i > 0; $i--) {
            $day_arr[] = date('Y-m-d', strtotime('-' . $i . ' day'));
        }

        $day_num_arr = $this->_stat_month_user_add($day_arr);

        foreach ($day_arr as $k => $day) {
            $barData[0]['data'][] = [$k + 1, isset($day_num_arr[$day]) ? $day_num_arr[$day] : 0];
            //todo 用户列表 链接待完善
            $barData[0]['url'] = '';
            $tick[$k] = [$k+1, substr($day, 5)];
        }

        $message['code'] = 0;
        $message['content'] = $barData;
        $message['tick'] = $tick;
        $message['days'] = $day_arr;
        die(json_encode($message, JSON_UNESCAPED_UNICODE));
    }

    /**
     * 最近一年的数据（不包括当月）
     */
    private function _stat_user_by_year()
    {
        $barData = $tick = $message = [];
        $month_num_arr = $this->_stat_year_user_add();

        $startTime = Carbon::now()->subMonths(13);
        for ($i = 0; $i < 12; $i++) {
            $i_month = $startTime->addMonth()->format('Y-m');

            $barData[0]['data'][] = [$i + 1, isset($month_num_arr[$i_month]) ? $month_num_arr[$i_month] : 0];
            //todo 用户列表 链接待完善
            if ($i%3==0)
                $tick[] = [$i + 1, $i_month];
        }
        $barData[0]['url'] = '';

        $message['code'] = 0;
        $message['content'] = $barData;
        $message['tick'] = $tick;
        die(json_encode($message, JSON_UNESCAPED_UNICODE));
    }


    /**
     * 最近一个月统计用户
     *
     */
    private function _stat_user_by_month()
    {
        $barData = $tick = $message = [];

        $day_arr = [];
        for ($i = 30; $i > 0; $i--) {
            $day_arr[] = date('Y-m-d', strtotime('-' . $i . ' day'));
        }

        $day_num_arr = $this->_stat_month_user_add($day_arr);

        foreach ($day_arr as $k => $day) {
            $barData[0]['data'][] = [$k + 1, isset($day_num_arr[$day]) ? $day_num_arr[$day] : 0];
            //todo 用户列表 链接待完善
            $barData[$k]['url'] = '';
            if ($k%4==0)
                $tick[] = [$k + 1, substr($day, 5)];
        }

        $message['code'] = 0;
        $message['content'] = $barData;
        $message['tick'] = $tick;
        die(json_encode($message, JSON_UNESCAPED_UNICODE));
    }


    private function _stat_year_user_add()
    {
        $user = User::find(session('user_info')['id']);
        if($user==null)
            return [];

        $endTime = Carbon::now()->subMonth()->endOfMonth();
        $startTime = Carbon::now()->subMonth(13)->startOfMonth();

        $day_num_arr = [];
        $user_add = User::withTrashed()->whereBetween('created_at', [(string)$startTime, (string)$endTime])->where('city', $user->partner_city)->lists('created_at')->toArray();

        foreach ($user_add as $v) {
            $tmp = explode('-', $v);
            $day_key = $tmp[0] . '-' . $tmp[1];

            $day_num_arr[$day_key] = isset($day_num_arr[$day_key]) ? $day_num_arr[$day_key] + 1 : 1;
        }

        return $day_num_arr;
    }


    /**
     * 统计当月所有注册用户 数组分组  日期=》注册次数
     *
     * @param $day_arr
     * @return array
     */
    private function _stat_month_user_add($day_arr)
    {
        $user = User::find(session('user_info')['id']);
        if($user==null)
            return [];

        $day_num_arr = [];
        $month_user_add = User::withTrashed()->whereBetween('created_at', [$day_arr[0] . ' 00:00:00', end($day_arr) . ' 23:59:59'])->where('city', $user->partner_city)->lists('created_at')->toArray();

        foreach ($month_user_add as $v) {
            $day_key = explode(' ', $v)[0];
            $day_num_arr[$day_key] = isset($day_num_arr[$day_key]) ? $day_num_arr[$day_key] + 1 : 1;
        }

        return $day_num_arr;
    }
    
    private function _createPartnerBase64Id($uid){
        return base64_encode($uid);
    }
    
    private function _decodePartnerBase64Id($base64id){
        return base64_decode($base64id);
    }
    
    private function _cardFixUser($userInfo){
        $city = array('city' => array('area_name' => '中国'));
        if ($userInfo['partner_city']) {
            $areaInfo = Area::where('area_id', $userInfo['partner_city'])->first();
            if(!empty($areaInfo)){
                $city['city'] = $areaInfo->toArray();
            }
        }
        $userInfo = array_merge($userInfo, $city);
        
        $userInfo['profileIcon'] = rtrim(config('constants.front_url'),'/').'/'.$userInfo['profileIcon'];
        $userInfo['realname'] = !empty($userInfo['realname']) ? $userInfo['realname'] : $userInfo['nickname'];
        return $userInfo;
    }
    
    /**
     * 验证可否看到合伙人卡片
     * @param type $isAbort
     * @return boolean
     */
    private function _validateCard($isAbort = true){
        return _validateCard($isAbort);
    }
    
    public function card(Request $request){
        $this->_validateCard();
        
        $userInfo = user_info();
        $remark = "和润万青（北京）教育科技有限公司，专注华人家庭教育和青少年成长教育15年，是由华人家庭教育领域唯一的父子专家——全国十佳教育公益人物贾容韬老师、北京师范大学心理学硕士贾语凡老师共同创立。
全国免费咨询电话：400-6363-555";
        $cover_url = "http://photos.partner.hrwq.com/banner.png";
        $cardInfo = UserPartnerCard::with('images')->find($userInfo['id']);
        
        if(empty($cardInfo)){
            $apply = UserPartnerApply::where(['user_id' => $userInfo['id']])->first();
            if(!empty($apply)){
                $card = new UserPartnerCard();
                $card->user_id = $userInfo['id'];
                $card->tel = $userInfo['mobile'];
                $card->email = $apply->email;
                $card->address = $apply->address;
                $card->cover_url = $cover_url;
                $card->remark = empty($apply->introduction) ? $remark : $apply->introduction;
                $card->save();
            }else{
                $card = new UserPartnerCard();
                $card->user_id = $userInfo['id'];
                $card->cover_url = $cover_url;
                $card->remark = $remark;
                $card->save();
            }
            
            $cardInfo = UserPartnerCard::with('images')->find($userInfo['id']);
        }
        
        $base64Id = $this->_createPartnerBase64Id($userInfo['id']);
        $userInfo = $this->_cardFixUser($userInfo);
        return view('partner.card', ['user_info' => $userInfo,'card_info' => $cardInfo, 'base64_id' => $base64Id]);
    }
    
    public function cardShow($uid){
        $uid = $this->_decodePartnerBase64Id($uid);
        $userInfo = User::find($uid);
        if(empty($userInfo)){
            abort(403, '用户不存在');
        }
        
        $userInfo = $userInfo->toArray();
        $cardInfo = UserPartnerCard::with('images')->find($userInfo['id']);
        $base64Id = $this->_createPartnerBase64Id($userInfo['id']);
        $userInfo = $this->_cardFixUser($userInfo);
        return view('partner.card-show', ['user_info' => $userInfo,'card_info' => $cardInfo, 'base64_id' => $base64Id]);
    }
    
    public function cardEdit(Request $request){
        $this->_validateCard();
        $userInfo = user_info();
        
        $cardInfo = UserPartnerCard::with('images')->find($userInfo['id']);
        $base64Id = $this->_createPartnerBase64Id($userInfo['id']);
        $userInfo = $this->_cardFixUser($userInfo);   
        $domain_url = _qiniu_get_domain("usercover");
        return view('partner.card-edit', ['user_info' => $userInfo, 'card_info' => $cardInfo,
            'base64_id' => $base64Id, 'domain_url' => $domain_url]);
    }
    
    public function cardUpdate(Request $request){
        $user_id = user_info()['id'];
        $attrs = array();
        $attrs['tel'] = $request->input('tel');
        $attrs['wechat'] = $request->input('wechat');
        $attrs['email'] = $request->input('email');
        $attrs['address'] = $request->input('address');
        $attrs['website'] = $request->input('website');
        $attrs['remark'] = $request->input('remark');
        
        UserPartnerCard::find($user_id)->update($attrs);
        
        return response()->json(['code'=>0, 'message'=>'修改成功！']);
    }
    
    public function cardChangeBanner(Request $request){
        $filepath = $_FILES['file']['tmp_name'];
        $uploadResult = _qiniu_upload_img_thumb($filepath, 'banner/'.user_info()['id']);
        $cover_url = '';
        if(empty($uploadResult['err'])){
            $cover_url = $uploadResult['url'];
            UserPartnerCard::find(user_info()['id'])->update(['cover_url' => $cover_url]);
            return response()->json(['code' => 0, 'message' => '上传成功', 'url' => $cover_url]);
        }
       
        return response()->json(['code' => 1, 'message' => '上传失败:', 'result'=>json_encode($uploadResult)]);
    }
    
    public function cardChangeVideo(Request $request){
        $video_url = $request->input('video_url');
        $video_hash = $request->input('video_hash');
        if(empty($video_url) || empty($video_hash)){
            return response()->json(['code' => 1, 'message' => '上传视频失败']);
        }
        UserPartnerCard::find(user_info()['id'])->update(['video_url' => $video_url, 'video_hash' => $video_hash]);
        return response()->json(['code' => 0, 'message' => '上传成功', 'url' => $video_url]);
    }
    
    public function cardRemoveVideo(Request $request){
        UserPartnerCard::find(user_info()['id'])->update(['video_url' => '', 'video_hash' => '']);
        return response()->json(['code' => 0, 'message' => '删除成功']);
    }
    
    public function cardCreateImg(Request $request){
        $filepath = $_FILES['file']['tmp_name'];
        //$uploadResult = _qiniu_upload_img($filepath, 'photo');
        $uploadResult = _qiniu_upload_img_thumb($filepath, 'photo/'.user_info()['id']);
        $cover_url = "";
        if(empty($uploadResult['err'])){
            $cover_url = $uploadResult['url'];
            
            $images = new UserPartnerCardImages();
            $images->user_id = user_info()['id'];
            $images->url = $cover_url;
            $images->save();
            $id = DB::getPdo()->lastInsertId();
            return response()->json(['code' => 0, 'message' => '上传成功', 'url' => $cover_url, 'id'=>$id]);
        }

        return response()->json(['code' => 1, 'message' => '上传失败', 'result'=>json_encode($uploadResult)]);
    }
    
    public function cardRemoveImg(Request $request){
        $id = $request->input('id');
        if(UserPartnerCardImages::destroy($id)){
            return response()->json(['code' => 0, 'message' => '删除成功']);
        }
        return response()->json(['code' => 1, 'message' => '删除失败']);
    }
    
    public function buildLover(Request $request){
        $lover_id = $request->input('lover_id');
        $userInfo = user_info();
        
        if($lover_id != 0 
            && $userInfo['vip_flg'] == 1
            && $lover_id != $userInfo['id']){
                //建立或更新关系
                User::whereOpenid($userInfo['openid'])->update(['lover_id'=>$lover_id,'lover_time' => date("Y-m-d H:i:s")]);
                Log::info('lover_relation', ['用户'.$userInfo['id']."与合伙人".$lover_id."建立关系"]);
        }
        
        return response()->json(['code' => 0, 'message' => '删除成功']);
    }
    
}
