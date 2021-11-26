$('#submitButton').click(function() {

    var name = $("#name");
    var email = $("#email");
    var subject = $("#subject");
    var body = $("#body");

    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {

        $.ajax({
            url: 'PHPMailer/sendEmail.php',
            method: 'POST',
            datatype: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                subject: subject.val(),
                body: body.val()
            }, success: function (response) {

                console.log(response);
                
                $('#messageConfirmation').html("<div class='alert alert-success' role='alert'>Your message was succesfully sent! </div>");

                $("#submitButton").attr("disabled", true);

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);

                $('#messageConfirmation').html("<div class='alert alert-danger' role='alert'>MEEEEEC! Your message could not be sent </div>");

                $("#submitButton").attr("disabled", true);
            }


        });

    }
});

function isNotEmpty(caller) {
    if (caller.val() == "") {
        caller.css('border', "1px solid red");
        return false;
    } else {
        caller.css('border', "");

    }
    return true;
}