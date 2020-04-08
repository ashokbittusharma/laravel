jQuery(document).ready(function() { 
 if($('#add-customers-page').length) {
    KTBootstrapDatepickerCustommeradd.init();
    $("#emp_avatar").change(function() {
      imagePreview(this);
    });

    $('#kt-avatar__cancel').click(function(){
        $('#emp_avatar').val('');
        $('#emp_avatar_preview').attr('src', '/backend/media/users/default.jpg');
        $(this).css('display', 'none');
    });

   $("#add-customers-page").validate({
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
       $('#add-customers-page').ajaxSubmit({
            url: '/admin/customers/add-customer', 
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
                            window.location = "/admin/customers";
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
var KTBootstrapDatepickerCustommeradd=function() {
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
        	$('#dob-cstmr').datepicker(
                {
                rtl: KTUtil.isRTL(), todayHighlight: !0, orientation: "bottom left",  format: 'MM dd, yyyy', templates: t
            }     
        	)
        }
    }
}();

