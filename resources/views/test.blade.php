<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form class="send_data_wrapper">
    @csrf
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="text" name="phone">
    <button name="submit">submit</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).on("submit", ".send_data_wrapper", function(event){

        event.preventDefault();

        var name = $("input[name=name]", this).val();
        var email = $("input[name=email]", this).val();
        var phone = $("input[name=phone]", this).val();


        $.ajax({
            url:'/api/webhook',
            type: 'POST',
            data: {name: name, email: email, phone: phone},
            success: function (response) {

                console.log(response)

                // if (response.hasOwnProperty("create_success")) {
                //
                //     signUpModal.removeClass("open");
                //     loginModal.addClass("open");
                //
                // }

            }
        });

    })
</script>

</body>
</html>




