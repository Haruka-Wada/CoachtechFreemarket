<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function address(Request $request)
    {
        $item_id = $request->item_id;
        return view('auth.address', compact('item_id'));
    }

    public function update(AddressRequest $request)
    {
        $user = User::find(Auth::id());
        $user->update([
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building
        ]);
        $item_id = $request->item_id;

        return redirect(route('item.purchase', [
            'item_id' => $item_id
        ]));
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function store(ProfileRequest $request)
    {
        $user = User::find(Auth::id());
        $thumbnail = $request->file('thumbnail');
        if(isset($thumbnail)) {
            $path = $thumbnail->store('thumbnail', 'public');
            $full_path = asset('storage/' . $path);
        }else {
            $full_path = Auth::user()->thumbnail;
        }

        if (Auth::user()->thumbnail != $full_path) {
            $old_path = basename(Auth::user()->thumbnail);
            Storage::disk('public')->delete('thumbnail/' . $old_path);
        }

        $user->update([
            'name' => $request->name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
            'thumbnail' => $full_path
        ]);

        return redirect('/mypage');
    }
}
