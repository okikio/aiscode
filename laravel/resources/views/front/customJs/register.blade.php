<script type="text/javascript">
    const yearDropdownField = $("#yearDropdownField");
    const monthDropdownField = $("#monthDropdownField");
    const dateDropdownField = $("#dateDropdownField");
    window.onload = function () {
        populateYearDropdown();
        populateMonthDropdown();
        populateDateDropdown();
    };
    function populateYearDropdown() {
        //Determine the Current Year.
        const currentYear = new Date().getFullYear()-18;
        //Loop and add the Year values to DropDownList.
        for (let i = currentYear; i >= 1950; i--) {
            const option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            yearDropdownField.append(option);
        }
    }

    function populateMonthDropdown() {
        const monthNames = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
        //Loop and add the Year values to DropDownList.
        for (let i = 0; i < monthNames.length; i++) {
            const option = document.createElement("OPTION");
            option.innerHTML = monthNames[i];
            option.value = i+1;
            monthDropdownField.append(option);
        }
    }

    function populateDateDropdown() {
        dateDropdownField.empty();
        const year = yearDropdownField.val();
        const month = parseInt(monthDropdownField.val());
        //get the last day, so the number of days in that month
        const days = new Date(year, month, 0).getDate();
        //lets create the days of that month
        for (let d = 1; d <= days; d++) {
            const option = document.createElement("OPTION");
            option.innerHTML = d;
            option.value = d;
            dateDropdownField.append(option);
        }
    }

    function onChangeYearAndMonth($event) {
        this.populateDateDropdown();
    }

    $(function () {
        $.validator.setDefaults({
            submitHandler: function () {
            }
        });
        $.validator.addMethod("pwcheck", function(value) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value)
        });
        $.validator.addMethod("validDOB", function(value) {
            var from = value.split("-"); // Y-m-d
            var day = from[2];
            var month = from[1];
            var year = from[0];
            var age = 18;
            var mydate = new Date();
            mydate.setFullYear(year, month-1, day);
            var currdate = new Date();
            var setDate = new Date();
            setDate.setFullYear(mydate.getFullYear() + age, month-1, day);
            if ((currdate - setDate) > 0){
                return true;
            }else{
                return false;
            }
        });
        $('#registerForm').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true
                },
                nick_name: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password : {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                phone_number:{
                    required:true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter a first name"
                },
                last_name: {
                    required: "Please enter a last name"
                },
                email: {
                    required: "Please enter a email"
                },
                nick_name: {
                    required: "Please enter a username"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 6 characters long",
                    pwcheck : "Password must contain at least one capital alphabet, one special character (@, #, $, _, etc.)0 to 9 number and a to z alphabets."
                },
                confirm_password: {
                    required: "Please re-enter password",
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Password does not match"
                },
                phone_number:{
                    required: "Please enter phone number",
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function () {
                var form = $('#registerForm')[0];
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "{{ route('front.register.submit') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: new FormData(form),
                    beforeSend: function() {
                        $(".preloader").css('display','');
                    },
                    success: function(response) {
                        $(".preloader").css('display','none');
                        if (response.status == 'success') {
                            $("#verification").modal('show');
                        } else {
                            toastr.error(response.message)
                        }
                    },
                    error: function(data) {
                        $(".preloader").css('display','');
                        toastr.error(data.message)
                    }
                });
            }
        });
        $('#profile-from').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true
                },
                nick_name: {
                    required: true
                },
                password: {
                    required: false,
                    minlength: 6,
                },
                confirm_password : {
                    required: false,
                    minlength: 6,
                    equalTo: "#password"
                },
                birth_date:{
                    required: true,
                    validDOB : true
                },
                phone_number:{
                    required:true
                }
            },
            messages: {
                name: {
                    required: "Please enter a first name"
                },
                last_name: {
                    required: "Please enter a last name"
                },
                nick_name: {
                    required: "Please enter a username"
                },
                password: {
                    minlength: "Your password must be at least 6 characters long",
                },
                confirm_password: {
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Password does not match"
                },
                birth_date: {
                    required: "Please enter a birth date",
                    validDOB: "Sorry, you must be 18 years of age to apply",
                },
                phone_number:{
                    required: "Please enter phone number",
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function () {
                var form = $('#profile-from')[0];
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "{{ route('front.update-profile') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: new FormData(form),
                    beforeSend: function() {
                        $(".preloader").css('display','');
                    },
                    success: function(response) {
                        $(".preloader").css('display','none');
                        if (response.status == 'success') {
                            toastr.success(response.message)
                        } else {
                            toastr.error(response.message)
                        }
                    },
                    error: function(data) {
                        $(".preloader").css('display','');
                        toastr.error(data.message)
                    }
                });
            }
        });
    });
</script>