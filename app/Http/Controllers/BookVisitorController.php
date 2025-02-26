<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookIssueResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\GuestBookVisitorResource;
use App\Http\Resources\StudentBookIssueResource;
use App\Http\Resources\StudentBookVisitorResource;
use App\Http\Resources\TeacherBookIssueResource;
use App\Http\Resources\TeacherBookVisitorResource;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\GuestVisitor;
use App\Models\StudentBookIssue;
use App\Models\StudentVisitor;
use App\Models\TeacherBookIssue;
use App\Models\TeacherVisitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookVisitorController extends Controller
{
    public function indexGuest()
    {
        $visitorBooks = GuestBookVisitorResource::collection(GuestVisitor::paginate(25));
        return Inertia::render('VisitorBook/Guest/Index', compact('visitorBooks'));
    }

    public function indexTeacher()
    {
        $visitorBooks = TeacherBookVisitorResource::collection(TeacherVisitor::paginate(25));
        return Inertia::render('VisitorBook/Teacher/Index', compact('visitorBooks'));
    }

    public function indexStudent()
    {
        $visitorBooks = StudentBookIssueResource::collection(GuestVisitor::paginate(25));
        return Inertia::render('VisitorBook/Student/Index', compact('visitorBooks'));
    }

    public function guestView($id)
    {
        $bookVisitor = new GuestVisitor;
        $visitor = new GuestBookVisitorResource($bookVisitor);
        return Inertia::render('VisitorBook/Teacher/Index', compact('issue'));
    }

    // CRUD

    public function createTeacher()
    {
        $bookVisitor = new TeacherVisitor;
        $visitor = new TeacherBookVisitorResource($bookVisitor);
        return Inertia::render('VisitorBook/Teacher/Create', compact('visitor'));
    }

    public function createStudent()
    {
        $bookVisitor = new StudentVisitor;
        $visitor = new StudentBookVisitorResource($bookVisitor);
        return Inertia::render('VisitorBook/Student/Create', compact('visitor'));
    }

    public function createGuest()
    {
        $bookVisitor = new TeacherVisitor;
        $visitor = new TeacherBookVisitorResource($bookVisitor);
        return Inertia::render('VisitorBook/Guest/Create', compact('visitor'));
    }

    public function storeTeacher(Request $request)
    {
        $attributes = $this->validate($request, [
            'tanggal'=> 'required',
            'nama'=> 'required',
            'tujuan'=> 'required',
            'ket'=> 'nullable',
        ]);

        TeacherVisitor::create($attributes);

        return redirect()->route('book.visitorTeacher')->with('message','Book Created Successfully!');
    }

    public function teacherStatusUpdate(Request $request, $id)
    {
        $issue = TeacherBookIssue::find($id);
        $issue->issue_date = Carbon::now();
        $issue->return_date = $request->return_date;
        $issue->status = $request->status;
        $issue->save();

        return redirect()->route('book.issue')->with('message','Status Updated Successfully!!');
    }
    public function studentStatusUpdate(Request $request, $id)
    {
        $issue = StudentBookIssue::find($id);
        $issue->issue_date = Carbon::now();
        $issue->return_date = $request->return_date;
        $issue->status = $request->status;
        $issue->save();

        return redirect()->route('book.issue')->with('message','Status Updated Successfully!!');
    }

    public function teacherReturnUpdate(Request $request, $id)
    {
        $issue = TeacherBookIssue::find($id);
        $issue->returned_date = $request->returned_date;
        $issue->fine_received = $request->fine_received;
        $issue->status = "returned";
        $issue->save();

        return redirect()->route('book.issue')->with('message','Book Returned Successfully!!');
    }

    public function studentReturnUpdate(Request $request, $id)
    {
        $issue = StudentBookIssue::find($id);
        $issue->returned_date = $request->returned_date;
        $issue->fine_received = $request->fine_received;
        $issue->status = "returned";
        $issue->save();

        return redirect()->route('book.issue')->with('message','Book Returned Successfully!!');
    }

    public function teacherSearch(Request $request)
    {
        $books = TeacherBookIssueResource::collection(
            TeacherBookIssue::where('unique_id','like','%'.$request->search.'%')
            ->orWhere('teacher_id','like','%'.$request->search.'%')
            ->orderBy('id','desc')
            ->with('book','teacher')
            ->paginate(5)
        );
        return Inertia::render('BookIssue/IndexTeacher', compact('books'));
    }
    public function studentSearch(Request $request)
    {
        $books = StudentBookIssueResource::collection(
            StudentBookIssue::where('unique_id','like','%'.$request->search.'%')
            ->orWhere('student_id','like','%'.$request->search.'%')
            ->orderBy('id','desc')
            ->with('book','student')
            ->paginate(5)
        );
        return Inertia::render('BookIssue/IndexStudent', compact('books'));
    }

}
