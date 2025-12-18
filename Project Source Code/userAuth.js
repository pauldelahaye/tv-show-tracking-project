$(document).ready(function() {

    $('#signInForm').submit(function(form) {
        form.preventDefault();

        $.post({
            url: 'userAuth.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#signInError').html(response);
            },
            dataType: 'text' });

    });

    $('#signUpForm').submit(function(form) {
        form.preventDefault();

        $.post({
            url: 'userNewAccount.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#signUpError').html(response);
            },
            dataType: 'text' });

    });






});
