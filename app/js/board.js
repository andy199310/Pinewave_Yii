function post(id)
{
	if(document.getElementById('post').style.display == 'block')
		document.getElementById('post').style.display = 'none';
	else
		document.getElementById('post').style.display = 'block';
	return;
}
function respond(id)
{
	if(document.getElementById('ra'+id).style.display == 'block')
		document.getElementById('ra'+id).style.display = 'none';
	else
		document.getElementById('ra'+id).style.display = 'block';
	return;
}