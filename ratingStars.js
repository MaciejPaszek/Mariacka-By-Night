var ratingSend = document.getElementById("ratingSend");
	
if(ratingSend.value != 0)
{
	starClicked(ratingSend.value);
}
	
function polygon(opacity)
{
	return '<polygon name="pol" points="25,0 10,45 49,17 1,17, 40,45" style="fill:rgb(255,255,255, ' + opacity + '%);"></polygon>';
}
	
function starClick(id)
{
	var formRating = document.getElementById("formRating");
	formRating.value = id;
		
	var i;
	
	for(i = 1; i <= id; i++)
	{	
		var star = document.getElementById("formStar" + i)
		star.innerHTML = polygon(100);
	}
		
	for(i; i <= 5; i++)
	{
		var star = document.getElementById("formStar" + i)
		star.innerHTML = polygon(20);
	}
		
	ratingSend.disabled = false;
}