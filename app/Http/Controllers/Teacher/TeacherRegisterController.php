<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TeacherRegisterController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:teacher');
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Teacher/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|max:255|unique:'.Teacher::class,
            'password' => ['required'],
        ]);

        $user = Teacher::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('teacher')->login($user);

        return redirect()->route('teacher.profile');
    }
}
