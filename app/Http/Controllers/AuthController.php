<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\CheckMobile;
use Auth;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use RuLong\Sms\Models\Sms as SmsModel;
use Validator;
use \Illuminate\Support\Facades\URL;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'smsCode']);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username'              => ['required', Rule::unique('users')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }), new CheckMobile],
                'nickname'              => ['required', 'unique:user_infos'],
                'password'              => 'required|between:6,32|confirmed',
                'password_confirmation' => 'required|between:6,32',
            ], [
                'username.required'              => '手机号码必须填写',
                'username.unique'                => '手机号已经注册',
                'nickname.required'              => '法名必须填写',
                'nickname.unique'                => '法名已经存在',
                'password.required'              => '登录密码必须填写',
                'password.between'               => '登录密码有误',
                'password.confirmed'             => '确认密码与登录密码不一致',
                'password_confirmation.required' => '确认密码必须填写',
                'password_confirmation.between'  => '确认密码有误',
            ]);

            $parent_id = session('parent_id', 0);
            if ($parent_id) {
                $parent = User::find($parent_id);
            }

            $user = User::updateOrCreate(
                [
                    'username'  => $request->username,
                    'password'  => $request->password,
                    'parent_id' => session('parent_id', 0),
                ],
                [
                    'info' => [
                        'nickname' => $request->nickname,
                    ],
                ]
            );

            Session::forget('parent_id');

            // 实现注册完自动登录
            Auth::login($user);

            return $this->success('注册成功', route('user.index'));
        } else {
            return view('auth.register');
        }
    }

    /**
     * 用户登录 *
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:47:02+0800
     * @param Request $request
     */
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'username' => ['required', 'exists:users', new CheckMobile],
                'password' => 'required|between:6,32',
            ], [
                'username.required' => '手机号码必须填写',
                'username.exists'   => '手机号码不存在',
                'password.required' => '登录密码必须填写',
                'password.between'  => '登录密码应在:min-:max位之间',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $cert = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            if (Auth::attempt($cert, true)) {
                $reback = $request->r ?: route('user.index');
                return $this->success('登录成功', $reback);
            } else {
                return $this->error('用户名或密码不存在');
            }
        } else {
            return view('auth.login');
        }
    }

    public function regwechat()
    {
        $app      = app('wechat.official_account');
        $weUser   = $app->oauth->user();
        $Original = $weUser->getOriginal();
        Session::put('Original', $Original);
        return redirect()->route('register');
    }

    /**
     * 微信登录 、微信快速注册 *
     * 注册完之后，在这里没有办法判断推荐关系
     *
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:44:34+0800
     * @param Request $request
     */
    public function wechat(Request $request)
    {

        if (strpos($request->server('HTTP_USER_AGENT'), 'MicroMessenger') !== false) {
            $app = app('wechat.official_account');
            $app['config']->set('oauth.callback', 'login/wechatCallback');
            return $app->oauth->redirect();
        } else {
            return redirect()->route('login');
        }
    }

    public function wechatCallback(Request $request)
    {
        try {
            $app      = app('wechat.official_account');
            $weUser   = $app->oauth->user();
            $callback = $request['callback'] ?? '';
            $openUser = $app->user->get($weUser->id);
            $oldUser  = User::where('openid', $weUser->id)->first();
            if ($oldUser) {
                $oldUser->info->update([
                    'headimgurl'      => $weUser->getOriginal()['headimgurl'],
                    'sex'             => $weUser->getOriginal()['sex'],
                    'country'         => $weUser->getOriginal()['country'],
                    'province'        => $weUser->getOriginal()['province'],
                    'city'            => $weUser->getOriginal()['city'],
                    'subscribe_at'    => $openUser->subscribe_time ?? null,
                    'subscribe_scene' => $openUser->subscribe_scene ?? '',
                    'qr_scene'        => $openUser->qr_scene ?? '',
                    'qr_scene_str'    => $openUser->qr_scene_str ?? '',
                ]);
                Auth::login($oldUser, true);
                if ($callback) {
                    $callback = base64_decode($callback);
                    return redirect($callback);
                } else {
                    return redirect()->route('user.index');
                }
            } else {
                return redirect()->route('login');

            }
            /**
             * 这个注册完成事件，只能把 updateOrCreate 这个方法拆分开来使用了
             */
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    /**
     * 验证码登录 *
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:46:10+0800
     * @param Request $request
     */
    public function bycode(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'mobile' => 'required|mobile|exists:users',
                'code'   => 'required|sms_check:mobile,BYCODE',
            ], [
                'mobile.required' => '手机号码必须填写',
                'mobile.mobile'   => '手机号码格式不正确',
                'mobile.exists'   => '手机号码不存在',
                'code.required'   => '验证码必须填写',
                'code.sms_check'  => '验证码不正确',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $user = User::where('mobile', $request->mobile)->first();
            try {
                Auth::login($user, true);
                return $this->success('登录成功', route('user.index'));
            } catch (\Exception $e) {
                return $this->error($e->getMessage());
            }
        } else {
            return view('auth.bycode');
        }
    }

    /**
     * 找回密码
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:46:34+0800
     * @param Request $request
     */
    public function forgot(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|mobile|exists:users',
                'code'   => 'required|sms_check:mobile,FORGOT',
            ], [
                'mobile.required' => '手机号码必须填写',
                'mobile.mobile'   => '手机号码格式不正确',
                'mobile.exists'   => '手机号码不存在',
                'code.required'   => '验证码必须填写',
                'code.sms_check'  => '验证码不正确',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $request->session()->put('reset_mobile', $request->mobile);

            return $this->success('身份验证成功', Url::temporarySignedRoute('forgot.reset', now()->addHour()));
        } else {
            return view('auth.forgot');
        }
    }

    public function reset(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|between:6,32',
            ], [
                'password.required' => '登录密码必须填写',
                'password.mobile'   => '登录密码应在:min-:max位之间',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $reset_mobile = $request->session()->pull('reset_mobile');
            $password     = $request->password;

            try {
                $user           = User::where('mobile', $reset_mobile)->first();
                $user->password = $password;
                $user->save();
                return $this->success('密码重置成功', route('login'));
            } catch (\Exception $e) {
                return $this->success('密码重置失败', route('forgot'));
            }
        } else {
            return view('auth.reset');
        }
    }

    /**
     * 退出登录
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:46:45+0800
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }

    /**
     * 发送验证码
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:49:55+0800
     * @return
     */
    public function smsCode(Request $request)
    {
        $channel = $request->channel;
        $mobile  = $request->mobile;
        switch ($channel) {
            case 'BYCODE':
            case 'FORGOT':
                // 验证码登录，必须要手机号存在才行
                $validator = Validator::make($request->all(), [
                    'mobile' => ['required', 'exists:users', new CheckMobile],
                ], [
                    'mobile.required' => '手机号码必须填写',
                    'mobile.mobile'   => '手机号码格式不正确',
                    'mobile.exists'   => '手机号码不存在',
                ]);
                break;
            case 'BIND':
                // 绑定手机号，要不存在才可以
                $validator = Validator::make($request->all(), [
                    'mobile' => ['required', 'unique:users', new CheckMobile],
                ], [
                    'mobile.required' => '手机号码必须填写',
                    'mobile.mobile'   => '手机号码格式不正确',
                    'mobile.unique'   => '手机号码已经绑定',
                ]);
                break;
            case 'BINDLast':
                $channel   = 'DEFAULT';
                $validator = Validator::make($request->all(), [
                    'mobile' => 'required|mobile',
                ], [
                    'mobile.required' => '手机号码必须填写',
                    'mobile.mobile'   => '手机号码格式不正确',
                ]);
                break;
            default:
                $validator = Validator::make($request->all(), [
                    'mobile' => ['required', new CheckMobile],
                ], [
                    'mobile.required' => '手机号码必须填写',
                ]);
                break;
        }

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $res = SmsModel::verify_code($request->mobile);
        if ($res !== true) {
            return $this->error($res);
        }

        try {
            $code   = \Sms::send($mobile, $channel);
            $config = config('rulong_sms');
            if ($config['debug'] != true) {
                return $this->success('验证码发送成功');
            } else {
                return $this->success('验证码发送成功' . $code);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
