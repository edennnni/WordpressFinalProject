<?php
// Data file paths
define('CARS_FILE', __DIR__ . '/../data/cars.json');
define('CONTACTS_FILE', __DIR__ . '/../data/contacts.json');
define('BOOKINGS_FILE', __DIR__ . '/../data/bookings.json');

// Helper function to read JSON file
function readJsonFile($file) {
    if (!file_exists($file)) {
        return [];
    }
    $content = file_get_contents($file);
    return json_decode($content, true) ?: [];
}

// Helper function to write JSON file
function writeJsonFile($file, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    return file_put_contents($file, $json) !== false;
}

// Get all cars with optional filters
function getCars($type = '', $make = '', $search = '') {
    $cars = readJsonFile(CARS_FILE);
    
    // Filter available cars
    $cars = array_filter($cars, function($car) {
        return $car['available'] === true;
    });
    
    // Apply type filter
    if (!empty($type)) {
        $cars = array_filter($cars, function($car) use ($type) {
            return strcasecmp($car['type'], $type) === 0;
        });
    }
    
    // Apply make filter
    if (!empty($make)) {
        $cars = array_filter($cars, function($car) use ($make) {
            return strcasecmp($car['make'], $make) === 0;
        });
    }
    
    // Apply search filter
    if (!empty($search)) {
        $cars = array_filter($cars, function($car) use ($search) {
            return stripos($car['make'], $search) !== false || 
                   stripos($car['model'], $search) !== false;
        });
    }
    
    return array_values($cars);
}

// Get bestseller cars
function getBestsellerCars() {
    $cars = readJsonFile(CARS_FILE);
    
    $bestsellers = array_filter($cars, function($car) {
        return $car['is_bestseller'] === true && $car['available'] === true;
    });
    
    return array_values(array_slice($bestsellers, 0, 6));
}

// Get car by ID
function getCarById($id) {
    $cars = readJsonFile(CARS_FILE);
    
    foreach ($cars as $car) {
        if ($car['id'] == $id) {
            return $car;
        }
    }
    
    return null;
}

// Save contact form
function saveContact($name, $email, $subject, $message) {
    $contacts = readJsonFile(CONTACTS_FILE);
    
    $newContact = [
        'id' => count($contacts) + 1,
        'name' => htmlspecialchars($name),
        'email' => htmlspecialchars($email),
        'subject' => htmlspecialchars($subject),
        'message' => htmlspecialchars($message),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $contacts[] = $newContact;
    
    return writeJsonFile(CONTACTS_FILE, $contacts);
}

// Get unique car makes
function getCarMakes() {
    $cars = readJsonFile(CARS_FILE);
    $makes = array_unique(array_column($cars, 'make'));
    sort($makes);
    return $makes;
}

// Get unique car types
function getCarTypes() {
    $cars = readJsonFile(CARS_FILE);
    $types = array_unique(array_column($cars, 'type'));
    sort($types);
    return $types;
}

// Save booking
function saveBooking($carId, $customerName, $customerEmail, $customerPhone, $pickupDate, $returnDate, $totalPrice) {
    $bookings = readJsonFile(BOOKINGS_FILE);
    
    $newBooking = [
        'id' => count($bookings) + 1,
        'car_id' => $carId,
        'customer_name' => htmlspecialchars($customerName),
        'customer_email' => htmlspecialchars($customerEmail),
        'customer_phone' => htmlspecialchars($customerPhone),
        'pickup_date' => $pickupDate,
        'return_date' => $returnDate,
        'total_price' => $totalPrice,
        'status' => 'pending',
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $bookings[] = $newBooking;
    
    return writeJsonFile(BOOKINGS_FILE, $bookings);
}
?>