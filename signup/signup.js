$(document).ready(function () {


    $("#signup-form").on("submit", function (event) {
        event.preventDefault();

        let request = $.ajax({
            url: '/signup.php',
            type: 'POST',
            data: $(this).serialize()
        });
        request.done(function (response) {
            if (response) {
                console.log('succes');
            } else {
                console.log('fout');
            }
        });
    });

    $("#login-form").on("submit", function (event) {
        event.preventDefault();

        let request = $.ajax({
            url: '/login.php',
            type: 'POST',
            data: $(this).serialize()
        });
        request.done(function (jsonResponse) {
            let response = JSON.parse(jsonResponse);
            if (response.hasError) {
                console.log('ERROR');
                console.log(response.message);
            } else {
                console.log('SUCCES');
                console.log(response.message);
            }
        });
    });

    $("#logout").on("click", function () {

        let request = $.ajax({
            url: '/logout.php'
        });
        request.done(function (jsonResponse) {
            let response = JSON.parse(jsonResponse);
            if (response.hasError) {
                console.log('ERROR');
                console.log(response.message);
            } else {
                console.log('SUCCES');
                console.log(response.message);
            }
        });
    });


});
