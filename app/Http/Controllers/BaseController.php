<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JavaScript;

class BaseController extends Controller
{
    
    protected $data;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function toDom( $input = array( ) )
    {
        /*if( ! is_array( $input ) )
            $input = array( );*/

         if( ! is_array( $this->data ) )
            $this->data = array( );

        JavaScript::put( array_merge( $input, $this->data, [
            'base_url' => url( '' ),
            'access' => config( "admin.access" ),
            'user' => \Auth::user( ),
            'role_types' => config( "admin.types" ),
            'app'  => [ 
                        'name' => config( 'app.name' ),
                        'site_name' => config( 'app.site_name' ),
            ]

        ] ) );
    }

}
