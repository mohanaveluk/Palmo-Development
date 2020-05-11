
$(document).ready(function(){
	$('.banner-fade').DrSlider({
		'transition': 'fade',
		'showControl': true,
		'showNavigation': false,
		'progressColor': 'rgba(9, 57, 81, 1)'
	});

	var scrollLink = $('.scroll');
	//smooth scrolling
	scrollLink.click(function(e)	{
		e.preventDefault();	
		console.log($(".navbar").height());
		$('body, html').animate({
			scrollTop:$(this.hash).offset().top - $(".navbar").height() -10
			//$(".navbar-collapse").css({ maxHeight: $(window).height() - $(".navbar-header").height() + "px" });
		}, 1000);
	});
	
	//Active link switching
	$(window).scroll(function(){
		var scrollbarLocation = $(this).scrollTop();

		scrollLink.each(function(){
			var sectionOffset = $(this.hash).offset().top - $(".navbar").height() - 20;
			
			if(sectionOffset <= scrollbarLocation){
				 $(this).parent().addClass('active');
				 $(this).parent().siblings().removeClass('active');
			}
		});
		
		if(scrollbarLocation)		{
			$('nav').addClass('sticky-top');
		}
		else{
			$('nav').removeClass('sticky-top');
		}
	});
	
	$('#txtname').on('input', function() {
		this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, ''); //<-- replace all other than given set of values
	});

	$('#txtemail1').on('input', function() {
		this.value = this.value.replace(/[^a-zA-Z0-9_@.-]/g, ''); //<-- replace all other than given set of values
		//this.value = this.value.replace(/[a-zA-Z0-9_\.\-]+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/g, ''); //<-- replace all other than given set of values
	});

	$('#txtemail').on('keyup', function(){
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
		//console.log('It\'s'+ (valid?'':' not') +' valid');
		if(!valid)
		{
			showAlert('Please enter valid email id', 'error');
			ValidateInput('txtemail', false)
		}
		else
		{
			$('#div-alert').removeClass();
			$('#div-alert').hide();
			ValidateInput('txtemail', true)
		}
	});

	$('#txtmobile').on('input', function() {
		this.value = this.value.replace(/[^0-9]/g, ''); //<-- replace all other than given set of values		
	});
  
	$('#btnSubmit').click(function() {
		
		$('#div-alert').removeClass();
		$('#div-alert').hide();
		
		var sName = $('#txtname').val();
		var sEmail = $('#txtemail').val();
		var sMobile = $('#txtmobile').val();
		var sMessage = $('#txtmessage').val();
		

		if(sName==='')
		{
			showAlert('Please enter your name', 'error', 'txtname');
			$('#txtname').focus();
			return false;
		}
		
		if(sEmail === '')
		{
			showAlert('Please enter your email', 'error');
			$('#txtemail').focus();
			return false;
		}
		else
		{
			var res = IsEmail(sEmail)
			if(!res)
			{
				showAlert('Please enter valid email id', 'error');
				$('#txtemail').focus();
				return false;
			}
		}
		
		if(sMobile !== '' && sMobile.length <10)
		{
			showAlert('Please enter valid mobile number', 'error');
			$('#txtmobile').focus();
			return false;
		}
		
		if(sMessage === '')
		{
			showAlert('Please enter your message', 'error');
			$('#txtmessage').focus();
			return false;
		}
		
		setLoading($(this)[0].id);

		if (sEmail !== "" && sMessage !== "") {
			try {
				var jsondata = ''; 
				$.ajax({
					type: "POST",
					url: "/contact/add",
					data: {userName:sName, userEmail:sEmail, userPhone:sMobile, userMessage:sMessage},
					//contentType: "application/json; charset=utf-8",
					dataType: "JSON",
					success: OnSuccessWinService,
					failure: function(response) {
						showAlert(response.message, "error");

						clearLoading($(this)[0].id);
						
						alert(response.status);
					}
				})

			} catch (e) {
				clearLoading($(this)[0].id);
				
				console.log(e);
				$('#lblDateError').html(e.message);
			}
		}

	});
	
});

function initMap() {
	var uluru = {lat: 13.0985763, lng: 80.1759753};
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 14,
	  center: uluru
	});
	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map
	});
  }

function OnSuccessWinService(response) {
    //alert(response.d);
    try {
	
        if (response !== '' && response.status) {
			showAlert(response.message,'success');
        } else {
            showAlert(response.message, "error");
        }
    } catch (e) {
		
		clearLoading('btnSubmit');
        showAlert(e, "error");
		return false;
    }
	
	clearLoading('btnSubmit');

}  
  
function showAlert(text, alertMode, ctrl) {
    $('#div-alert').show();

    if (alertMode === "error") {
        $('#div-alert').removeClass().addClass('alert alert-danger');
    } else if (alertMode === "success") {
        $('#div-alert').removeClass().addClass('alert alert-success');
    } else {
        $('#div-alert').removeClass().addClass('alert alert-warning');
    }
    $('#label-alert').html(text).fadeIn('fast');
	
}  

function ValidateInput(ctrl, isValid)
{
	if(!isValid)
		$('#'+ctrl).removeClass().addClass('form-control is-invalid');
	else
		$('#'+ctrl).removeClass().addClass('form-control');
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

var setLoading = function (ctrl) {
  var search = $('#'+ctrl);
  if (!search.data('normal-text')) {
    search.data('normal-text', search.html());
  }
  search.html(search.data('loading-text'));
  search.prop('disabled',true);
};

var clearLoading = function (ctrl) {
  var search = $('#'+ctrl);
  search.html(search.data('normal-text'));
  search.prop('disabled',false);
};
