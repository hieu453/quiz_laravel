<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class UserController extends Controller
{
    public function all()
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Đã thêm người dùng!');
    }

    public function edit(int $id)
    {
        return view('admin.users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(int $id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'is_admin' => ['required']
        ]);

        User::find($id)->update($validatedData);

        return redirect()->back()->with('success', 'Đã sửa thông tin người dùng!');
    }

    public function updatePassword(int $id, Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        User::find($id)->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Đã sửa mật khẩu người');
    }

    public function deleteMultiple(Request $request)
    {
        $adminId = null;
        if (is_array($request->get('ids'))) {
            foreach ($request->get('ids') as $id) {
                if ($id == Auth::user()->id) {
                    $adminId = $id;
                    continue;
                } else {
                    User::destroy($id);
                }
            }
        } else {
            User::destroy($request->get('ids'));
        }

        if ($adminId != null) {
            Auth::logout();
            $request->user()->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return to_route('/');

        }

        return response()->json(['message' => 'Delete category success!']);
    }
}
