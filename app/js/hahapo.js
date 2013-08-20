window.onload = function()
{
	document.getElementsByTagName('body')[0].innerHTML += '<div id="chatbox"><div id="chatBu">顯示或隱藏聊天視窗</div></div>';

	chatbox_id = 329;
	chatbox_width = 630;
	chatbox_height = 380;
	var s=document.getElementsByTagName("script");
	var t=s[s.length-1];
	var i=document.createElement("iframe");
	i.src="http://www.hahapo.com/chatbox/init.php?chatbox_id=" + chatbox_id + "&chatbox_width="  + chatbox_width + "&chatbox_height=" + chatbox_height;
	i.width=chatbox_width;
	i.height=chatbox_height;
	i.vspace=0;
	i.hspace=0;
	i.allowTransparency="true";
	i.scrolling="no";
	i.marginWidth=0;
	i.marginHeight=0;
	i.frameBorder=0;
	i.style.border=0;
	document.getElementById('chatbox').appendChild(i);
	document.getElementById('chatBu').onclick = function()
	{
		if(document.getElementById('chatbox').style.left == '0px')
			document.getElementById('chatbox').style.left = '-630px';
		else
			document.getElementById('chatbox').style.left = '0px';
	}
}