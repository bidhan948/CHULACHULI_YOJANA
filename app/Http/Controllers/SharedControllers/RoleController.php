<?php

namespace App\Http\Controllers\SharedControllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('shared.user.role', [
            'roles' => Role::query()->get()
        ]);
    }
}
