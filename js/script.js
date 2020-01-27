function changeUrl(url) {

	var pathName = window.location.pathname; 
	pathName = pathName.split('/');
	var folder = pathName[1];


	if(location.hostname === "localhost" || location.hostname === "127.0.0.1")
	{
		history.replaceState(null,null,window.location.protocol + "//" + window.location.host +'/'+folder+'/'+url); // localhost
	}
	else
	{
		history.replaceState(null,null,window.location.protocol + "//" + window.location.host +'/'+url); // OVH
	}
}
