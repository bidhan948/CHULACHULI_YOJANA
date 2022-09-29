<?php

namespace App\Http\Controllers\SharedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SharedRequest\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        return view('shared.user.user-list', [
            'users' => User::query()
                ->where('id', '!=', config('constant.SUPERADMIN_ID'))
                ->get(),
            'roles' => Role::query()
                ->where('id', '!=', config('constant.SUPERADMIN_ROLE_ID'))
                ->whereNull('role_id')
                ->get()
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->assignRole($request->role_id);
        });
        toast('प्रयोगकर्ता थप्न सफल भयो ', 'success');
        return redirect()->back();
    }
}
