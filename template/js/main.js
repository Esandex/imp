$(document).ready(function(){
	 $(".button-collapse").sideNav();
});
function permiso_menu(e, id_menu, id_user)
{
	var check = $(e).prop('checked');
	console.log(check, id_menu, id_user);
	var  url = "../permisoMenu/" + check + "/" + id_user + "/" + id_menu;
	window.location.href = url;
}