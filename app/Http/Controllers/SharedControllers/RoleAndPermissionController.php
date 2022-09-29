<?php

namespace App\Http\Controllers\SharedControllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleAndPermissionController extends Controller
{
    public function index(): View
    {
        return view('shared.user.role', [
            'roles' => Role::query()
                ->where('name', '!=', 'superadmin')
                ->whereNotNull('role_id')
                ->get(),
            'parentRoles' => Role::query()
                ->where('name', '!=', 'superadmin')
                ->whereNull('role_id')
                ->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attribute = $request->validate(
            [
                'name' => 'required|unique:roles',
                'role_id' => 'required|exists:roles,id'
            ]
        );
        
        Role::create($attribute);
        toast("भूमिका थप्न सफल भयो", "success");
        return redirect()->back();
    }

    public function managePermission(Role $role): View
    {
        // this is for storing only permission id since role is linked to permission and we can check in manage permission view using its id
        if ($role->has('permissions')) {
            $permissionViaRole = $role->permissions->pluck('id')->toArray();
        } else {
            $permissionViaRole = [];
        }

        return view('shared.user.manage_permission', [
            'role' => $role->load('permissions'),
            'permissions' => Permission::query()->get(),
            'permissionArr' => $permissionViaRole
        ]);
    }

    /************************this is for assigning permission via role****************************************/
    public function update(Request $request, Role $role): RedirectResponse
    {
        if (!$request->has('permission')) {
            Alert::error("अनुमति प्रबन्ध फिल्ड खाली छ");
            return redirect()->back();
        }

        $role = Role::findById($role->id);
        $role->syncPermissions($request->permission);
        toast('अनुमति प्रबन्ध हाल्न सफल भयो ', 'success');
        return redirect()->route('role.index');
    }

    /**********BELOW METHOD IS FOR PERMISSION*********/

    public function indexPermission(): View
    {
        return view('shared.user.permission', [
            'permissions' =>  Permission::query()->paginate(25)
        ]);
    }

    public function storePermission(Request $request): RedirectResponse
    {
        $attribute = $request->validate(['name' => 'required:unique:permissions']);
        Permission::create(['name' => Str::replace(' ', '_', strtoupper($attribute['name']))]);
        toast("अनुमति थप्न सफल भयो", "success");
        return redirect()->back();
    }
}
