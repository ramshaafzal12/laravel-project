<?php

namespace App\Http\Controllers;

use App\Models\Stall;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StallController extends Controller
{
    
    public function index(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $stalls = Stall::getStalls($input);
            return DataTables::of($stalls)
                    ->addIndexColumn()
                    ->addColumn('agency_name', function($stalls) {
                        return $stalls->agency->agency_name;
                    }) 
                    ->addColumn('company_name', function($stalls) {
                        return $stalls->company->company_name;
                    }) 
                    ->addColumn('status', function($stalls) {
                        $statuses = Stall::STATUSES;
                        if($stalls->active) {
                            $className = 'success';
                            $status = $statuses[1];
                            $active = array_search($statuses[0], $statuses);
                        } else {
                            $className = 'danger';
                            $status = $statuses[0];
                            $active = array_search($statuses[1], $statuses);
                        }
                        return '<label class="badge badge-'.$className.'" style="cursor:pointer">'.$status.'
                    </label>';
                    })
                    ->addColumn('action', function($stalls) {
                        $action = '<button id="deleteForm'.$stalls->id.'" data-action="' .route('stalls.delete',$stalls->id) .'" onclick="deleteCompany('.$stalls->id.')" type="submit" class="btn btn-danger btn-sm ml-1"><span class="fa fa-trash"></span>
                        </button>';
                        return $action;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }
        return view('stall.index');
    } 

}
