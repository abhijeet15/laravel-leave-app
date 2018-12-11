<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\User;
use App\Leave;

use Auth;
class LeaveController extends BaseController
{
   	/**
     * Show the Leaves listing
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        $role = \Auth::user()->role;
    	$data = [
    		"page"=> ( $role == "employee" ) ? "add" : "listing",
    		"backup_users" => User::where( "id", "!=", Auth::user()->id )->get()
    	];
        // $this->toDom( [] );
        $this->toDom( $data );
        return view('leave');
    }

    public function store( LeaveRequest $request )
    {

        $user = Auth::user();

	    return [
            'status'    => true,
            'message'   => "Leave Added Successfully!",
            'data'      => Leave::create( array_merge( [ 'user_id' => $user->id ], $request->all( ) ) )
        ];
    }



    /**
     * This method is to delete
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Leave $leave
     *
     * @return array
     */
    public function delete( Request $request, User $leave  )
    { 
        return [
            'status'    =>  $leave->delete( ),
            'message'   => "Record deleted successfully",
            'data'      => []
        ];
    }
}
