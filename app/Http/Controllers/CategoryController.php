<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Company;

class CategoryController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $categories = Category::getCategories($input);
            return DataTables::of($categories)
                    ->addIndexColumn()
                    ->addColumn('company_name', function($categories) {
                        return $categories->agency->company->company_name;
                    }) 
                    ->addColumn('agency_name', function($categories) {
                        return $categories->agency->agency_name;
                    }) 
                    ->addColumn('name', function($categories) {
                        return $categories->name;
                    }) 
                    ->addColumn('status', function($categories) {
                        $statuses = Category::STATUSES;
                        if($categories->active) {
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
                    ->addColumn('action', function($categories) {
                        $action = '<button id="deleteForm'.$categories->id.'" data-action="' .route('categories.delete',$categories->id) .'" onclick="deleteCompany('.$categories->id.')" type="submit" class="btn btn-danger btn-sm ml-1"><span class="fa fa-trash"></span>
                        </button>';
                        return $action;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }
        return view('category.index');
    } 

    public function create() {
        $companies = Company::getCompanies(['status' => Company::STATUSES_KEY['active']]);
        return view('category.create', compact('companies'));
    }

    public function store(Request $request) {
        $inputs = $request->all();
        $category = Category::createCategory($inputs);
       
        Category::createCategory($inputs);
        return redirect()->route('category.index')
        ->with('success', 'Category created successfully');
    }
}
