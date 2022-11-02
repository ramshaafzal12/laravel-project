<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AgencyController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $agencies = Agency::getAgencies($input);
            return DataTables::of($agencies)
                    ->addIndexColumn()
                    ->addColumn('company_name', function($agencies) {
                        return $agencies->company->company_name;
                    }) 
                    ->addColumn('status', function($agencies) {
                        $statuses = Agency::STATUSES;
                        if($agencies->active) {
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
                    ->addColumn('action', function($agencies) {
                        $action = '<button id="deleteForm'.$agencies->id.'" data-action="' .route('agencies.delete',$agencies->id) .'" onclick="deleteCompany('.$agencies->id.')" type="submit" class="btn btn-danger btn-sm ml-1"><span class="fa fa-trash"></span>
                        </button>';
                        return $action;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }
        return view('agency.index');
    } 

    public function agencyList($companyId) {
        return Agency::getAgencies(['status' => Agency::STATUSES_KEY['active'], 'company_id' => $companyId]);
    }
}
