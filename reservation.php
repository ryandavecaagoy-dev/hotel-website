


<?php
// PHP logic to handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['room_name'];
    $checkIn = $_POST['checkin'];
    
    // In a real scenario, you would write code here to update your JSON or Database
    $message = "Success! Your reservation for the $roomName on $checkIn has been confirmed.";
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
            --primary-green: #008a13;
            --primary-green-hover: #006b0f;
            --text-dark: #0f1b29;
            --bg-light: #f5f5f5;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            margin: 0;
            background-color: #fff;
            color: var(--text-dark);
        }

        /* Reusing your Header Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
            height: 80px;
            padding: 0 5%;
        }

        .logo {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
        }

        .res-container {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .res-info h1 {
            font-family: var(--font-serif);
            font-size: 3rem;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .booking-card {
            background: var(--bg-light);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: var(--font-sans);
            font-size: 1rem;
            box-sizing: border-box;
        }

        .btn-confirm {
            width: 100%;
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 15px;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-confirm:hover { background-color: var(--primary-green-hover); }
        .btn-confirm:disabled { background-color: #ccc; cursor: not-allowed; }

        .status-msg {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .res-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<header>
    <a href="index.html" class="logo">CHMSUOTEL</a>
    <div class="phone">+63 993 8818 909</div>
</header>

<main class="res-container">
    <div class="res-info">
        <h1>Book Your Sanctuary</h1>
        <p>Select your desired dates to view live availability. Our suites are prepared with meticulous care for your arrival.</p>
        <div style="margin-top: 30px; font-style: italic; color: var(--primary-green);">
            "Experience luxury, comfort, and sophistication at its finest."
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

    // Set min date to today
    checkinInput.min = new Date().toISOString().split("T")[0];

    checkinInput.addEventListener('change', async () => {
        const selectedDate = checkinInput.value;
        
        try {
            // Fetch the JSON file (ensure rooms.json is in the same folder)
            const response = await fetch('rooms.json');
            const data = await response.json();

            roomSelect.innerHTML = '<option value="">-- Select a Room --</option>';
            roomSelect.disabled = false;

            data.rooms.forEach(room => {
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

    // Update hidden room name field when selection changes
    roomSelect.addEventListener('change', () => {
        roomNameInput.value = roomSelect.options[roomSelect.selectedIndex].text;
        submitBtn.disabled = !roomSelect.value;
    });
</script>

</body>
</html>