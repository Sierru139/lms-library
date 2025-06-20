<?php

namespace App\Http\Controllers;

use App\Http\Resources\{BookIssueResource, BookResource, StudentBookIssueResource, TeacherBookIssueResource};
use App\Models\{Book, BookIssue, StudentBookIssue, TeacherBookIssue};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookIssueController extends Controller
{
    public function indexTeacher()
    {
        $issueBooks = TeacherBookIssueResource::collection(TeacherBookIssue::with('book')->paginate(25));
        return Inertia::render('BookIssue/IndexTeacher', compact('issueBooks'));
    }

    public function indexStudent()
    {
        $issueBooks = StudentBookIssueResource::collection(StudentBookIssue::with('book')->paginate(25));
        return Inertia::render('BookIssue/IndexStudent', compact('issueBooks'));
    }

    public function teacherView($id)
    {
        $bookIssue = TeacherBookIssue::with('teacher')->findOrFail($id);
        $issue = new TeacherBookIssueResource($bookIssue);
        $book = new BookResource(Book::with('category', 'author', 'location')->findOrFail($bookIssue->book_id));
        return Inertia::render('BookIssue/ViewTeacher', compact('issue', 'book'));
    }

    public function studentView($id)
    {
        $bookIssue = StudentBookIssue::with('student')->findOrFail($id);
        $issue = new StudentBookIssueResource($bookIssue);
        $book = new BookResource(Book::with('category', 'author', 'location')->findOrFail($bookIssue->book_id));
        return Inertia::render('BookIssue/ViewStudent', compact('issue', 'book'));
    }

    public function teacherStatusUpdate(Request $request, $id)
    {
        $issue = TeacherBookIssue::findOrFail($id);
        $issue->update([
            'issue_date' => Carbon::now(),
            'return_date' => $request->return_date,
            'status' => $request->status,
        ]);

        return redirect()->route('book.issueTeacher')->with('message', 'Status Updated Successfully!');
    }

    public function studentStatusUpdate(Request $request, $id)
    {
        $issue = StudentBookIssue::findOrFail($id);
        $issue->update([
            'issue_date' => Carbon::now(),
            'return_date' => $request->return_date,
            'status' => $request->status,
        ]);

        return redirect()->route('book.issueStudent')->with('message', 'Status Updated Successfully!');
    }

    public function teacherReturnUpdate(Request $request, $id)
    {
        $issue = TeacherBookIssue::findOrFail($id);
        $issue->update([
            'returned_date' => $request->returned_date,
            'fine_received' => $request->fine_received,
            'status' => 'returned',
        ]);

        return redirect()->route('book.issueTeacher')->with('message', 'Book Returned Successfully!');
    }

    public function studentReturnUpdate(Request $request, $id)
    {
        $issue = StudentBookIssue::findOrFail($id);
        $issue->update([
            'returned_date' => $request->returned_date,
            'fine_received' => $request->fine_received,
            'status' => 'returned',
        ]);

        return redirect()->route('book.issueStudent')->with('message', 'Book Returned Successfully!');
    }

    public function teacherSearch(Request $request)
    {
        // Validasi input pencarian
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $books = TeacherBookIssue::with('book')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('teacher_name', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%{$search}%")
                      ->orWhereHas('book', function($query) use ($search)
                    {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                });
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString(); // menjaga query string saat paginasi
            return Inertia::render('BookIssue/IndexTeacher', [
                'issueBooks' => TeacherBookIssueResource::collection($books),
                'filters' => [
                    'search' => $request->search,
                ],
            ]);
    }

    public function studentSearch(Request $request)
    {
        $books = StudentBookIssueResource::collection(
            StudentBookIssue::where('student_name', 'like', "%{$request->search}%")
                ->orWhere('id', 'like', "%{$request->search}%")
                ->orderByDesc('id')
                ->with('book', 'student')
                ->paginate(5)
        );
        return Inertia::render('BookIssue/IndexStudent', compact('books'));
    }

    public function teacherCreate()
    {
        return Inertia::render('BookIssue/Teacher/Create', ['book' => Book::all()]);
    }

    public function teacherStore(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required',
            'apply_date' => 'required',
            'book_id' => 'required',
        ]);

        TeacherBookIssue::create([
            'teacher_name' => $request->teacher_name,
            'apply_date' => $request->apply_date,
            'book_id' => $request->book_id,
            'status' => 'pending',
        ]);

        return redirect()->route('book.issueTeacher')->with('success', 'Success, you have added data');
    }

    public function teacherEdit(string $id)
    {
        $issueBook = TeacherBookIssue::with('book')->find($id);
        return Inertia::render( 'BookIssue/Teacher/Edit', [
            'issueBook' => $issueBook,
            'books' => Book::all(),
        ]);
    }

    public function teacherUpdate(Request $request, $id)
    {
        $request->validate([
            'teacher_name' => 'required',
            'apply_date' => 'required',
            'book_id' => 'required',
        ]);

        $issue = TeacherBookIssue::find($id);

        if (!$issue) {
            return redirect()->route('book.issueTeacher')->with('error', 'Data not found');
        }

        $issue->update([
            'teacher_name' => $request->teacher_name,
            'apply_date' => $request->apply_date,
            'returned_date' => $request->returned_date,
            'book_id' => $request->book_id,
            'status' => $request->status,
        ]);

        return redirect()->route('book.issueTeacher')->with('success', 'Success, you have updated data');
    }

    public function studentCreate()
    {
        return Inertia::render('BookIssue/Student/Create', [
            'book' => Book::all(),
        ]);
    }

    public function studentStore(Request $request)
    {
        try {
            $request->validate([
                'student_name'     => 'required|string|max:255',
                'apply_date'       => 'required|date',
                'issue_date'       => 'nullable|date',
                'returned_date'    => 'nullable|date',
                // 'no_induk'         => 'required|string|max:100',
                'no_kartu_perp'    => 'nullable|string|max:100',
                'kelas'            => 'nullable|string|max:50',
                'jurusan'          => 'nullable|string|max:100',
                // 'id_pinjaman'      => 'nullable|string|max:100',
                'status'           => 'required|string',
                'keterangan'       => 'nullable|string|max:500',
                'book_id'          => 'required|exists:books,id',
            ]);

            $issue = new StudentBookIssue();
            $issue->student_name   = $request->student_name;
            $issue->apply_date     = $request->apply_date;
            $issue->issue_date     = $request->issue_date;
            $issue->returned_date  = $request->returned_date;
            $issue->no_kartu_perp  = $request->no_kartu_perp;
            $issue->kelas          = $request->kelas;
            $issue->jurusan        = $request->jurusan;
            // $issue->id_pinjaman    = $request->id_pinjaman;
            $issue->status         = $request->status ?? 'pending';
            $issue->keterangan     = $request->keterangan;
            $issue->book_id        = $request->book_id;
            $issue->save();

            return redirect()->route('book.issueStudent')->with('message', 'Data peminjaman berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function studentEdit(string $id)
    {
        $issueBook = StudentBookIssue::with('book')->find($id);
        return Inertia::render( 'BookIssue/Student/Edit', [
            'issueBook' => $issueBook,
            'books' => Book::all(),
        ]);
    }
    public function studentUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'student_name'     => 'required|string|max:255',
                'apply_date'       => 'required|date',
                'issue_date'       => 'nullable|date',
                'returned_date'    => 'nullable|date',
                'no_kartu_perp'    => 'nullable|string|max:100',
                'kelas'            => 'nullable|string|max:50',
                'jurusan'          => 'nullable|string|max:100',
                'status'           => 'required|string',
                'keterangan'       => 'nullable|string|max:500',
                'book_id'          => 'required|exists:books,id',
            ]);

            $issue = StudentBookIssue::find($id);

            if (!$issue) {
                return redirect()->route('book.issueStudent')->with('error', 'Data tidak ditemukan.');
            }

            $issue->student_name   = $request->student_name;
            $issue->apply_date     = $request->apply_date;
            $issue->issue_date     = $request->issue_date;
            $issue->returned_date  = $request->returned_date;
            $issue->no_kartu_perp  = $request->no_kartu_perp;
            $issue->kelas          = $request->kelas;
            $issue->jurusan        = $request->jurusan;
            $issue->status         = $request->status;
            $issue->keterangan     = $request->keterangan;
            $issue->book_id        = $request->book_id;
            $issue->save();

            return redirect()->route('book.issueStudent')->with('message', 'Data peminjaman berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
