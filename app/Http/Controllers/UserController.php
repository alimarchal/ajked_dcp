<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Super-Admin')->only(['create', 'index', 'store', 'edit', 'update']);
    }

    public function index(Request $request)
    {
//        $users = User::with('roles', 'permissions','branch')->paginate(1000)->withQueryString();

        // Set a default value for perPage, and ensure it's an integer
        $perPage = (int)($request->input('perPage', 100));

        // List of allowed 'perPage' values
        $allowedPerPageValues = [5, 10, 50, 100, 200, 300, 400, 500, 1000, 2000, 5000]; // Add more values as needed

        // Ensure the requested 'perPage' value is in the allowed list
        if (!in_array($perPage, $allowedPerPageValues)) {
            $perPage = 100; // Default value if requested 'perPage' is not allowed
        }

        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('role_id'), // Assuming you have a role_id column
                AllowedFilter::exact('permission_id'), // Assuming you have a permission_id column
                'branch.circle', // Filter based on the circle property of the branch relation
                // Add more filters as needed
            ])
            ->with('roles', 'permissions', 'branch')
            ->join('branches', 'users.branch_id', '=', 'branches.id')
            ->orderBy('branches.circle')
            ->paginate($perPage)
            ->withQueryString();

        $circles = Branch::groupBy('circle')->get();

//        $users = User::with('roles', 'permissions', 'branch')
//            ->join('branches', 'users.branch_id', '=', 'branches.id')
//            ->orderBy('branches.circle')
//            ->paginate(1000)
//            ->withQueryString();
        return view('users.index', compact('users', 'circles'));
    }

    //
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'branch_id' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'branch_id' => $request->branch_id,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::find($request->role);
        $user->assignRole($role);

        session()->flash('status', 'User has been successfully added into database.');

        return to_route('users.index');
    }

    public function edit(User $user, Request $request)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|username|unique:users,username,' . $user->id,
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $user->update($request->all());
        $user->syncPermissions($request->input('permissions', []));

        session()->flash('status', 'User has been updated successfully.');
        return to_route('users.edit', compact('user'));
    }
}
