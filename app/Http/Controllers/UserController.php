<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $users = User::getUser($input);
            return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('status', function($users) {
                        $statuses = User::STATUSES;
                        if($users->active) {
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
                    ->addColumn('action', function($users) {
                        $action = '<button id="deleteForm'.$users->id.'" data-action="' .route('users.delete',$users->id) .'" onclick="deleteUser('.$users->id.')" type="submit" class="btn btn-danger btn-sm ml-1"><span class="fa fa-trash"></span>
                        </button>';
                        return $action;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }
        return view('users.index');
    }

    public function create() {
        $userTypes = User::USER_TYPES;
        $companies = Company::get();
        return view('users.create', compact('userTypes', 'companies'));
    }

    public function store(Request $request) {
        $inputs = $request->all();

        $inputs['user_type'] = array_flip(User::USER_TYPES)['Admin'];

        User::createUser($inputs);
        
        return redirect()->route('users.index')
        ->with('success', 'User created successfully');
    }

    public function destroy($id) {
        $response = ['status' => false];

        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json($response);
            }

            // also delete courts on user delete
            $user->delete();

            $response['status'] = true;

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
