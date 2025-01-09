<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Category;
use App\Models\LocationRack;
use App\Models\StudentBookIssue;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $total = [
            'book' => Book::count(),
            'author' => Author::count(),
            'category' => Category::count(),
            'location' => LocationRack::count(),
            'issue_book' => StudentBookIssue::count(),
            'return' => StudentBookIssue::where('status','returned')->count(),
            'not_return' => StudentBookIssue::where('status', '!=', 'returned')->count(),
            'fines' => StudentBookIssue::sum('fine_received'),
        ];
        return Inertia::render('Dashboard', compact('total'));
    }
}
