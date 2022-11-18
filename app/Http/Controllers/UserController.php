<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'first_name', 'last_name', 'middle_name', 'user_name', 'gender', 'email', 'user_image', 'phone', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function is_active($id)
    {
        $update=User::find($id);
        if($update->is_active==1){
            $update->is_active=0;
        }else{
            $update->is_active=1;
        }
        $update->save();
        return redirect()->back();
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails())
        {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $users = User::findOrFail($inputs['id']);
        } else {
            $users = new User;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/user/';
            $hardPath =  Str::slug('user', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $phone_img = $image->thumbnail(new \Imagine\Image\Box(300, 300));
            $phone_img->save($tmpFilePath . $hardPath . '_phone_300.png');
            $users->user_image = $hardPath;
        }

        $users->first_name = $inputs['first_name'];
        $users->last_name = $inputs['last_name'];
        $users->middle_name = $inputs['middle_name'] ?? null;
        $users->user_name = $inputs['user_name'] ?? null;
        $users->email = $inputs['email'];
        $users->phone = $inputs['phone'] ?? null;
        $users->gender = $inputs['gender'] ?? null;
        $users->password = Hash::make(Str::random(12));
        // $users->pass = $inputs['password_confirmation'];
        $users->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/user');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/user');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit')->with('user', $user);
    }

    public function update(Request $request, User $users)
    {
        $data = $request->except(array('_token'));
        $rule = array(
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails())
        {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $users = User::findOrFail($inputs['id']);
        } else {
            $users = new User;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/user/';
            $hardPath =  Str::slug('user', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $phone_img = $image->thumbnail(new \Imagine\Image\Box(300, 300));
            $phone_img->save($tmpFilePath . $hardPath . '_phone_300.png');
            $users->user_image = $hardPath;
        }

        $users->first_name = $inputs['first_name'];
        $users->last_name = $inputs['last_name'];
        $users->middle_name = $inputs['middle_name'] ?? null;
        $users->user_name = $inputs['user_name'] ?? null;
        $users->email = $inputs['email'];
        $users->phone = $inputs['phone'] ?? null;
        $users->gender = $inputs['gender'] ?? null;
        // $users->password = Hash::make($inputs['password']);
        // $users->pass = $inputs['password_confirmation'];
        $users->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/user');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/user');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $hardPath = public_path() . '/upload/user/' . $user->user_image . '_phone_300.png';
        unlink($hardPath);
        $user->delete();
        return redirect('admin/user')->with('warning', 'USER TABLES DELETED');
    }
}
