<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->toDom( ["page"=>"listing"] );
        return view('user');
    }

    /**
     * This method is to change user role.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @param String changerole_to
     *
     * @return array
     */
    public function changerole( Request $request, User $user, $changerole_to  )
    {
        $user->role = $changerole_to;
        $user->save( );

        return [
            'status'    => true,
            'message'   => "Record status changed successfully",
            'data'      => $user->refresh()
        ];

    }

    /**
     * This method is to delete
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     *
     * @return array
     */
    public function delete( Request $request, User $user  )
    { 
        return [
            'status'    =>  $user->delete( ),
            'message'   => "Record deleted successfully",
            'data'      => []
        ];
    }
}
