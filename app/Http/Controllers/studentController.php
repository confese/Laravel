<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $numbersofline = 2;
        if(strlen($keyword)){
            $data = student::where('id','like', "%$keyword%")
            ->orWhere('name','like', "%$keyword%")
            ->orWhere('major','like', "%$keyword%")
            ->paginate($numbersofline);
        }else{
            $data = student::orderBy('id', 'asc')->paginate($numbersofline);
        }
        return view('student.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('id', $request->id);
        Session::flash('name', $request->name);
        Session::flash('major', $request->major);

        $request->validate([
            'id' => 'required|numeric|unique:student,id',
            'name' => 'required',
            'major' => 'required',
        ], [
            'id.required'=>'ID cannot be empty',
            'id.numeric'=>'ID must be a number',
            'id.unique'=>'ID already in datebase',
            'name.required'=>'Name cannot be empty',
            'major.required'=>'Major cannot be empty',
        ]);
        $data = [
            'id'=>$request->id,
            'name'=>$request->name,
            'major'=>$request->major,
        ];
        student::create($data);
        return redirect()->to('student')->with('success', 'Success added data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = student::where('id',$id)->first();
        return view('student.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'major' => 'required',
        ], [
            'name.required'=>'Name cannot be empty',
            'major.required'=>'Major cannot be empty',
        ]);
        $data = [
            'name'=>$request->name,
            'major'=>$request->major,
        ];
        student::where('id',$id)->update($data);
        return redirect()->to('student')->with('success', 'Success edited data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        student::where('id', $id)->delete();
        return redirect()->to('student')->with('success', 'Succes deleted data');
    }
}
