<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookIssueResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\StudentBookIssueResource;
use App\Http\Resources\TeacherBookIssueResource;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\StudentBookIssue;
use App\Models\TeacherBookIssue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookIssueController extends Controller
{
    public function indexTeacher()
    {
        $issueBooks = TeacherBookIssueResource::collection(TeacherBookIssue::with('book','teacher')->paginate(5));
        return Inertia::render('BookIssue/IndexTeacher', compact('issueBooks'));
    }
    public function indexStudent()
    {
        $issueBooks = StudentBookIssueResource::collection(StudentBookIssue::with('book','student')->paginate(5));
        return Inertia::render('BookIssue/IndexStudent', compact('issueBooks'));
    }

    public function teacherView($id)
    {
        $bookIssue = TeacherBookIssue::with('teacher')->find($id);
        $issue = new TeacherBookIssueResource($bookIssue);
        $book = new BookResource(Book::where('id',$bookIssue->book_id)->with('category','author','location')->first());
        return Inertia::render('BookIssue/ViewTeacher', compact('issue','book'));
    }
    public function studentView($id)
    {
        $bookIssue = StudentBookIssue::with('student')->find($id);
        $issue = new StudentBookIssueResource($bookIssue);
        $book = new BookResource(Book::where('id',$bookIssue->book_id)->with('category','author','location')->first());
        return Inertia::render('BookIssue/ViewStudent', compact('issue','book'));
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

    public function teacherSeturnUpdate(Request $request, $id)
    {
        $issue = TeacherBookIssue::find($id);
        $issue->returned_date = $request->returned_date;
        $issue->fine_received = $request->fine_received;
        $issue->status = "returned";
        $issue->save();

        return redirect()->route('book.issue')->with('message','Book Returned Successfully!!');
    }

    public function studentSeturnUpdate(Request $request, $id)
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
