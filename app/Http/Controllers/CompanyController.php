<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $companies = Company::getCompanies($input);
            return DataTables::of($companies)
                    ->addIndexColumn()
                    ->addColumn('status', function($companies) {
                        $statuses = Company::STATUSES;
                        if($companies->active) {
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
                    ->addColumn('action', function($companies) {
                        $action = '<button id="deleteForm'.$companies->id.'" data-action="' .route('companies.delete',$companies->id) .'" onclick="deleteCompany('.$companies->id.')" type="submit" class="btn btn-danger btn-sm ml-1"><span class="fa fa-trash"></span>
                        </button>';
                        return $action;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }
        return view('company.index');
    } 

    public function create() {
        $cities = [
            1 => 'Karachi',
            2 => 'Islamabad',
            3 => 'Lahore'
        ];
        return view('company.create', compact('cities'));
    }

    public function store(Request $request) {
        $inputs = $request->all();
        $company = Company::createCompany($inputs);
        $inputs['company_id'] = $company->id;
        $inputs['user_type'] = array_flip(User::USER_TYPES)['Company'];
        User::createUser($inputs);
        return redirect()->route('company.index')
        ->with('success', 'User created successfully');
    }

    public function destroy($id) {

    }
}
