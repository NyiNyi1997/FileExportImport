<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;
use PDF;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $employees = DB::table('employees')->simplePaginate(5);
       // $positions = DB::table('positions')->get();

        $positions= Employee::with('position')->get();


        return view('employee', ['employees' => $employees,'position'=>$positions]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'employee_name' => 'required|max:20',
            'id'=>'required|max:20',
            'salary'=>'required:max:20',
            'email'=>'required:max:20|unique:employees',
        ]);
        
        $employee = new Employee();
        $employee->name = $request['employee_name'];
        $employee->position_id = $request['id'];
        $employee->salary = $request['salary'];
        $employee->email = $request['email'];


        $employee->save();

        return redirect('/employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fileImport(Request $request)
    {

        Excel::import(new EmployeesImport, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport()
    {

       return Excel::download(new EmployeesExport, 'EmployeeList.xlsx');
        
    }

    public function createPDF(){

        $data=Employee::all();

        //share data to 

        view()->share('employee',$data);
        $pdf=PDF::loadView('pdf_view',$data);

        return $pdf->download('pdf_file.pdf');
        
    }
    
    
}
