$(document).ready(function()
{
	$('#username').bind('blur', function()
	{
		var username = $(this).val();
		var datos = {
			nombre_usuario: username
		};
		$.ajax(
		{
			url: '/users/username_check_ajax',
			type: 'POST',
			data: datos,
			success: function(msg)
			{
				alert(msg);
			}
		});
	});
});