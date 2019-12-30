let b_focus_status = null
	a_check_focus = [];

$(document).ready(function ()
{

//	window.statusEl = document.getElementById('status');
	window.b_focus_status = document.hasFocus();

	checkFocus();
	setInterval(checkFocus, 200);

});


function checkFocus()
{
	if(document.hasFocus() == b_focus_status) return;

	b_focus_status = !b_focus_status;

	if (b_focus_status)
		for (i = 0; i < a_check_focus.length; i++)
		{
			a_check_focus[i]();
		}
}
