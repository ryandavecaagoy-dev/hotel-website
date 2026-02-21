<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CHMSUOTEL - Experience luxury, comfort, and sophistication at its finest.">
    <meta name="keywords" content="hotel, luxury, accommodation, travel, CHMSUOTEL">
    <meta name="author" content="Red and Team XG">
    <title>CHMSUOTEL - Luxury Hotel</title>
    
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    
    <style>
        /* CSS Variables */
        :root {
            --primary-green: #008a13;
            --primary-green-hover: #006b0f;
            --text-dark: #0f1b29;
            --text-light: #555;
            --bg-light: #f5f5f5;
            --price-bg: #b05c4a;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text-dark);
            background-color: #ffffff;
            line-height: 1.6;
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* Accessibility Focus States */
        a:focus, button:focus, input:focus, select:focus {
            outline: 2px dashed var(--primary-green);
            outline-offset: 3px;
        }

        /* --- Navigation --- */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
            height: 80px;
            position: relative;
        }

        .menu-btn {
            padding: 0 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 6px;
            border-right: 1px solid #eaeaea;
            cursor: pointer;
            transition: opacity 0.3s ease;
            background: none;
            border-top: none;
            border-bottom: none;
            border-left: none;
        }

        .menu-btn:hover {
            opacity: 0.7;
        }

        .menu-btn span {
            display: block;
            width: 25px;
            height: 2px;
            background-color: var(--text-dark);
        }

        .nav-links {
            display: none; /* Hidden by default, toggled via JS */
            position: absolute;
            top: 80px;
            left: 0;
            background: white;
            width: 250px;
            border: 1px solid #eaeaea;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            z-index: 100;
        }

        .nav-links.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .nav-links a {
            display: block;
            padding: 15px 30px;
            text-decoration: none;
            color: var(--text-dark);
            border-bottom: 1px solid #eaeaea;
            transition: background 0.3s;
        }

        .nav-links a:hover {
            background: var(--bg-light);
            color: var(--primary-green);
        }

        .header-right {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .phone {
            font-weight: 500;
            margin-right: 30px;
            font-size: 0.9rem;
        }

        .reservation-btn {
            background-color: var(--primary-green);
            color: white;
            height: 100%;
            padding: 0 40px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .reservation-btn:hover {
            background-color: var(--primary-green-hover);
        }

        /* --- Hero Section --- */
        .hero {
            padding: 40px 5%;
            text-align: center;
        }

        .hero h1 {
            font-family: var(--font-serif);
            font-size: 8rem;
            font-weight: 400;
            letter-spacing: -2px;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 20px;
        }

        .hero-subtitles {
            display: flex;
            justify-content: space-between;
            padding: 0 2%;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-image-wrapper {
            width: 100%;
            height: 600px;
            border-radius: 200px;
            overflow: hidden;
            margin: 0 auto;
        }

        .hero-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- Global Section Styles --- */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 1px;
            margin-bottom: 40px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 15px;
        }

        .dots {
            color: var(--primary-green);
            font-size: 1.5rem;
            line-height: 0;
            letter-spacing: 2px;
        }

        /* --- About Section --- */
        .about {
            padding: 80px 5%;
        }

        .about h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            font-weight: 400;
            max-width: 800px;
            line-height: 1.2;
            margin-bottom: 60px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .about-text {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .about-image {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: var(--primary-green);
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 20px;
            border-radius: 2px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-outline:hover {
            background-color: var(--primary-green-hover);
        }

        /* --- Luxury Rooms Section --- */
        .rooms {
            background-color: var(--bg-light);
            padding: 80px 5%;
        }

        .rooms h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            font-weight: 400;
            line-height: 1.2;
            margin-bottom: 50px;
            max-width: 500px;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .room-card {
            background: transparent;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .room-image-container {
            position: relative;
            height: 350px;
            margin-bottom: 20px;
            overflow: hidden;
            border-radius: 5px;
        }

        .room-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .room-card:hover .room-image-container img {
            transform: scale(1.05);
        }

        .price-tag {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: var(--price-bg);
            color: white;
            padding: 12px 20px;
            text-align: center;
        }

        .price-tag .small {
            display: block;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1;
        }

        .price-tag .amount {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            line-height: 1;
        }

        .room-title {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .room-details {
            display: flex;
            gap: 20px;
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* --- Reservation Form Section --- */
        .reservation {
            padding: 80px 5%;
        }

        .reservation form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 500px;
            margin: 0 auto;
            background: var(--bg-light);
            padding: 30px;
            border-radius: 10px;
        }

        .reservation input, .reservation select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: var(--font-sans);
            font-size: 1rem;
        }

        /* --- Footer --- */
        footer {
            background: #0f1b29;
            color: white;
            text-align: center;
            padding: 40px 5%;
        }

        footer p {
            font-size: 0.9rem;
            color: #aaa;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero h1 { font-size: 6rem; }
            .hero-image-wrapper { height: 400px; border-radius: 100px; }
            .about-grid { grid-template-columns: 1fr 1fr; }
            .about-text:first-child { display: none; } 
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 4rem; }
            .hero-image-wrapper { height: 300px; border-radius: 50px; }
            .about-grid { grid-template-columns: 1fr; }
            .rooms-grid { grid-template-columns: 1fr; }
            header { padding-left: 15px; }
            .phone { display: none; }
            .hero-subtitles { flex-direction: column; gap: 10px; }
            .room-details { flex-direction: column; gap: 10px; }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
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
            <a href="#about">About</a>
            <a href="#rooms">Rooms</a>
            <a href="#book">Book Now</a>
        </nav>
        <div class="header-right">
            <span class="phone">+63 993 8818 909</span>
            <a href="#book" class="reservation-btn">
                &#128197; Reservation
            </a>
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
                <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" alt="Luxury Hotel Room" loading="lazy">
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
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Hotel Lobby" loading="lazy">
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
                <div class="room-card">
                    <div class="room-image-container">
                        <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Royal Ambassador Suite" loading="lazy">
                        <div class="price-tag">
                            <span class="small">Per Night</span>
                            <span class="amount">$99</span>
                        </div>
                    </div>
                    <h3 class="room-title">Royal Ambassador Suite</h3>
                    <div class="room-details">
                        <div class="detail-item">&#128101; 4 Guests</div>
                        <div class="detail-item">&#128207; 40 ft. Room</div>
                        <div class="detail-item">&#128705; 40 ft. Bathroom</div>
                    </div>
                </div>

                <div class="room-card">
                    <div class="room-image-container">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ambassador Luxury Suite" loading="lazy">
                        <div class="price-tag">
                            <span class="small">Per Night</span>
                            <span class="amount">$49</span>
                        </div>
                    </div>
                    <h3 class="room-title">Ambassador Luxury Suite</h3>
                    <div class="room-details">
                        <div class="detail-item">&#128101; 4 Guests</div>
                        <div class="detail-item">&#128207; 30 ft. Room</div>
                        <div class="detail-item">&#128705; 30 ft. Bathroom</div>
                    </div>
                </div>
                
                <div class="room-card">
                    <div class="room-image-container">
                        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Standard Suite" loading="lazy">
                        <div class="price-tag">
                            <span class="small">Per Night</span>
                            <span class="amount">$89</span>
                        </div>
                    </div>
                    <h3 class="room-title">Standard Suite</h3>
                    <div class="room-details">
                        <div class="detail-item">&#128101; 2 Guests</div>
                        <div class="detail-item">&#128207; 25 ft. Room</div>
                        <div class="detail-item">&#128705; 20 ft. Bathroom</div>
                    </div>
                </div>

                <div class="room-card">
                    <div class="room-image-container">
                        <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Majestic Heritage Suite" loading="lazy">
                        <div class="price-tag">
                            <span class="small">Per Night</span>
                            <span class="amount">$79</span>
                        </div>
                    </div>
                    <h3 class="room-title">Majestic Heritage Suite</h3>
                    <div class="room-details">
                        <div class="detail-item">&#128101; 3 Guests</div>
                        <div class="detail-item">&#128207; 35 ft. Room</div>
                        <div class="detail-item">&#128705; 25 ft. Bathroom</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="book" class="reservation">
            <div class="section-header">
                <span class="dots">&#8226;&#8226;&#8226;&#8226;&#8226;</span>
                <span>Book a Room</span>
            </div>
            <form action="#" method="POST">
                <input type="text" placeholder="Full Name" required>
                <input type="email" placeholder="Email Address" required>
                <input type="date" required>
                <select required>
                    <option value="" disabled selected>Select Room Type</option>
                    <option value="royal">Royal Ambassador Suite</option>
                    <option value="ambassador">Ambassador Luxury Suite</option>
                    <option value="standard">Standard Suite</option>
                    <option value="majestic">Majestic Heritage Suite</option>
                </select>
                <button type="submit" class="btn-outline" style="justify-content: center;">Submit Request</button>
            </form>
        </section>
    </main>

    <footer>
        <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px;">CHMSUOTEL</h3>
        <p>&copy; 2024 CHMSUOTEL. All rights reserved.</p>
        <p style="margin-top: 5px;">Developed by Sikma Bois. • For Laboratory Purposes</p>
    </footer>

    <script>
        // Simple JavaScript to toggle the mobile navigation menu
        const menuBtn = document.querySelector('.menu-btn');
        const nav = document.querySelector('.nav-links');

        menuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
        });

        // Close menu when a link is clicked
        const navLinks = document.querySelectorAll('.nav-links a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('active');
            });
        });
    </script>

</body>
</html>