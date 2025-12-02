<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ActivityLogger;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use ActivityLogger;

    /**
     * Display a listing of roles.
     */
    public function index()
    {
        $roles = Role::withCount('users', 'permissions')->get();
        
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('_', $permission->name)[0]; // Group by prefix (view, create, edit, etc)
        });
        
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ], [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Nama role sudah ada.',
        ]);

        try {
            $role = Role::create(['name' => $validated['name']]);

            if (!empty($validated['permissions'])) {
                $role->givePermissionTo($validated['permissions']);
            }

            // Log activity
            self::logActivity(
                'Created role: ' . $role->name,
                'role',
                Role::class,
                $role->id,
                'created'
            );

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role berhasil dibuat!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal membuat role: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        $role->load('permissions', 'users');
        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        // Prevent editing super_admin role
        if ($role->name === 'super_admin') {
            return back()->with('error', 'Role Super Admin tidak dapat diubah!');
        }

        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('_', $permission->name)[0];
        });
        
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role.
     */
    public function update(Request $request, Role $role)
    {
        // Prevent updating super_admin role
        if ($role->name === 'super_admin') {
            return back()->with('error', 'Role Super Admin tidak dapat diubah!');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        try {
            $role->update(['name' => $validated['name']]);

            // Sync permissions
            if (isset($validated['permissions'])) {
                $role->syncPermissions($validated['permissions']);
            } else {
                $role->syncPermissions([]);
            }

            // Log activity
            self::logActivity(
                'Updated role: ' . $role->name,
                'role',
                Role::class,
                $role->id,
                'updated'
            );

            return redirect()->route('admin.roles.show', $role)
                ->with('success', 'Role berhasil diupdate!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal mengupdate role: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified role.
     */
    public function destroy(Role $role)
    {
        // Prevent deleting super_admin role
        if ($role->name === 'super_admin') {
            return back()->with('error', 'Role Super Admin tidak dapat dihapus!');
        }

        // Prevent deleting role with users
        if ($role->users()->count() > 0) {
            return back()->with('error', 'Role tidak dapat dihapus karena masih memiliki user!');
        }

        try {
            $roleName = $role->name;

            // Log activity
            self::logActivity(
                'Deleted role: ' . $roleName,
                'role',
                Role::class,
                $role->id,
                'deleted'
            );

            $role->delete();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus role: ' . $e->getMessage());
        }
    }
}