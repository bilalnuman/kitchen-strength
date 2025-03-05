<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Invoice</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Roboto", serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings: "wdth" 100;
        }

        .form-container {
            width: 400px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            padding: 1rem;
        }

        .form-container h1 {
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            text-align: center
        }

        .form-container input,
        .form-container button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #dcdcdc;
        }

        .form-container button {
            margin-top: 1rem;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #007bffe4 !
        }

        .disabled {
            opacity: .5;
            pointer-events: none
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Print Invoice</h1>
        <input type="text" id="printer_ip" placeholder="Enter Printer IP (e.g., 192.168.1.100)" />
        <br>
        <button id="print_button">
            Print Invoice
        </button>
        <p id="response_message"></p>
    </div>

    <script>
        $(document).ready(function() {
            $("#print_button").click(function() {
                var printerIp = $("#printer_ip").val();
                if (!printerIp) {
                    alert("Please enter the printer's IP address.");
                    return;
                }

                $(this).addClass('disabled').text('Printing...')
                $("#response_message").text('').css({
                    "margin-top": "0"
                });

                $.ajax({
                    url: "{{ route('print.invoice') }}",
                    type: "POST",
                    data: {
                        printer_ip: printerIp,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $("#response_message").text(response.message).css("color", "green");
                        $(this).removeClass('disabled').text('Printed')
                    },
                    error: function(xhr) {

                        $('#print_button').removeClass('disabled').text('Print Invoice')
                        $("#response_message").text(xhr.responseJSON.message).css({
                            "color": "red",
                            "margin-top": "1rem"
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
