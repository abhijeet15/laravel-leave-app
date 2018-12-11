function _format_date( date )
{
  	var _t = new Date(date)
    var _date = _t.getDate( );
    var _month = _t.getMonth( )+1;
    if( _date < 10 )  _date = "0" + _date;
    if( _month < 10 )  _month = "0" + _month;
    return _t.getFullYear( ) + "-" + _month + "-" + _date;
}

function _checkAccess( page )
{
	if( js_parent_var.user.role == "super_admin" )
		return true;
	/*else if(js_parent_var.user.role == "admin"){
		retun (js_parent_var.access[ js_parent_var.user.role ] == page)
	} else if( js_parent_var.user.role == "employee" ) {

	}*/
	return (js_parent_var.access[ js_parent_var.user.role ] == page)

}

module.exports = {
    _format_date	: _format_date,
    _checkAccess	: _checkAccess,

};