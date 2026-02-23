<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 
$link = $isLoggedIn ? 'reservation.php' : 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSUOTEL - Food Menu</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #1a472a; 
            --accent-brown: #a65e2e;
            --text-dark: #111;
            --text-light: #555;
            --bg-color: #faf9f6;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-color); color: var(--text-dark); line-height: 1.4; }

        /* --- Slim Header --- */
        header { display: flex; justify-content: space-between; align-items: center; background: #fff; height: 65px; padding: 0 5%; position: sticky; top: 0; z-index: 1000; border-bottom: 1px solid #eaeaea; }
        .logo-link { font-family: var(--font-serif); font-size: 1.3rem; text-decoration: none; color: var(--text-dark); }
        .contact-bar { background-color: var(--primary-green); color: white; padding: 6px 15px; font-weight: 600; font-size: 0.8rem; border-radius: 4px; text-decoration: none; }


.header-left {
    display: flex;
    align-items: center;
    /* Adds space between the new back button and the logo */
    gap: 20px; 
}

.back-nav {
    text-decoration: none;
    color: var(--text-dark); /* Uses your defined dark text color */
    font-family: var(--font-sans);
    font-weight: 500;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px; /* Space between arrow and text */
    transition: color 0.2s ease;
}

.back-nav .arrow {
    font-size: 1.2rem; /* Makes the arrow slightly larger */
    line-height: 1;
}

/* Hover effect using your accent brown color */
.back-nav:hover {
    color: var(--accent-brown); 
}
/* Define the animation keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px); /* Start 30px lower */
    }
    to {
        opacity: 1;
        transform: translateY(0); /* End in normal position */
    }
}

/* Apply animation to menu items and sections */
.menu-item, .section-title, .preview-grid, .preview-description {
    /* Runs the animation once for 0.8 seconds with a smooth ease-out effect */
    animation: fadeInUp 0.8s ease-out forwards; 
}
/* Add a slight delay to the description so it follows the images */
.preview-description { animation-delay: 0.3s; opacity: 0; }

/* --- Sticky Sub-Navigation --- */
.sub-nav {
    display: flex;
    justify-content: center;
    gap: 40px; /* Space between the links */
    background: var(--bg-color); /* Matches the page background */
    padding: 15px 0;
    position: sticky;
    top: 65px; /* Sits exactly below your 65px tall main header */
    z-index: 990; /* Keeps it layered below the main header but above the food */
    border-bottom: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 4px 15px rgba(0,0,0,0.03); /* Very subtle shadow for depth */
}

.sub-nav a {
    text-decoration: none;
    font-family: var(--font-sans);
    text-transform: uppercase;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: var(--text-light);
    transition: color 0.3s ease;
}

.sub-nav a:hover {
    color: var(--accent-brown); /* Turns brown when hovered */
}


section[id] {
    scroll-margin-top: 130px; 
}

/* Adjust the sub-nav for small mobile screens */
@media (max-width: 600px) {
    .sub-nav { gap: 20px; padding: 12px 0; }
    .sub-nav a { font-size: 0.75rem; letter-spacing: 1px; }
}

