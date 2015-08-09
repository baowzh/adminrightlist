/**
 * 
 */
var setprojectinfo=function(adminjsoninfo){
	$('#departid').val(adminjsoninfo[0].departid);
	$('#classcode').val(adminjsoninfo[0].classcode);
	$('#parentid').val(adminjsoninfo[0].parentid);
	$('#parentname').val(adminjsoninfo[0].parentname);
}