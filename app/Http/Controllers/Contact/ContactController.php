<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::select('id', 'address_uz', 'phone', 'email', 'started_at', 'stopped_at', 'created_at')->orderBy('created_at', 'DESC')->first();
        return view('admin.contact.index', compact('contacts'));
    }


    public function create()
    {
        return view('admin.contact.create');
    }


    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'address_uz' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'started_at' => 'required',
            'stopped_at' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $contacts = Contact::findOrFail($inputs['id']);
        } else {
            $contacts = new Contact();
        }

        $contacts->address_uz = $inputs['address_uz'];
        $contacts->address_ru = $inputs['address_ru'];
        $contacts->address_en = $inputs['address_en'];
        $contacts->phone = $inputs['phone'];
        $contacts->email = $inputs['email'];
        $contacts->started_at = $inputs['started_at'];
        $contacts->stopped_at = $inputs['stopped_at'];
        $contacts->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/contact');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/contact');
        }
    }


    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', [
            'contact' => $contact,
        ]);
    }


    public function update(Request $request, Contact $contacts)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'address_uz' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'started_at' => 'required',
            'stopped_at' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $contacts = Contact::findOrFail($inputs['id']);
        } else {
            $contacts = new Contact();
        }

        $contacts->address_uz = $inputs['address_uz'];
        $contacts->address_ru = $inputs['address_ru'];
        $contacts->address_en = $inputs['address_en'];
        $contacts->phone = $inputs['phone'];
        $contacts->email = $inputs['email'];
        $contacts->started_at = $inputs['started_at'];
        $contacts->stopped_at = $inputs['stopped_at'];
        $contacts->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/contact');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/contact');
        }
    }

}
