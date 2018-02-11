var page = 0;
var search_input = '';
var per_page = 8;
var next_image = 0;
var	image_dir = 'images/main_image/cosmos_'
var	image_ext = '.jpg'
var image_alarm = 5000;
var last_action = 'home';
var total_posts = '';

///!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!                CHANGE CONTENT                      !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$(function(){


    $(window).resize(function(){
        navbar_visibility();
    });
    navbar_visibility();

    $('#logo').on('click',function(){
    	var navbar = $('#navbar');
    	if(navbar.is(':visible')){
    		$('#navbar').hide();
    	}else{
    		$('#navbar').show();
    	}
    	
    })
    


	$('#search_form').submit(function(e){
		e.preventDefault();

		var form_data = new FormData();
		var form_values = $(this).serializeArray();
		

		for(var info in form_values){
			form_data.append(info.name,info.value);
		}
		$(this).find('input').each(function(){
			$(this).val('');
		})
		search_input = form_values[0].value;
		last_action = 'search';
		change_content('search');
	});


	$('#content_buttons').on('click','a',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		(id=='next') ? page++ : page--;
		change_content(last_action);
	});



	$('#nav_ul').on('click','a',function(e){
		e.preventDefault();
		var action = $(this).attr('value');

		if($(window).width() < 768){
    		$('#navbar').hide();   	
		}
		
		if(action!='create'){
			last_action = action;
			page = 0;
			if(action=='home'){
				change_content(action,false);
			}else{
				change_content(action);
			}
						
		}else{
			hide_content();
			$('#create_post').show();
		}

	});


	$('#content').on('click','.item',function(e){
		e.preventDefault();
		///Open Individual Post
		hide_content();
		
		///Add Content to Individual Post According to What was clicked;
		$('#post_image').attr('src',$(this).find('.item_image').attr('src'));
		$('#post_name').html($(this).find('.item_name').html());
		$('#post_price').html($(this).find('.item_price').html());

		$('#individual_post').show();

	});

	$('#go_back').on('click',function(e){
		e.preventDefault();
		change_content(last_action);
	});


	$('#create_post_form').submit(function(e){
		e.preventDefault();
		///Add info to DataBase



		var form_data = new FormData();
		var form_values = $(this).serializeArray();
		for(var info of form_values){
			form_data.append(info.name,info.value);
		}
		var name = form_values[0].value;
		var price = form_values[1].value;
		var type = form_values[2].value;
		var file = $('#form_image')[0].files[0];

		if(name && price && type && file){
			var file_name = $('#form_image')[0].files[0].name;

			if(is_image(file_name)){
				
				if(file_name.length <= 30){

					$(this).find('input').each(function(){
						$(this).val('');
					});

					form_data.append('action','post');
					form_data.append('file',file);
					$.ajax({
						method: 'POST',
						url: 'php/process.php',
						processData: false,  // tell jQuery not to process the data
					    contentType: false,  // tell jQuery not to set contentType
					    data: form_data,
					    success: function(data){
					    	//var result_data = $.parseJSON(data);
					    	last_action = type;
					    	change_content(type);

					    },
					    error: function(){

					    }
					});

				}else{
					alert('File Name is too long');
				}

			}else{
	
				alert('File is not an Image');
			
			}


		}else{
			alert('Fill all Fields');
		}
	});
});



function hide_content(){
	$('#main_image').hide();
	$('#individual_post').hide();
	$('#create_post').hide();
	$('#wrapper').hide();
}


function change_content(action,dont_show){



	hide_content();

	dont_show = (typeof dont_show === 'undefined') ? true : dont_show;

	if(action=='home' && page==0 && !dont_show){
		$('#main_image').show();
	}
	$('#prev').hide();
	$('#next').hide();


	var form_data = new FormData();
	form_data.append('action',action);
	form_data.append('page',page);
	if(action=='search'){
		form_data.append('search_input',search_input);
	}
	$.ajax({
		method: "POST",
		url: "php/process.php",
		processData: false,  // tell jQuery not to process the data
	    contentType: false,  // tell jQuery not to set contentType
	    data: form_data,
		success: function(data){
	
			var result_data = $.parseJSON(data);

			$('#wrapper').hide(0,function(){	

				$('#content').empty();	

				for(var data in result_data){
					if(data==0){
						total_posts = result_data[data].total_posts;
					}else{
						create_post(result_data[data]);
					}				
				}
				if(page>0){
					$('#prev').show();
				}
				if(total_posts>((page+1)*per_page)){
					$('#next').show();
				}
			}).fadeIn(250);			
		},
		error: function(){

		}
	});

};

function create_post(data){
	var name = data.name;
	var price = data.price;
	var image = data.image;
		/*
	<div class='item col-md-3 col-xs-12'>
		<img src='images/post_images/image' class='item_image col-xs-10 col-xs-push-1'>
		<span class='item_name col-xs-10 col-xs-push-1'>$title</span>
		<br>
		<span class='item_price col-xs-10 col-xs-push-1'>$price</span>
	</div>
	*/
	var content = "<div class='item col-md-3 col-xs-12'><img src='images/post_images/"+ image + "' class='item_image col-xs-10 col-xs-push-1'><span class='item_name col-xs-10 col-xs-push-1'>" + name +"</span><br><span class='item_price col-xs-10 col-xs-push-1'>" + price +"</span></div>";
	$('#content').append(content);
}



$(window).on('load',function(){
	setInterval(change_image,image_alarm);
});


function change_image(){


	next_image>=4 ? next_image = 0 : next_image++;

	
	if($('#main_image').is(':visible')){
		$("#main_image").fadeTo(1000,0.3, function() {
			$(this).attr("src",image_dir + next_image + image_ext);	      
		}).fadeTo(1000,1);		
	}

};




function navbar_visibility(){

    if ($(window).width() < 768) {

    	$('#navbar').hide();

    }else{
		$('#navbar').show();
    }

}


function is_image(filename) {
    var ext = get_extension(filename);
    switch (ext.toLowerCase()) {
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
        //etc
        return true;
    }
    return false;
}

function get_extension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}