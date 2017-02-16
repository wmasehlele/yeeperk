//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});
//JQuery for managing the about us section content
$(function() {
	$('#our-story').hide();
	$('#our-vision').hide();
	$('#story').click('click', function(event){
		//event.preventDefault();
		$('#the-company').hide();
		$('#our-story').show();
		$('#our-vision').hide();
	});
	$('#business').click('click', function(event){ 
		//event.preventDefault();
		$('#the-company').show();
		$('#our-story').hide();
		$('#our-vision').hide();
	});	
	$('#vision').click('click', function(event){
		//event.preventDefault();
		$('#the-company').hide();
		$('#our-story').hide();
		$('#our-vision').show();
	});	
});
//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

//jQuery for contact us page
$(function() {
    $('#client_submit').click('click', function(event) {
    	event.preventDefault();
    	$('#returned_error').text('');
    	$('#returned_success').text('');
    	var postdata = {};
    	postdata.names = $('#client_names').val();
    	postdata.email = $('#client_email').val();
    	postdata.contact_number = $('#client_contact_number').val();
    	postdata.client_type = $('#client_type').val();
    	postdata.reason_for_contact = $('#reason_for_contact').val();
    	postdata.message = $('#client_message').val();
    	postdata.activate_trial = $('#client_want_trial')[0].checked;
    	
    	if (postdata.names=="" || postdata.email=="" || postdata.contact_number=="" || postdata.message==""){
    		$('#returned_error').text('Fill in all the required fields.');
    		return;
    	}
    	if (!validateEmail(postdata.email)){
    		$('#returned_error').text('Provide a valid email.');
    		return;
    	}
    	$.ajax({
			type: "POST",
			url: "web/api-web-contact",
			data: postdata,
			dataType: 'application/json'
    	}).success(function(respdata){
    		$('#returned_success').text('Thank you.');
    	}).error(function(respdata){
    		$('#returned_error').text('Error occured, please try again.');
    	});
    });
});

//jQuery for members login
$(function() {
    $('#login_submit').click('click', function(event) {
    	event.preventDefault();
    	$('#returned_error').text('');
    	$('#returned_success').text('');
    	var postdata = {};
    	postdata.email = $('#login-email').val();
    	postdata.password = $('#login-password').val();
    	if (postdata.password=="" || postdata.email==""){
    		$('#returned_error').text('Fill in all the required fields.');
    		return;
    	}
    	if (!validateEmail(postdata.email)){
    		$('#returned_error').text('Provide a valid email.');
    		return;
    	}
    	$.ajax({
			type: "POST",
			url: "/webcontacts/api-contact-yeeperk",
			data: postdata,
			dataType: 'application/json'
    	}).success(function(respdata){
    		$('#returned_success').text('Logged in successfully...');
    	}).error(function(respdata){
    		$('#returned_error').text('Error occured, please try again.');
    	});
    });
});

function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test( $email );
}
function isNumber(evt) {
	$('#returned_error').text('');
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
   		$('#returned_error').text('Only number are allowed for contact number.');
		return false;
	}
	return true;
}



//# sourceMappingURL=app-main-all.js.map