/* On very small mobile screens, hide the word "Back" and just keep the arrow */
@media (max-width: 400px) {
    .back-nav .nav-text {
        display: none;
    }
    .header-left {
        gap: 10px; /* Reduce gap on tiny screens */
    }
}
        /* --- Branding --- */
        .brand-header { background: #fff; padding: 25px 5% 0; text-align: center; }
        .brand-inner { display: flex; align-items: baseline; justify-content: center; gap: 15px; border-bottom: 1px dashed #bbb; padding-bottom: 15px; }
        .brand-inner h1 { font-family: var(--font-serif); font-size: 2rem; color: var(--primary-green); letter-spacing: 1px; }
        .brand-inner span { font-size: 0.9rem; letter-spacing: 3px; text-transform: uppercase; }

.menu-wrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 5%;

    /* This is the line that fixes the scrolling issue */
    scroll-margin-top: 85px;
}
        .section-title { font-family: var(--font-serif); font-size: clamp(2.5rem, 8vw, 5rem); text-align: center; margin-bottom: 50px; text-transform: uppercase; letter-spacing: -1px; }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 60px 30px;
            align-items: start;
        }

        /* --- Menu Item & Tag Fix --- */
        .menu-item { display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; }
        
        /* This fixes the alignment by ensuring the tag space is always 20px high */
        .tag-space {
            height: 20px; 
            margin-bottom: 10px;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--accent-brown);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-slot { position: relative; width: 100%; max-width: 240px; aspect-ratio: 4/5; margin-bottom: 30px; }
        .arch-frame { width: 100%; height: 100%; border-radius: 120px 120px 15px 15px; overflow: hidden; border: 1px solid #333; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .arch-frame img { width: 100%; height: 100%; object-fit: cover; }

        .item-label { 
            position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); 
            background: var(--accent-brown); color: #fff; padding: 7px 30px; border-radius: 50px; 
            font-weight: 500; font-size: 1rem; white-space: nowrap; border: 2px solid #fff; box-shadow: 0 5px 12px rgba(0,0,0,0.15);
        }

        .item-text { font-size: 0.85rem; color: var(--text-light); max-width: 260px; margin-top: 10px; line-height: 1.5; }
        .separator { width: 100%; border-top: 2px dashed #bbb; margin: 40px 0; }
/* --- Diner Preview Section --- */

.preview-description {
    text-align: center;
    margin-top: 35px; 
    padding: 0 15px; 
}

.preview-description h3 {
    font-family: var(--font-serif);
    color: var(--primary-green);
    font-size: 1.6rem;
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}

.preview-description p {
    color: var(--text-light);
    font-size: 1rem;
    max-width: 650px; 
    margin: 0 auto; 
    line-height: 1.6;
}


@media (max-width: 600px) {
    /* ... your other mobile rules ... */
    .preview-description { margin-top: 25px; }
    .preview-description h3 { font-size: 1.3rem; }
    .preview-description p { font-size: 0.9rem; }
}

.diner-preview {
    width: 100%;
    margin-bottom: 20px;
}

.preview-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.preview-img-wrapper {
    width: 100%;
    aspect-ratio: 4/3; /* Keeps the images nice and uniform */
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1); /* Adds a soft shadow */
}

.preview-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease; /* Smooth zoom setup */
}

.preview-img-wrapper:hover img {
    transform: scale(1.05); /* Gentle zoom effect on hover */
}
        @media (max-width: 600px) { 
    .menu-grid { 
        grid-template-columns: repeat(3, 1fr); 
        gap: 50px 5px; /* Keeps some vertical space, minimizes horizontal gap */
    } 
    
    .image-slot { 
        max-width: 100%; 
        padding: 0; 
    }
    
    /* Fix for overlapping labels */
    .item-label {
        font-size: 0.7rem; /* Shrinks the font size */
        padding: 5px 8px; /* Greatly reduces the extra brown space on the sides */
        white-space: normal; /* Allows longer names to drop to a second line */
        width: 95%; /* Prevents the pill from touching the neighboring ones */
        line-height: 1.2;
    }

    /* Fix for the description text below */
    .item-text {
        font-size: 0.65rem; /* Shrinks the description text so it fits the narrow column */
        margin-top: 15px; /* Adds a bit of breathing room below the label */
        padding: 0 2px;
    }
}
    </style>
</head>
<body>

    <header>
    <div class="header-left">
        <a href="menu.php" class="back-nav">
            <span class="arrow">&#8592;</span> <span class="nav-text">Back</span>
        </a>
        <a href="menu.php" class="logo-link">CHMSUOTEL</a>
    </div>

    <a href="tel:+639938818909" class="contact-bar">+63 993 8818 909</a>

