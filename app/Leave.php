<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /**
     * The attributes that are hidden.
     *
     * @var array
     */
	protected $hidden = ['updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'from_date', 'to_date', 'reason', 'backup_user_id'
    ];

    /**
     * Eloquent Relation: Leave belongs to User .
     */
    public function user( ) {
        return $this->belongsTo( User::class );
    }

    /**
     * Eloquent Relation: Leave backup user belongs to User .
     */
    public function backup_user( ) {
        return $this->belongsTo( User::class, 'backup_user_id' );
    }

    /**
     * Accessors for get created on
     */
    function getCreatedAtAttribute( $value ) {

        return ( ! empty( $value  ) ) ? date( "Y-m-d", strtotime( $value  ) ) : $value ;
    }
}
