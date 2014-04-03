    $(document).ready(function () {
           $("#planneruser").validate({
            rules: {
                // simple rule, converted to {required:true}
                'ps_bundle_balancebudgetbundle_planner_user[firstname]': "required",
                'ps_bundle_balancebudgetbundle_planner_user[lastname]': "required",
                // compound rule
                'ps_bundle_balancebudgetbundle_planner_user[email]': {
                    required: true,
                    email: true
                },
                'ps_bundle_balancebudgetbundle_planner_user[confirmemail]': {
                    required: true,
                    email: true,
                    equalTo: "#ps_bundle_balancebudgetbundle_planner_user_email"
                },
                'ps_bundle_balancebudgetbundle_planner_user[mobilenumber]': {
                    number: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                'ps_bundle_balancebudgetbundle_planner_user[phonenumber]': {
                    number: true,
                    digits: true
                }

            },
            messages: {
                'ps_bundle_balancebudgetbundle_planner_user[firstname]': {required: "Enter First name"},
                'ps_bundle_balancebudgetbundle_planner_user[lastname]': {required: "Enter Last name"},
                'ps_bundle_balancebudgetbundle_planner_user[email]': {
                    email: "Invalid email address",
                    required:"Enter a email address"
                },
                'ps_bundle_balancebudgetbundle_planner_user[confirmemail]': {
                    email: "Invalid email address",
                    required:"Enter a email address",
                    equalTo:"Enter same email address"
                },
                'ps_bundle_balancebudgetbundle_planner_user[mobilenumber]': {
                    number: "Enter number only",
                    digits: "Enter digits only"                    
                 },
                'ps_bundle_balancebudgetbundle_planner_user[phonenumber]': {
                    number: "Enter number only",
                    digits: "Enter digits only"
                }
            },
            highlight: function (element) {
                $(element).parent().removeClass("field-success").addClass("field-error");
            },
            unhighlight: function (element) {

                $(element).parent().removeClass("field-error").addClass("field-success");
            }
        });
           });