</header>

    <nav class="sub-nav">
        <a href="#breakfast-section">Breakfast</a>
        <a href="#lunch-section">Lunch</a>
        <a href="#dinner-section">Dinner</a>
    </nav>
    <div class="brand-header">
        <div class="brand-inner">
            <span style="opacity: 0.2; letter-spacing: 5px;">...</span>
            <h1>CHMSUOTEL</h1>
            <span>FOOD MENU</span>
        </div>
    </div>

<section id="diner-section">
   <main class="menu-wrapper" id="diner-section">

    <section class="diner-preview">
    <div class="preview-grid">
        <div class="preview-img-wrapper">
            <img src="CHMSUOTELFOODS/preview-wide.png" alt="Diner Interior">
        </div>
        <div class="preview-img-wrapper">
            <img src="CHMSUOTELFOODS/preview-table.png" alt="Table Setting">
        </div>
        <div class="preview-img-wrapper">
            <img src="CHMSUOTELFOODS/preview-bar.png" alt="Diner Bar">
        </div>
    </div> <div class="preview-description">
        <h3>Dine amongst the city lights.</h3>
        <p>Experience an unforgettable culinary journey in our modern, high-rise diner. Enjoy panoramic city views and a sophisticated, cozy atmosphere perfect for any time of day.</p>
    </div>
    </section>
    <div class="separator"></div>

    <section id="breakfast-section"> 
        <h2 class="section-title">BREAKFAST</h2>
        <div class="menu-grid">
                <div class="menu-item">
    <div class="tag-space">★ BEST SELLER</div>
    
    <div class="image-slot">
        <div class="arch-frame">
            <img src="CHMSUOTELFOODS/eggsBenedict.png" alt="Eggs Benedict">
        </div>
        
        <div class="item-label">Eggs Benedict</div>
    </div>
    
    <p class="item-text">Toasted English muffins, traditionally topped with Canadian bacon, poached eggs, and a creamy, lemony hollandaise sauce.</p>
