"use strict";


$.fn.timepicker.defaults = $.extend(true, {}, $.fn.timepicker.defaults, {
    icons: {
        up: 'la la-angle-up',
        down: 'la la-angle-down'  
    }
});
// Class definition
var AppointmentPageFunc = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var avatar;
	
	// Private functions0
	var initAddAppointment = function () {
		$("#addAppointmentBTN").on("click", function(){
			$(".addServiceCategory").val($(".addServiceCategory option:first").val());
			$(".servicesAdd").empty();
		});

		//$(".addServiceCategory").on("change", function(){
	
		//})
		
	}

	var addNewCustomer = function() {
		$("#addNewCustomer").on("click", function(){
			console.log("Add new customer");
			$("#addNewCustomerModal").modal('show');
		});


		$("#emp_avatar").change(function() {
	      imagePreview(this);
	    });

	    $('#kt-avatar__cancel').click(function(){
	        $('#emp_avatar').val('');
	        $('#emp_avatar_preview').attr('src', '/backend/media/users/default.jpg');
	        $(this).css('display', 'none');
	    });
       /*$("#saveCustomerBtn").on("click", function(){
             $("#addNewcustomer").submit();
       });*/

      $("#addNewcustomer").validate({
		    // Specify validation rules
		    rules: {
		      // The key name on the left side is the name attribute
		      // of an input field. Validation rules are defined
		      // on the right side
		      customer_first_name: "required",
		      customer_last_name: "required",
		      customer_gender: "required",
		      customer_dob:"required",
		      customer_email: {
		        required: true,
		        // Specify that email should be validated
		        // by the built-in "email" rule
		        email: true
		      },
		      customer_phone: {
		        required: true,
		        minlength: 10,
		        maxlength: 14
		      }
		    },
		    // Specify validation error messages
		    messages: {
		      customer_first_name: "Please enter your firstname",
		      customer_last_name: "Please enter your lastname",
		      customer_gender: "Please enter Gender",
		      customer_dob: "Please enter date of birth",
		      customer_phone: {
		        required: "Please provide a phone number",
		        minlength: "Your phone number must be at least 10 numbers long",
		        maxlength: "Your phone number not more than 14 numbers long"
		      },
		      customer_email: "Please enter a valid email address"
		    },
		    // Make sure the form is submitted to the destination defined
		    // in the "action" attribute of the form when valid
		    submitHandler: function(form) {
		      displayLoader();
		       $('#addNewcustomer').ajaxSubmit({
		            url: '/admin/customers/add-customer', 
		            type: "POST",     
		            success: function(data) {
		              hideLoader();
		                if( data.status == 'success'){
		                	$("#selectCustomerAppointment")
							         .append($("<option selected='selected'></option>")
							                    .attr("value",data.user)
							                    .text(data.username)); 
		                    swal.fire({
		                            "title": "Success", 
		                            "text": data.message, 
		                            "type": "success",
		                            "confirmButtonClass": "btn btn-secondary"
		                        }).then(function() {
		                            $("#addNewCustomerModal").modal('hide');
		                          });
		                  }else
		                  {
		                    swal.fire({
		                            "title": "Error", 
		                            "text": data.message, 
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-warning"
		                        });
		                    return false;
		                }
		            },
		            error: function(data){
		              swal.fire({
		                            "title": "Error", 
		                            "text": data.message, 
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-warning"
		                        });
		              return false;
		              // Render the errors with js ...
		            }
		        });
		    }
	   });
		  
	}
    
    var initDatepickerCustommeradd=function() {
	    var t;
	    t={
	        leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
	    };
	        	$('#dob-cstmr').datepicker(
	                {
	                rtl: KTUtil.isRTL(), todayHighlight: !0, orientation: "bottom left",  format: 'MM dd, yyyy', templates: t
	            }     
	        	)
	}

	var initAppointmentSubmit = function() {
		/*$("#saveAppointmentBtn").on("click", function(){
			$("#addAppointmentForm").submit();
		});*/

		$("#addAppointmentForm").validate({
		    // Specify validation rules
		    rules: {
		      // The key name on the left side is the name attribute
		      // of an input field. Validation rules are defined
		      // on the right side
		      customer: "required",
		      serviceCategory: "required",
		      service: "required",
		      appointment_date:"required",
		      appointment_time: {
		        required: true,
		      },
		      customer_phone: {
		        required: true,
		        minlength: 10,
		        maxlength: 14
		      }
		    },
		    // Specify validation error messages
		    messages: {
		      customer: "Please select a customer.",
		      serviceCategory: "Please select a service.",
		    },
		    // Make sure the form is submitted to the destination defined
		    // in the "action" attribute of the form when valid
		    submitHandler: function(form) {
		      displayLoader();
		       $('#addAppointmentForm').ajaxSubmit({
		            url: '/admin/booking/appointments/create', 
		            type: "POST",     
		            success: function(data) {
		              hideLoader();
		                if( data.status == 'success'){
		                    swal.fire({
		                            "title": "Success", 
		                            "text": data.message, 
		                            "type": "success",
		                            "confirmButtonClass": "btn btn-secondary"
		                        }).then(function() {
		                            location.reload();
		                          });
		                  }else
		                  {
		                    swal.fire({
		                            "title": "Error", 
		                            "text": data.message, 
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-warning"
		                        });
		                    return false;
		                }
		            },
		            error: function(data){
		              swal.fire({
		                            "title": "Error", 
		                            "text": data.message, 
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-warning"
		                        });
		              return false;
		              // Render the errors with js ...
		            }
		        });
		    }
	   });
	}
	 
	var initKTAppsUserAdd = function() {
		avatar = new KTAvatar('kt_apps_user_add_user_avatar');
	}

	var initTimepicker = function(){
		 $('#timepicker').timepicker({
            defaultTime: '10:30:20 AM',           
            minuteStep: 1,
            showSeconds: true,
            showMeridian: true
        });
	}	

	var initDatepicker =  function(){
		var t;
		var date = new Date();
            date.setDate(date.getDate());
	    t=KTUtil.isRTL()? {
	        leftArrow: '<i class="la la-angle-right"></i>', rightArrow: '<i class="la la-angle-left"></i>'
	    }
	    : {
	        leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
	    };
		$('#datepicker').datepicker(
                {
                rtl: KTUtil.isRTL(), startDate: date, todayHighlight: !0, orientation: "bottom left",  format: 'MM dd, yyyy', templates: t
            }     
        	)
	}

	return {
		// public functions
		init: function() {
			formEl = $('#kt_apps_user_add_user_form');

			initAddAppointment(); 
			addNewCustomer();
			initAppointmentSubmit();
			initKTAppsUserAdd();
			initDatepicker();
			initTimepicker(); 
			initDatepickerCustommeradd();
		}
	};
}();

jQuery(document).ready(function() {	
	AppointmentPageFunc.init();
});
function imagePreview(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();    
    reader.onload = function(e) {
      $('#emp_avatar_preview').attr('src', e.target.result);
      $('#kt-avatar__cancel').css('display', 'block');
    }    
    reader.readAsDataURL(input.files[0]);
  }
}

 function handleSubmit () {
    $("#addNewcustomer").submit();
}
function getservices(selectObj){
	var targetEl = ".servicesAdd";
	var serviceCat = selectObj.value;
	displayLoader();
    $.ajax({
              type: "POST",
              url: '/admin/booking/services/get',
              data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        serviceCat: serviceCat,
                      },
              dataType: "json",
              success: function( data, textStatus, jQxhr ){
              	hideLoader();
              	if(data.status == 'success'){
              		$(targetEl).empty();
              		$.each(data.serviceData, function(key, value) { 
					     $(targetEl)
					         .append($("<option></option>")
					                    .attr("value",value.id)
					                    .text(value.name)); 
					});
              	}else{
                       $(targetEl).empty();
                        swal.fire({
                        title: 'No Service',
                        text: data.message,
                        type: 'error',
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                       })                 		

              	}

            }
        });
}