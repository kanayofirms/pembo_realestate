<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ColourModel;
use PDF;

class ColourController extends Controller
{

    public function change_status(Request $request)
    {
        $item = ColourModel::find($request->id);

        if ($item) {
            $item->status = $request->status;
            $item->save();

            // Return a proper associative array for success
            return response()->json([
                'message' => 'Status Updated Successfully!'
            ]);
        } else {
            // Return a proper associative array for failure
            return response()->json([
                'message' => 'Status Not Found.'
            ], 404);
        }
    }

    public function colour_list(Request $request)
    {
        $data['getRecord'] = ColourModel::getRecordAll();
        return view('admin.colour.list', $data);
    }

    public function add_colour(Request $request)
    {
        return view('admin.colour.add');
    }

    public function store_colour(Request $request)
    {
        $save = new ColourModel;
        $save->name = trim($request->name);
        $save->save();

        return redirect('admin/colour')->with("success", "Colour Successfully Added!");
    }

    public function edit_colour($id)
    {
        $data['getRecord'] = ColourModel::find($id);
        return view('admin.colour.edit', $data);
    }

    public function update_colour($id, Request $request)
    {
        $save = ColourModel::find($id);
        $save->name = trim($request->name);
        $save->save();

        return redirect('admin/colour')->with("success", "Colour Successfully Updated!");
    }

    public function delete_colour($id, Request $request)
    {
        $save = ColourModel::find($id);
        $save->delete();

        return redirect('admin/colour')->with("success", "Colour Successfully Deleted!");
    }

    public function pdf_demo()
    {
        $data = [
            'title' => 'Welcome New PDF pembo.org. An Exciting Ride Awaits You.',
            'date' => date('m-d-Y')
        ];
        $pdf = PDF::loadView('pdf.myPDFDemo', $data);

        return $pdf->download('Pembo.pdf');

    }

    public function pdf_colour()
    {
        $getRecord = ColourModel::get();
        $data = [
            'title' => 'Show All Colour',
            'date' => date('m-d-Y'),
            'getRecord' => $getRecord
        ];

        $pdf = PDF::loadView('pdf.PDFColour', $data);
        return $pdf->download('colour.pdf');
    }

    public function pdf_id($id)
    {
        $getRecord = ColourModel::find($id);

        $data = [
            'title' => 'New PDF Download Pembo.org',
            'date' => date('d-m-Y'),
            'getRecord' => $getRecord
        ];

        $pdf = PDF::loadView('pdf.ColourPDF', $data);
        return $pdf->download('colourid.pdf');
    }
}
