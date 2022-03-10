<?php

namespace App\Http\Controllers;

use App\Models\todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $data = User::find(Auth::user()->id)->todo;
            return view('User', [
                'title' => 'Home Page',
                'email' => Auth::user()->email,
                'data' => $data,
            ]);
        } else {
            return redirect()->route('login');
        }
    }
    public function addDataView()
    {
        return view('form', [
            'title' => 'Add Data',
            'email' => Auth::user()->email,
            'data' => false
        ]);
    }
    public function addData(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'detail' => 'nullable'
        ]);
        todo::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'user_id' => Auth::user()->id,
            'status' => 'waiting'
        ]);
        return redirect()->route('home');
    }
    public function updateData($id)
    {
        return view('form', [
            'title' => 'Update Data',
            'email' => Auth::user()->email,
            'data' => todo::find($id)
        ]);
    }
    public function updateDataId(Request $request, $id)
    {
        $data = todo::find($id);
        if ($data) {
            $validate = $request->validate([
                'title' => 'required',
                'detail' => 'nullable'
            ]);
            $data->update($validate);
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
    public function done($id)
    {
        $data = todo::find($id);
        if ($data) {
            $data->update([
                'status' => 'Done'
            ]);
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
    public function onchange($id)
    {
        $data = todo::find($id);
        if ($data) {
            $data->update([
                'status' => 'On Change'
            ]);
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
    public function delete($id)
    {
        todo::destroy($id);
        return redirect()->route('home');
    }
}
