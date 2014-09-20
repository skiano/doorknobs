var toggleOne = function(elm){

	if($(elm).attr("checked")){
		$(elm).attr({"checked":false});
	}
	else{
		$(elm).attr({"checked":true});
	}

};

var toggleAll = function(elm){

	var select = "";

	if($(elm).hasClass('radio')){
		select = '[type=radio]';
	}
	else if($(elm).hasClass('checkbox'))
	{
		select = '[type=checkbox]';
	}
	else{
		select = '[type=checkbox],[type=radio]';
	}

	$.each($(select),function(i,elm){
		toggleOne(elm);
	});

};

var scrollText = function(){

	$.each($('textarea'),function(i,elm){
		var l = $(elm).text().length;
		$(elm).text(
			 $(elm).text().charAt(l) + $(elm).text().slice(-(l-1))
		);
	});

};



$(document).ready(function(){
	$('button').click(function(){
		toggleAll(this);
	});

	var int = setInterval("scrollText()",200);

	// $('[type=radio]').mouseenter(function(){
	// 	toggleOne(this);
	// });

});