</div>

                <div class="menu-item">
                    <div class="tag-space"></div> 
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/ham&Cheese.png" alt="Ham & Cheese"></div>
                        <div class="item-label">Ham & Cheese</div>
                    </div>
                    <p class="item-text">Béchamel sauce, ham, cheese and a smear of Dijon mustard, grilled until it's oozing.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/ricottaPancakes.png" alt="Ricotta Pancakes"></div>
                        <div class="item-label">Ricotta Pancakes</div>
                    </div>
                    <p class="item-text">Super moist inside with a flavor that is almost a bit cheesecakey, served with fresh berries.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/eggOmelette.png" alt="Egg Omelette"></div>
                        <div class="item-label">Egg Omelette</div>
                    </div>
                    <p class="item-text">A light, airy, and high-protein breakfast dish characterized by a mousse-like texture.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/waffles.png" alt="Waffles"></div>
                        <div class="item-label">Waffles</div>
                    </div>
                    <p class="item-text">Golden, light, and perfectly toasted, featuring pockets designed to trap pools of melted butter.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/scrambledEggs.png" alt="Scrambled Eggs"></div>
                        <div class="item-label">Scrambled Eggs</div>
                    </div>
                    <p class="item-text">Light, fluffy, and gently folded for a creamy, cloud-like texture.</p>
                </div>
            </div>
        </section>

        <div class="separator"></div>

        <section id="lunch-section">
            <h2 class="section-title">LUNCH</h2>
            <div class="menu-grid">
                <div class="menu-item">
                    <div class="tag-space">★ BEST SELLER</div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/grilledMeat.png" alt="Grilled Meat Platter"></div>
                        <div class="item-label">Grilled Meat Platter</div>
                    </div>
                    <p class="item-text">Baby back ribs, peri-peri, grilled bacon slab, cajun rice, and mango salsa.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/squidInkCalamari.png" alt="Squid Ink Calamari"></div>
                        <div class="item-label">Squid Ink Calamari</div>
                    </div>
                    <p class="item-text">Deep-fried squid served with parmesan cheese and rich squid ink.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/lechonPorkBelly.png" alt="Lechon Pork Belly"></div>
                        <div class="item-label">Lechon Pork Belly</div>
                    </div>
                    <p class="item-text">Homemade atchara, sarsa, pan-seared banana, and spring onion on banana leaves.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/lapu-LapuCaprice.png" alt="Lapu-Lapu Caprice"></div>
                        <div class="item-label">Lapu-Lapu Caprice</div>
                    </div>
                    <p class="item-text">Fresh Lapu-Lapu with lemon caper sauce and sweet torched bananas.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space">★ BEST SELLER</div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/chickenPeri-Peri.png" alt="Chicken Peri-Peri"></div>
                        <div class="item-label">Chicken Peri-Peri</div>
                    </div>
                    <p class="item-text">Grilled chicken marinated in spicy peri-peri sauce, served with fresh coleslaw.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="CHMSUOTELFOODS/thaiPorkSpareRibs.png" alt="Thai Pork Spareribs"></div>
                        <div class="item-label">Thai Pork Spareribs</div>
                    </div>
                    <p class="item-text">Thai barbecue sauce, mango salsa, coleslaw, and fresh corn on the cob.</p>
               
                </div>
            </div>
        </section>
        <div class="separator"></div>

    <section id="dinner-section">
    <h2 class="section-title">DINNER</h2>
    <div class="menu-grid">
        <div class="menu-item">
            <div class="tag-space">★ BEST SELLER</div>
            <div class="image-slot">
                <div class="arch-frame"><img src="CHMSUOTELFOODS/beefWellington.png" alt="Beef Wellington"></div>
                <div class="item-label">Beef Wellington</div>
            </div>
            <p class="item-text">Prime beef tenderloin filet coated in mushroom duxelles and savory pâté, wrapped in prosciutto and encased in a golden-brown, flaky puff pastry.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="CHMSUOTELFOODS/steakTartare.png" alt="Steak Tartare"></div>
                <div class="item-label">Steak Tartare</div>
            </div>
            <p class="item-text">Finely chopped or minced raw beef mixed with seasonings like capers, onions, parsley, Worcestershire sauce, and Dijon mustard.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space">★ BEST SELLER</div>
            <div class="image-slot">
                <div class="arch-frame"><img src="CHMSUOTELFOODS/bakedSalmonBelly.png" alt="Baked Salmon Belly"></div>
                <div class="item-label">Baked Salmon Belly</div>
            </div>
            <p class="item-text">Succulent cut of the fish, oven-roasted until the edges are crisp and the center is melt-in-your-mouth tender.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="CHMSUOTELFOODS/herbCrustedLamb.png" alt="Herb-Crusted Lamb"></div>
                <div class="item-label">Herb-Crusted Lamb</div>
            </div>
            <p class="item-text">Pan-seared with a balsamic or red wine reduction glaze, served over a bed of creamy mashed potatoes and sautéed green beans.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="CHMSUOTELFOODS/whiteSturgeonCaviar.png" alt="White Sturgeon Caviar"></div>
                <div class="item-label">White Sturgeon Caviar</div>
            </div>
            <p class="item-text">White sturgeon caviar served on ice to maintain its temperature, accompanied by toasted brioche points and crème fraîche.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="CHMSUOTELFOODS/a5JapaneseWagyu.png" alt="A5 Japanese Wagyu"></div>
                <div class="item-label">A5 Japanese Wagyu</div>
            </div>
            <p class="item-text">Lightly seared to a perfect medium-rare. Served with a medley of crisp julienned vegetables and a side of traditional wasabi.</p>
        </div>
    </div>
</section>
</main>
    

    <footer style="background: #0f1b29; color: #fff; text-align: center; padding: 30px 5%;">
        <p style="font-size: 0.8rem; opacity: 0.6;">&copy; 2026 CHMSUOTEL. Developed by Sikma Bois</p>
    </footer>

</body>
</html>