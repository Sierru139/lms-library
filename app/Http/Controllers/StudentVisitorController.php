<?php

namespace App\Http\Controllers;

use App\Models\StudentVisitor;
use App\Http\Requests\StoreStudentVisitorRequest;
use App\Http\Requests\UpdateStudentVisitorRequest;

class StudentVisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentVisitorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentVisitorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentVisitor  $studentVisitor
     * @return \Illuminate\Http\Response
     */
    public function show(StudentVisitor $studentVisitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentVisitor  $studentVisitor
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentVisitor $studentVisitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentVisitorRequest  $request
     * @param  \App\Models\StudentVisitor  $studentVisitor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentVisitorRequest $request, StudentVisitor $studentVisitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentVisitor  $studentVisitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentVisitor $studentVisitor)
    {
        //
    }
}
