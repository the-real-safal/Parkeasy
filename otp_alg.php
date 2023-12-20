<!-- Algorithm:

Start with an empty OTP string.

Define a character set that includes letters (A-Z) and numbers (0-9). You can customize this character set as needed.

Initialize a variable ($isLetter) to keep track of whether the next character should be a letter or a number. Set it to true initially, indicating that the first character should be a letter.

Repeat the following steps for the desired OTP length:
a. If $isLetter is true, select a random letter from the character set (A-Z).
b. If $isLetter is false, select a random number from the character set (0-9).
c. Append the selected character to the OTP string.
d. Toggle the $isLetter flag (set it to the opposite value) to alternate between letters and numbers for the next character.

Return the generated OTP string. -->

<!-- --CODE-- -->
<?php
function generateCustomOTP($length) {
    $otp = ''; // Step 1: Start with an empty OTP string.
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Step 2: Define the character set.

    $charCount = strlen($characters);

    // Step 3: Initialize the flag to indicate the first character should be a letter.
    $isLetter = true;

    // Step 4: Repeat for the desired OTP length.
    for ($i = 0; $i < $length; $i++) {
        // Step 4a and 4b: Select a random letter or number based on the flag.
        if ($isLetter) {
            $randomIndex = rand(0, 25); // A-Z
        } else {
            $randomIndex = rand(26, $charCount - 1); // 0-9
        }

        // Step 4c: Append the selected character to the OTP string.
        $otp .= $characters[$randomIndex];

        // Step 4d: Toggle the flag for the next character.
        $isLetter = !$isLetter;
    }

    // Step 5: Return the generated OTP string.
    return $otp;
}

// Example usage:
$customOTP = generateCustomOTP(6); // Generate a custom-style OTP with 6 characters (alternating letters and numbers).
echo "Generated OTP: " . $customOTP;
?>