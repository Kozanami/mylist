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


function DoLike(userId, libraryId, link)
{
	if(document.querySelector('#deleteLike'+libraryId)){
		linkLib = link+'/deleteLike';
	}

	if(document.querySelector('#addLike'+libraryId))
	{
		linkLib = link+'/addLike';
	}
	
	$.ajax({
		type: "POST",
		url: linkLib,
		data : {
			user : userId,
			library : libraryId,
		},
		success : function(){
			if($('#deleteLike'+libraryId)){
				
				$('#deleteLike'+libraryId).fadeOut(400, function(){
					$('#deleteLike'+libraryId).fadeIn();
					$('#deleteLike'+libraryId).attr('class', 'far fa-heart');
					$('#deleteLike'+libraryId).attr('id', 'addLike'+libraryId);
				});
			}
			if($('#addLike'+libraryId)){

				$('#addLike'+libraryId).fadeOut(400, function(){
					$('#addLike'+libraryId).fadeIn();
					$('#addLike'+libraryId).attr('class', 'fas fa-heart');
					$('#addLike'+libraryId).attr('id', 'deleteLike'+libraryId);
				});
			}

		},
		error : function(){
      alert("error");
		}
	});


}



