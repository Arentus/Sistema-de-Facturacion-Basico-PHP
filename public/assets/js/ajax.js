
$("#addClientForm").on('submit',function(e){

  e.preventDefault();

  $.ajax({
    method : "POST",
    data : $(this).serialize(),
    dataType : "json",
    url : "ajax/createUserHandler.php",
    success : function(res){

    	if(res == true){
    		alert('Usuario agregado');
    	}else{
    		var feedback = '';
    		res.forEach(function(err){
    			feedback += '<li>'+err+'</li>';
    		});

    		$('#errors-feedback').html(feedback);
    	}
    }
  });

});

$("#name").change(function(){
	var username = $(this).val();
	
	if(username == ''){
		$('#username-availability').html('');
	}

	$.ajax({
		url : 'ajax/userExistsHandler.php',
		method : "POST",
		data : {name :username },
		dataType : "json",
		success: function(res){
				console.log(res);
				res ? $('#username-availability').html('Disponible') : $('#username-availability').html('No disponible');
		}
	});
});

$("#email").change(function(){
	var email = $(this).val();
	
	if(email == ''){
		$('#email-availability').html('');
	}

	$.ajax({
		url : 'ajax/emailExistsHandler.php',
		method : "POST",
		data : {email :email},
		dataType : "json",
		success: function(res){
				$('#email-availability').html(res);
								res ? $('#email-availability').html('Disponible') : $('#email-availability').html('No disponible');
		}
	});
});


    $('.pagination li a').on('click', function(){
        $('.clientesData').html('<div class="loader loader--style2" title="1"><svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path fill="#007BFFFF" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/></path></svg></div>');
 
        var page = $(this).attr('data');		
        var dataString = 'page='+page;
 
        $.ajax({
            type: "GET",
            url: "ajax/getClientes.php",
            data: dataString,
            success: function(data) {
                $('.clientesData').fadeIn(2000).html(data);
                $('.pagination li').removeClass('active');
                $('.pagination li a[data="'+page+'"]').parent().addClass('active');
            }
        });
        return false;
    });    



