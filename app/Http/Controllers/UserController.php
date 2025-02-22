<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('org_id')) {
            $query->where('org_id', $request->org_id);
        }

        $query->whereNotNull('org_id');
        $query->orderBy('created_at', 'desc');

        // $users = $query->whereNotNull('org_id')->orderBy('created_at', 'desc')->paginate(15);
        $users = $query->paginate(10)->appends($request->query());

        $orgs = Organization::orderBy('name', 'asc')->get();

        return view('users.index', compact('users', 'orgs'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = Organization::orderBy('name', 'asc')->get();
        $roles = Role::orderBy('name', 'desc')->get();

        return view('users.create', compact('orgs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'org_id' => 'required',
            'division' => 'required',
            'phone' => 'required',
        ]);

        $input['password'] = Hash::make($request->password);

        // registriin dugaart test utga olgoh
        $input['danRegnum'] = 'TT111111';

        User::create($input);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $orgs = Organization::orderBy('name', 'asc')->get();
        $roles = Role::orderBy('name', 'desc')->get();

        return view('users.edit', compact('user', 'orgs', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'org_id' => 'required',
            'division' => 'required',
            'phone' => 'required',
        ]);

        $input = $request->all();

        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input['password'] = Hash::make($request->password);
        }

        $user->update($input);

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user **/

        $user = Auth::user();
        $input = $request->all();
        // dd($input);

        $request->validate([
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'password' => 'nullable|required|string|min:8|confirmed',
        ]);

        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile-photos', 'public');

            // Update the user's profile photo path in the database
            $user->profile_photo_path = $photoPath;
        }

        $user->update($input);

        return redirect()->route('profile')
            ->with('success', 'Хэрэглэгчийн мэдээлэл амжилттэй засагдлаа.');
    }

    public function adminProfile()
    {
        return view('users.adminProfile');
    }

    public function updateAdminProfile(Request $request)
    {
        /** @var \App\Models\User $user **/

        $user = Auth::user();
        $input = $request->all();
        // dd($input);

        $request->validate([
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:4096',
            // 'password' => 'required|string|min:8|confirmed'
        ]);

        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile-photos', 'public');

            // Update the user's profile photo path in the database
            $user->profile_photo_path = $photoPath;
        }

        $user->update($input);

        return redirect()->route('adminProfile')
            ->with('success', 'Хэрэглэгчийн мэдээлэл амжилттэй засагдлаа.');
    }
}
