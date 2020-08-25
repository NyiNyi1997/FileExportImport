<?php

namespace App\Http\Controllers;

use App\Position;
use PDF;
use Illuminate\Http\Request;
use App\Exports\PositionExport;
use App\Imports\PositionImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $department = DB::table('departments')->get();

        $position= Position::with('department')->simplePaginate(5);
       
        return view('position', ['departments' => $department,'positions'=>$position]);
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
        //
        $data = $request->validate([
            'position_name' => 'required|max:20',
            
        ]);
        
        $position = new Position();
        $position->position_name = $request['position_name'];
        $position->department_id = $request['id'];
        $position->save();

        return redirect('/position');
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

        Excel::import(new PositionImport, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport()
    {

       return Excel::download(new PositionExport, 'EmployeeList.xlsx');
        
    }
    public function fileExportCsv()
    {

       return Excel::download(new PositionExport, 'EmployeeList.csv');
        
    }
    public function createPDF(){

        $data=Position::all();

        //share data to 

        view()->share('position',$data);
        $pdf=PDF::loadView('pdf_position_view',$data);

        return $pdf->download('pdf_file.pdf');
        
    }

}
