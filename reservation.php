<?php
session_start();

// Kick out anyone who isn't logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=unauthorized");
    exit();
}

$message = "";
$json_file = 'rooms.json';

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomId = (int)$_POST['room_id'];
    $roomName = $_POST['room_name'];
    $checkIn = $_POST['checkin'];

    if (file_exists($json_file)) {
        $jsonData = file_get_contents($json_file);
        $data = json_decode($jsonData, true);

        if (isset($data['rooms'])) {
            foreach ($data['rooms'] as &$room) {
                if ($room['id'] === $roomId) {
                    if (!in_array($checkIn, $room['bookedDates'])) {
                        $room['bookedDates'][] = $checkIn; 
                    }
                    break; 
                }
            }
            if (file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT))) {
                $message = "Success! Your reservation for the $roomName on $checkIn has been confirmed and saved.";
            } else {
                $message = "Error: Could not save reservation to database.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Reservation - CHMSUOTEL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #1a472a;
            --primary-green-hover: #0f2e1b;
            --text-dark: #0f1b29;
            --bg-light: #f5f5f5;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        body { font-family: var(--font-sans); margin: 0; background-color: #fff; color: var(--text-dark); }
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; height: 80px; padding: 0 5%; }
        .logo { font-family: var(--font-serif); font-size: 1.5rem; text-decoration: none; color: var(--text-dark); font-weight: 500; }
        .res-container { max-width: 900px; margin: 60px auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .res-info h1 { font-family: var(--font-serif); font-size: 3rem; line-height: 1.1; margin-bottom: 20px; }
        .booking-card { background: var(--bg-light); padding: 40px; border-radius: 15px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 500; }
        input, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-family: var(--font-sans); font-size: 1rem; box-sizing: border-box; }
        .btn-confirm { width: 100%; background-color: var(--primary-green); color: white; border: none; padding: 15px; font-size: 0.9rem; font-weight: 500; text-transform: uppercase; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-confirm:hover { background-color: var(--primary-green-hover); }
        .btn-confirm:disabled { background-color: #ccc; cursor: not-allowed; }
        .status-msg { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-size: 0.9rem; border: 1px solid #c3e6cb;}
        @media (max-width: 768px) { .res-container { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<header>
    <div style="display: flex; align-items: center; gap: 30px;">
        <a href="menu.php" class="logo">CHMSUOTEL</a>
        <a href="menu.php" style="text-decoration: none; color: var(--text-light); font-size: 0.8rem; text-transform: uppercase;">← Back to Home</a>
    </div>
    <div class="phone">+63 993 8818 909</div>
</header>


<main class="res-container">
    <div class="res-info">
        <h1>Book Your Sanctuary</h1>
        <p>Select your desired dates to view live availability. Our suites are prepared with meticulous care for your arrival.</p>
        <div style="margin-top: 30px; font-style: italic; color: var(--primary-green);">
            "Experience luxury, comfort, and sophistication at its finest."
        </div>
        
        <div id="dynamic-room-img-container" style="margin-top: 40px; border-radius: 10px; overflow: hidden; height: 250px; display: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            <img id="dynamic-room-img" src="" alt="Selected Room" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>

    <div class="booking-card">
        <?php if ($message): ?>
            <div class="status-msg"><?php echo $message; ?></div>
        <?php endif; ?>

        <form id="resForm" method="POST" action="">
            <div class="form-group">
                <label for="checkin">Check-in Date</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>

            <div class="form-group">
                <label for="room_id">Available Accommodations</label>
                <select id="room_id" name="room_id" required disabled>
                    <option value="">Select a date first...</option>
                </select>
                <input type="hidden" id="room_name" name="room_name">
            </div>

            <div class="form-group">
                <label>Guests</label>
                <select name="guests">
                    <option>1 Guest</option>
                    <option>2 Guests</option>
                    <option>3 Guests</option>
                    <option>4+ Guests</option>
                </select>
            </div>

            <button type="submit" class="btn-confirm" id="submitBtn" disabled>Reserve Now</button>
        </form>
    </div>
</main>

<script>
    const checkinInput = document.getElementById('checkin');
    const roomSelect = document.getElementById('room_id');
    const roomNameInput = document.getElementById('room_name');
    const submitBtn = document.getElementById('submitBtn');
    
    // Elements for dynamic image
    const imgContainer = document.getElementById('dynamic-room-img-container');
    const imgElement = document.getElementById('dynamic-room-img');
    
    let allRooms = []; // Global variable to hold room data

    // Set min date to today
    checkinInput.min = new Date().toISOString().split("T")[0];

    checkinInput.addEventListener('change', async () => {
        const selectedDate = checkinInput.value;
        
        try {
            const response = await fetch('rooms.json');
            const data = await response.json();
            allRooms = data.rooms; // Save data globally

            roomSelect.innerHTML = '<option value="">-- Select a Room --</option>';
            roomSelect.disabled = false;
            imgContainer.style.display = 'none'; // Hide image when date changes
            submitBtn.disabled = true;

            allRooms.forEach(room => {
                const isBooked = room.bookedDates.includes(selectedDate);
                const option = document.createElement('option');
                option.value = room.id;
                option.textContent = `${room.name} ($${room.price || '89'})`;
                
                if (isBooked) {
                    option.disabled = true;
                    option.textContent += " (Occupied)";
                }
                roomSelect.appendChild(option);
            });

        } catch (error) {
            console.error("Error loading availability:", error);
        }
    });

    roomSelect.addEventListener('change', () => {
        // Clean the room name string (removes the price text from being saved to JSON)
        const fullText = roomSelect.options[roomSelect.selectedIndex].text;
        roomNameInput.value = fullText.split(' ($')[0]; 
        
        submitBtn.disabled = !roomSelect.value;

        // DYNAMIC IMAGE LOGIC
        const selectedRoomId = parseInt(roomSelect.value);
        const selectedRoom = allRooms.find(r => r.id === selectedRoomId);
        
        if (selectedRoom && selectedRoom.image) {
            imgElement.src = selectedRoom.image;
            imgContainer.style.display = 'block';
        } else {
            imgContainer.style.display = 'none';
        }
    });
</script>

</body>
</html>