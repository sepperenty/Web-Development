

if( $("#uploadBtn").length && $("#uploadFile").length)
{
	document.getElementById("uploadBtn").onchange = function () {
document.getElementById("uploadFile").value = this.value;
};
}


$(".voting").hide();

$(document).ready(function(){
	$(".uploadPicture").hover(function(){

		$(this).find(".voting").show();
	
	});

	$(".uploadPicture").mouseleave(function(){

		$(this).find(".voting").hide();
	
	});
})