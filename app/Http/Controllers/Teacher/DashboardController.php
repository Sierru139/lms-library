<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookIssueResource;
use App\Models\BookIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $issueBooks = BookIssueResource::collection(
            BookIssue::where('teacher_id',Auth::user()->id)
            ->where('status','pending')
            ->orWhere('status','accepted')
            ->with('book')
            ->take(5)
            ->get()
        );
        return Inertia::render('Teacher/Dashboard', compact('issueBooks'));
    }

    public function issueBook()
    {
        $issueBooks = BookIssueResource::collection(
            BookIssue::where('student_id',Auth::user()->id)
            ->with('book')
            ->paginate(5)
        );
        return Inertia::render('Teacher/IssueBook', compact('issueBooks'));
    }
}
