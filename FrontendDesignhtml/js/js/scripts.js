$(document).ready(function(){
	$("#createBlock").modal("hide");
	$("createBlockButton").click(function(){
		$("createBlock").modal("hide");
	});
});

$(document).ready(function(){
	$("#updateProfile").modal("hide");
	$("updateProfileButton").click(function(){
		$("updateProfile").modal("hide");
	});
});

var num = 0;
function increment(){
	num++;
	document.getElementById('value').innerHTML = num;
}
function decrement(){
	num--;
	document.getElementById('value').innerHTML = num;
}

var list = document.getElementById('demo');
