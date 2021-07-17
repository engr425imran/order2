/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Stack - Responsive Admin Theme
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Wizard tabs with numbers setup
$(".number-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            $('.template-list .message-box').empty();
    
            return true;
        }
        let schedules_box = $('.schedules-box');
        schedules_box.empty();

        let edit_template_url = $('.template-list').data().editTemplateRoute;     

        if($('.template-list li input.custom-control-input').is(':checked')){
            
            let counter = 1;
            $.each($('.template-list li input.custom-control-input:checked'), async function(i, item){
                let data = $(item).data();

                const template = await $.ajax({
                    url: edit_template_url,
                    type: 'POST',
                    data: { 
                        _token: $("[name=csrf-token]").attr("content"),
                        id : data.id 
                    }
                });

                schedules_box.append(`
                    <div class="row" data-template-id="${data.id}">
                    <div class="col-md-12">
                        <div class="card card-schedule">
                            <div class="card-header">
                                <div class="card-counter">${counter++}</div>
                                <div>
                                    <span>Send Email</span>
                                </div>
                                <div>
                                    <input type="text" name="days[${data.id}][]" class="input-days" value="5">
                                </div>
                                <div>
                                    <span>Days</span>
                                </div>
                                <div>
                                    <select class="select-condition" name="condition[${data.id}][]">
                                        <option value="before">before</option>
                                        <option value="after">after</option>
                                    </select>
                                </div>
                                <div>
                                    <span>invoice is due </span>
                                </div>
                                <div class="delete">
                                    <a href="#" onclick="removeScheduleTemplate(${data.id})"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="template-preview">
                                    <span> ${template.data.template.title} | <strong>Preview</strong></span><hr>
                                    <div class="ql-snow">
                                        <div class="ql-editor">
                                            ${template.data.template.body}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `);
                
            });

            return true;
        }else{
            $('.template-list .message-box').html(`
                <div class="alert alert-danger my-2" role="alert">
                    Please select at least one template.
                </div>
            `);
        }
        
    },
    onFinished: function (event, currentIndex) {
        let redirect_url = $(this).attr('redirect');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp.success){
                    Swal.fire({
                        text: resp.msg,
                        type: 'success'
                    }).then(() => {
                        location.href = redirect_url;
                    });
                }
            }
        });
    
    }
});

// Wizard tabs with icons setup
$(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Vertical tabs form wizard setup
$(".vertical-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    stepsOrientation: "vertical",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Validate steps wizard

// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        if (newIndex === 3 && Number($("#age-2").val()) < 18)
        {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
});

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});


// Initialize plugins
// ------------------------------

// // Pick a date
// $('.pickadate').pickadate();

// // Date & Time Range
// $('.datetime').daterangepicker({
//     timePicker: true,
//     timePickerIncrement: 30,
//     locale: {
//         format: 'MM/DD/YYYY h:mm A'
//     }
// });