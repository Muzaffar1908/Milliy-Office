<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Models\Position\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::select('id', 'user_id', 'pos_name_uz', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.position.index', compact('positions', 'users'));
    }

    public function is_active($id)
    {
        $update = Position::find($id);
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
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.position.create', compact('users'));

    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'pos_name_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $positions = Position::findOrFail($inputs['id']);
        } else {
            $positions = new Position;
        }

        $positions->user_id = $inputs['user_id'];
        $positions->pos_name_uz = $inputs['pos_name_uz'];
        $positions->pos_name_ru = $inputs['pos_name_ru'];
        $positions->pos_name_en = $inputs['pos_name_en'];
        $positions->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/position');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/position');
        }
    }

    public function edit($id)
    {
        $position = Position::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.position.edit', [
            'position' => $position,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Position $positions)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'pos_name_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $positions = Position::findOrFail($inputs['id']);
        } else {
            $positions = new Position;
        }

        $positions->user_id = $inputs['user_id'];
        $positions->pos_name_uz = $inputs['pos_name_uz'];
        $positions->pos_name_ru = $inputs['pos_name_ru'];
        $positions->pos_name_en = $inputs['pos_name_en'];
        $positions->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/position');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/position');
        }
    }

    public function delete($id)
    {
        $position = Position::findOrFail($id);
        // $image_path = public_path() . '/upload/depa$position/' . $position->user_image . '-d.png';
        // unlink($image_path);
        $position->delete();
        return redirect('admin/position')->with('warning', 'POSITION TABLES DELETED');
    }
}
