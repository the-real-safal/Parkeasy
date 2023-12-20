<?php
function calculateParkingFee($vehicleType, $hoursParked, $entryTime, $exitTime, $userParkingCount) {
    // Define base rates for each vehicle type
    $rates = [
        'car' => 5.0,
        'truck' => 7.5,
        'van' => 6.0,
    ];

    // Calculate the base fee based on the vehicle type and hours parked
    $baseFee = $rates[$vehicleType] * $hoursParked;

    // Apply time-based rates or discounts
    if ($entryTime >= '08:00' && $exitTime <= '18:00') {
        // Apply normal daytime rate
        $timeBasedFee = $baseFee;
    } else {
        // Apply discounted nighttime rate
        $timeBasedFee = $baseFee * 0.8; // 20% discount for nighttime parking
    }

    // Calculate any additional discounts or promotions here
    // For example, you could check for special promotions

    // Apply the user-specific discount
    if ($userParkingCount > 3) {
        $userDiscount = 0.1; // 10% discount
        $userDiscountFee = $timeBasedFee * $userDiscount;
        $timeBasedFee -= $userDiscountFee;
    }

    // Calculate the total fee
    $totalFee = $timeBasedFee;

    return $totalFee;
}

// Example usage:
$vehicleType = 'car';         // Replace with the actual vehicle type
$hoursParked = 3.5;           // Replace with the actual hours parked
$entryTime = '10:30';         // Replace with the entry time (HH:MM format)
$exitTime = '14:45';          // Replace with the exit time (HH:MM format)
$userParkingCount = 5;        // Replace with the actual parking count for the user

$fee = calculateParkingFee($vehicleType, $hoursParked, $entryTime, $exitTime, $userParkingCount);
echo "The parking fee for a $vehicleType parked for $hoursParked hours from $entryTime to $exitTime is $$fee.";
?>
