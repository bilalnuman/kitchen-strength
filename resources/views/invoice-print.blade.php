<!-- invoice-print.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script>
        // This function will automatically print the invoice once the page is loaded
        window.onload = function() {
            var pdfUrl = "{{ $pdfUrl }}"; // Get the PDF URL from Laravel

            // Create an iframe and load the PDF
            var iframe = document.createElement('iframe');
            iframe.style.display = 'none'; // Hide the iframe
            iframe.src = pdfUrl; // Set the source to the generated PDF URL
            document.body.appendChild(iframe);

            // Wait for the PDF to be loaded before triggering the print dialog
            iframe.onload = function() {
                iframe.contentWindow.print(); // Trigger the print dialog
            };
        };
    </script>
</head>

<body>
    <h1>Printing Invoice...</h1>
    <p>Your invoice will be printed shortly. Please wait.</p>
</body>

</html>
