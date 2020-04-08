"use strict";

// Class definition
var KTAppUserAdd = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var avatar;
	
	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('register-an-employee', {
			startStep: 1,
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		})

		// Change event
		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();	
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				// Step 1
				profile_avatar: {
					//required: true 
				},
				profile_first_name: {
					required: true
				},	   
				profile_last_name: {
					required: true
				},
				profile_phone: {
					required: true
				},	 
				profile_email: {
					required: true,
					email: true
				}
			},
			
			// Display error  
			invalidHandler: function(event, validator) {	 
				KTUtil.scrollTop();

				swal.fire({
					"title": "", 
					"text": "There are some errors in your submission. Please correct them.", 
					"type": "error",
					"buttonStyling": false,
					"confirmButtonClass": "btn btn-brand btn-sm btn-bold"
				});
			},

			// Submit valid form
			submitHandler: function (form) {
				
			}
		});   
	}

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					url:  '/admin/employees/add-detail',
					type:  'post',
					dataType : 'json',
					success: function(result) {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

						swal.fire({
							"title": "", 
							"text": "The application has been successfully submitted!"+result, 
							"type": "success",
							"confirmButtonClass": "btn btn-secondary"
						});
					}
				});
			}
		});
	}
	 
	var initKTAppsUserAdd = function() {
		avatar = new KTAvatar('kt_apps_user_add_user_avatar');
	}	

	return {
		// public functions
		init: function() {
			formEl = $('#kt_apps_user_add_user_form');

			initWizard(); 
			initValidation();
			initSubmit();
			initKTAppsUserAdd(); 
		}
	};
}();

jQuery(document).ready(function() {	
	KTAppUserAdd.init();
	KTBootstrapDatepicker.init();
	$("#emp_avatar").change(function() {
	  imagePreview(this);
	});

    $('#kt-avatar__cancel').click(function(){
    	$('#emp_avatar').val('');
    	$('#emp_avatar_preview').attr('src', '/backend/media/users/default.jpg');
    	$(this).css('display', 'none');
    });
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

var KTBootstrapDatepicker=function() {
    var t;
    t=KTUtil.isRTL()? {
        leftArrow: '<i class="la la-angle-right"></i>', rightArrow: '<i class="la la-angle-left"></i>'
    }
    : {
        leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
    }
    ;
    return {
        init:function() {
        	$('#dob-emp').datepicker(
                {
                rtl: KTUtil.isRTL(), todayHighlight: !0, orientation: "bottom left",  format: 'MM dd, yyyy', templates: t
            }     
        	)
        }
    }
}

();