<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 

// Read the JSON file early so we can pass it to JavaScript later
$json_data = file_get_contents('rooms.json');
$rooms_array = json_decode($json_data, true);
$link = $isLoggedIn ? 'reservation.php' : 'login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSUOTEL - Luxury Hotel</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #1a472a; 
            --primary-green-hover: #0f2e1b;
            --accent-gold: #c5a880;
            --text-dark: #0f1b29;
            --text-light: #444444; 
            --bg-light: #f5f5f5;
            --price-bg: #8b5a2b; 
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-sans); color: var(--text-dark); background-color: #ffffff; line-height: 1.6; }
        img { max-width: 100%; display: block; }

        /* --- Navigation --- */
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; height: 80px; position: sticky; top: 0; z-index: 1000; background-color: #ffffff; }
        .menu-btn { padding: 0 30px; height: 100%; display: flex; flex-direction: column; justify-content: center; gap: 6px; border-right: 1px solid #eaeaea; cursor: pointer; background: none; border: none; border-right: 1px solid #eaeaea;}
        .menu-btn span { display: block; width: 25px; height: 2px; background-color: var(--text-dark); }
        .nav-links { display: none; position: absolute; top: 80px; left: 0; background: white; width: 250px; border: 1px solid #eaeaea; box-shadow: 0 4px 6px rgba(0,0,0,0.05); z-index: 100; }
        .nav-links.active { display: block; }
        .nav-links a { display: block; padding: 15px 30px; text-decoration: none; color: var(--text-dark); border-bottom: 1px solid #eaeaea; transition: background 0.3s; }
        .nav-links a:hover { background: var(--bg-light); color: var(--primary-green); }
        .header-right { display: flex; align-items: center; height: 100%; }
        .phone { font-weight: 500; margin-right: 30px; font-size: 0.9rem; }
        .reservation-btn { background-color: var(--primary-green); color: white; height: 100%; padding: 0 40px; display: flex; align-items: center; gap: 10px; text-transform: uppercase; font-size: 0.8rem; font-weight: 500; text-decoration: none; transition: 0.3s; }
        .reservation-btn:hover { background-color: var(--primary-green-hover); }

        /* --- Hero Section --- */
        .hero { padding: 40px 5%; text-align: center; }
        .hero h1 { font-family: var(--font-serif); font-size: 8rem; font-weight: 400; letter-spacing: -2px; line-height: 1; margin-bottom: 20px; }
        .hero-subtitles { display: flex; justify-content: center; gap: 40px; padding: 0 2%; color: var(--text-light); font-size: 0.9rem; margin-bottom: 50px; text-transform: uppercase; letter-spacing: 1px; }
        .hero-image-wrapper { width: 100%; height: 600px; border-radius: 200px; overflow: hidden; margin: 0 auto; }
        .hero-image-wrapper img { width: 100%; height: 100%; object-fit: cover; }

        /* --- Global Sections --- */
        .section-header { display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; font-size: 0.75rem; font-weight: 500; letter-spacing: 1px; margin-bottom: 40px; border-bottom: 1px dashed #ddd; padding-bottom: 15px; }
        .dots { color: var(--primary-green); font-size: 1.5rem; line-height: 0; letter-spacing: 2px; }

        /* --- Amenities Section --- */
        .amenities { padding: 80px 5%; background-color: var(--bg-light); }
        .amenities h2 { font-family: var(--font-serif); font-size: 3rem; font-weight: 400; margin-bottom: 50px; text-align: center; }
        .amenities-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .amenity-card { text-align: center; }
        .amenity-card img { width: 100%; height: 250px; object-fit: cover; border-radius: 10px; margin-bottom: 15px; }
        .amenity-card h3 { font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px; color: var(--primary-green); }
/* --- Add this inside the <style> tag of menu.php --- */

.diner-image-container {
    position: relative;
    height: 250px; /* Matches your other amenity images */
    margin-bottom: 15px;
    overflow: hidden; /* This is the secret—it clips the zoom! */
    border-radius: 10px;
    cursor: pointer;
}

.diner-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease; /* Smooth "span" effect */
}

.diner-image-container:hover img {
    transform: scale(1.08); /* The zoom amount */
}
        /* --- About Section --- */
        .about { padding: 80px 5%; }
        .about h2 { font-family: var(--font-serif); font-size: 3rem; font-weight: 400; max-width: 800px; line-height: 1.2; margin-bottom: 60px; }
        .about-grid { display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 50px; align-items: center; }
        .about-text { color: var(--text-light); font-size: 0.9rem; }
        .about-image { height: 400px; border-radius: 10px; overflow: hidden; }
        .about-image img { width: 100%; height: 100%; object-fit: cover; }

        /* --- Rooms Section --- */
        .rooms { padding: 80px 5%; }
        .rooms h2 { font-family: var(--font-serif); font-size: 3rem; font-weight: 400; line-height: 1.2; margin-bottom: 50px; max-width: 500px; }
        .rooms-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .room-card { transition: transform 0.3s ease; }
        .room-card:hover { transform: translateY(-5px); }
        .room-image-container { position: relative; height: 350px; margin-bottom: 20px; overflow: hidden; border-radius: 5px; cursor: pointer; }
        .room-image-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .room-card:hover .room-image-container img { transform: scale(1.05); }
        .price-tag { position: absolute; bottom: 0; right: 0; background-color: var(--price-bg); color: white; padding: 12px 20px; text-align: center; }
        .price-tag .small { display: block; font-size: 0.6rem; text-transform: uppercase; }
        .price-tag .amount { font-family: var(--font-serif); font-size: 1.5rem; line-height: 1; }
        .room-title { font-family: var(--font-serif); font-size: 1.5rem; font-weight: 400; margin-bottom: 15px; text-transform: uppercase; cursor: pointer; }
        .room-title:hover { color: var(--primary-green); }
        .room-details { display: flex; gap: 20px; font-size: 0.8rem; color: var(--text-light); }
        .book-room-cta { display: inline-block; margin-top: 15px; font-weight: 500; color: var(--primary-green); text-decoration: none; text-transform: uppercase; font-size: 0.85rem; }

        /* --- MODAL STYLES --- */
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); overflow-y: auto; }
        .modal-content { background-color: white; margin: 5% auto; padding: 40px; border-radius: 10px; width: 90%; max-width: 1000px; position: relative; }
        .close-btn { color: #aaa; position: absolute; top: 20px; right: 30px; font-size: 35px; font-weight: bold; cursor: pointer; }
        .close-btn:hover { color: #000; }
        .modal-title { font-family: var(--font-serif); font-size: 2.5rem; margin-bottom: 15px; color: var(--primary-green); }
        .modal-desc { font-size: 1rem; color: var(--text-light); margin-bottom: 30px; line-height: 1.8; }
        .modal-gallery { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        .modal-gallery img { width: 100%; height: 200px; object-fit: cover; border-radius: 5px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .modal-book-btn { background: var(--primary-green); color: white; padding: 15px 40px; text-decoration: none; font-weight: 500; text-transform: uppercase; border-radius: 4px; display: inline-block; transition: 0.3s; }
        .modal-book-btn:hover { background: var(--primary-green-hover); }

        footer { background: #0f1b29; color: white; text-align: center; padding: 40px 5%; }
        footer p { font-size: 0.9rem; color: #aaa; }

        @media (max-width: 1024px) { .hero h1 { font-size: 6rem; } .hero-image-wrapper { height: 400px; border-radius: 100px; } .about-grid { grid-template-columns: 1fr 1fr; } .about-text:first-child { display: none; } }
        @media (max-width: 768px) { .hero h1 { font-size: 4rem; } .hero-image-wrapper { height: 300px; border-radius: 50px; } .about-grid, .rooms-grid, .amenities-grid, .modal-gallery { grid-template-columns: 1fr; } .modal-content { margin: 15% auto; padding: 25px; } }
    
    </style>
</head>
<body>

    <header>
        <button class="menu-btn" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="nav-links">
            <a href="#home">Home</a>
            <a href="#amenities">Amenities</a>
            <a href="#about">About</a>
            <a href="#rooms">Rooms</a>
            <a href="<?php echo $link; ?>" >Book Now</a>
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" style="color: #d9534f;">Logout</a>
            <?php endif; ?>
        </nav>
        <div class="header-right">
            <span class="phone">+63 993 8818 909</span>
            <a href="<?php echo $link; ?>" class="reservation-btn">&#128197; Reservation</a>
        </div>
    </header>

    <main>
        <section id="home" class="hero">
            <h1>CHMSUOTEL</h1>
            <div class="hero-subtitles">
                <span>Welcome to a world where luxury meets serenity.</span>
                <span>In CHMSUOTEL we care.</span>
            </div>
            <div class="hero-image-wrapper">
                <img src="images/hero.png" alt="Luxury Hotel Skyscraper" loading="lazy">
            </div>
        </section>

        <section id="amenities" class="amenities" style="padding: 80px 5%; background-color: var(--bg-light);">
            <div class="section-header">
                <span class="dots">&#8226;&#8226;&#8226;&#8226;&#8226;</span>
                <span>Exclusive Amenities</span>
            </div>
            <h2 style="font-family: var(--font-serif); font-size: 3rem; font-weight: 400; margin-bottom: 50px; text-align: center;">WORLD-CLASS FACILITIES</h2>
            
           <div class="amenities-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; align-items: start;">
    
    <div class="amenity-card">
        <div style="height: 20px; margin-bottom: 5px;"></div> 
        <img src="images/pool.png" alt="Infinity Pool" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
        <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px; color: var(--primary-green);">Infinity Pool</h3>
        <p style="color: var(--text-light); font-size: 0.9rem;">Relax in our top-floor temperature-controlled pool with panoramic views.</p>
    </div>

    <div class="amenity-card">
        <div style="height: 20px; margin-bottom: 5px;"></div>
        <img src="images/gym.png" alt="Fitness Center" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
        <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px; color: var(--primary-green);">Fitness Center</h3>
        <p style="color: var(--text-light); font-size: 0.9rem;">State-of-the-art skyscraper gym equipped for your wellness routine.</p>
    </div>

    <div class="amenity-card">
    <div style="text-align: right; height: 20px; margin-bottom: 8px;">
        <a href="foodmenu.php#diner-section" style="font-size: 0.7rem; text-transform: uppercase; text-decoration: none; color: var(--primary-green); letter-spacing: 1px; font-weight: 600;">
            VIEW MENU &rarr;
        </a>
    </div>

    <div class="diner-image-container" onclick="window.location.href='foodmenu.php#diner-section'">
        <img src="images/diner.png" alt="Fine Dining">
    </div>
    
    <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px; color: var(--primary-green);">
        <a href="foodmenu.php#diner-section" style="text-decoration: none; color: inherit;">The Skyline Diner</a>
    </h3>
    
    <p style="color: var(--text-light); font-size: 0.9rem;">Experience Michelin-star culinary delights overlooking the city lights.</p>
</div>
</div>
        </section>

        <section id="about" class="about">
            <div class="section-header">
                <span class="dots">&#8226;&#8226;&#8226;&#8226;&#8226;</span>
                <span>About Us</span>
            </div>
            
            <h2>DISCOVER A SANCTUARY OF COMFORT AND SOPHISTICATION CRAFTED TO ELEVATE YOUR TRAVEL EXPERIENCE.</h2>
            
            <div class="about-grid">
                <div class="about-text">
                    <p>Discover a sanctuary of refined comfort and timeless sophistication, thoughtfully designed to elevate every moment of your travel experience.</p>
                </div>
                <div class="about-image">
                    <img src="images/lobby.png" alt="Modern Skyscraper Lobby" loading="lazy">
                </div>
                <div class="about-text">
                    <p>Welcome to our hotel, a place where comfort, elegance, and exceptional hospitality come together to create an unforgettable stay.</p>
                    <a href="#rooms" class="btn-outline">&#8594; Discover Our Rooms</a>
                </div>
            </div>
        </section>

        <section id="rooms" class="rooms">
            <div class="section-header">
                <span class="dots">&#8226;&#8226;&#8226;&#8226;&#8226;</span>
                <span>Luxury Rooms</span>
            </div>
            <h2>WHERE LUXURY MEETS UNFORGETTABLE MOMENTS</h2>

            <div class="rooms-grid">
                <?php
                if (isset($rooms_array['rooms'])) {
                    foreach ($rooms_array['rooms'] as $room) {
                        echo '
                        <div class="room-card">
                            <div class="room-image-container" onclick="openRoomModal(' . $room['id'] . ')">
                                <img src="' . $room['image'] . '" alt="' . $room['name'] . '" loading="lazy">
                                <div class="price-tag">
                                    <span class="small">Per Night</span>
                                    <span class="amount">$' . $room['price'] . '</span>
                                </div>
                            </div>
                            <h3 class="room-title" onclick="openRoomModal(' . $room['id'] . ')">' . $room['name'] . '</h3>
                            <div class="room-details">
                                <div class="detail-item">&#128101; ' . $room['guests'] . ' Guests</div>
                                <div class="detail-item">&#128207; ' . $room['room_size'] . ' ft. Room</div>
                                <div class="detail-item">&#128705; ' . $room['bath_size'] . ' ft. Bathroom</div>
                            </div>
                            <a href="' . $link . '" class="book-room-cta">Book Room &rarr;</a>
                        </div>';
                    }
                }
                ?>
            </div>     
        </section>
    </main>

    <div id="roomModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeRoomModal()">&times;</span>
            <h2 id="modalTitle" class="modal-title">Room Name</h2>
            <p id="modalDesc" class="modal-desc">Room Description...</p>
            
            <div class="modal-gallery">
                <div>
                    <img id="modalImg1" src="" alt="Bedroom">
                    <p style="text-align:center; font-size:0.8rem; margin-top:5px; text-transform:uppercase;">Bedroom</p>
                </div>
                <div>
                    <img id="modalImg2" src="" alt="Bathroom">
                    <p style="text-align:center; font-size:0.8rem; margin-top:5px; text-transform:uppercase;">Bathroom</p>
                </div>
                <div>
                    <img id="modalImg3" src="" alt="Living Area">
                    <p style="text-align:center; font-size:0.8rem; margin-top:5px; text-transform:uppercase;">Living/Kitchen</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="<?php echo $link; ?>" class="modal-book-btn">Proceed to Reservation</a>
            </div>
        </div>
    </div>

    <footer>
        <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px;">CHMSUOTEL</h3>
        <p>&copy; 2024 CHMSUOTEL. All rights reserved.</p>
        <p style="margin-top: 5px;">Developed by Sikma Bois • For Laboratory Purposes</p>
    </footer>

    <script>
        // Menu Toggle
        const menuBtn = document.querySelector('.menu-btn');
        const nav = document.querySelector('.nav-links');
        menuBtn.addEventListener('click', () => { nav.classList.toggle('active'); });
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => { nav.classList.remove('active'); });
        });

        // MODAL LOGIC
        // We pass the PHP JSON data directly into our JavaScript!
        const allRoomsData = <?php echo json_encode($rooms_array['rooms']); ?>;
        const modal = document.getElementById("roomModal");

        function openRoomModal(roomId) {
            // Find the specific room clicked
            const room = allRoomsData.find(r => r.id === roomId);
            if(room) {
                // Populate the modal with the room's data
                document.getElementById('modalTitle').innerText = room.name;
                document.getElementById('modalDesc').innerText = room.description;
                
                // Set the 3 gallery images
                document.getElementById('modalImg1').src = room.gallery[0];
                document.getElementById('modalImg2').src = room.gallery[1];
                document.getElementById('modalImg3').src = room.gallery[2];

                // Show the modal
                modal.style.display = "block";
            }
        }

        function closeRoomModal() {
            modal.style.display = "none";
        }

        // Close modal if user clicks anywhere outside of the white box
        window.onclick = function(event) {
            if (event.target == modal) {
                closeRoomModal();
            }
        }
    </script>
</body>
</html>