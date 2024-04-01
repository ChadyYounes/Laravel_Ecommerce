<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/otp.css") }}">
</head>
<body>
    <form class="container" action="{{ route('verify-otp') }}" method="post" onsubmit="return validateForm()">

        @csrf 
        <h1>ENTER OTP</h1>
        <div class="userInput">
            <input type="text" name="first_digit" id="ist" maxlength="1" onkeyup="clickEvent(this, 'sec')" required>
            <input type="text" name="second_digit" id="sec" maxlength="1" onkeyup="clickEvent(this, 'third')" required>
            <input type="text" name="third_digit" id="third" maxlength="1" onkeyup="clickEvent(this, 'fourth')" required>
            <input type="text" name="fourth_digit" id="fourth" maxlength="1" onkeyup="clickEvent(this, 'fifth')" required>
            <input type="text" name="fifth_digit" id="fifth" maxlength="1" required>
        </div>
        <button type="submit">CONFIRM</button>
    </form>
    <script type="text/javascript">
        function clickEvent(first, last) {
            if (first.value.length) {
                document.getElementById(last).focus();
            }
        }

        function validateForm() {
            var firstDigit = document.getElementById('ist').value;
            var secondDigit = document.getElementById('sec').value;
            var thirdDigit = document.getElementById('third').value;
            var fourthDigit = document.getElementById('fourth').value;
            var fifthDigit = document.getElementById('fifth').value;

            
            if (!firstDigit || !secondDigit || !thirdDigit || !fourthDigit || !fifthDigit) {
                alert('Please enter all digits of the OTP.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
