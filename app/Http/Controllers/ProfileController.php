<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordConfirmation;
use App\Http\Requests\UploadImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
    }

    public function passwordUpdate(User $user, PasswordConfirmation $request)
    {
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('profile.index')->with('status', 'Пароль успешно изменен!');
    }

    public function imageUpload(User $user, UploadImage $request)
    {
        $image = $request->file('img')->store('public/images');
        $image = explode('/', $image);
        $user->update([
            'img' => $image[1] . '/' . $image[2]
        ]);

        return redirect()->route('profile.index')->with('status', 'Фото успешно обновлено!');
    }
}
