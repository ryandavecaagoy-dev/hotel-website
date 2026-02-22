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
            --bg-color: #f4f5f5;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-sans); background-color: var(--bg-color); color: var(--text-dark); line-height: 1.4; }

        /* --- Slim Header --- */
        header { display: flex; justify-content: space-between; align-items: center; background: #fff; height: 65px; padding: 0 5%; position: sticky; top: 0; z-index: 1000; border-bottom: 1px solid #eaeaea; }
        .logo-link { font-family: var(--font-serif); font-size: 1.3rem; text-decoration: none; color: var(--text-dark); }
        .contact-bar { background-color: var(--primary-green); color: white; padding: 6px 15px; font-weight: 600; font-size: 0.8rem; border-radius: 4px; text-decoration: none; }

        /* --- Branding --- */
        .brand-header { background: #fff; padding: 25px 5% 0; text-align: center; }
        .brand-inner { display: flex; align-items: baseline; justify-content: center; gap: 15px; border-bottom: 1px dashed #bbb; padding-bottom: 15px; }
        .brand-inner h1 { font-family: var(--font-serif); font-size: 2rem; color: var(--primary-green); letter-spacing: 1px; }
        .brand-inner span { font-size: 0.9rem; letter-spacing: 3px; text-transform: uppercase; }

        /* --- Grid Layout --- */
        .menu-wrapper { max-width: 1100px; margin: 0 auto; padding: 40px 5%; }
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

        @media (max-width: 900px) { .menu-grid { grid-template-columns: repeat(2, 1fr); gap: 50px 20px; } }
        @media (max-width: 600px) { .menu-grid { grid-template-columns: 1fr; gap: 60px 0; } .image-slot { max-width: 100%; padding: 0 12%; } }
    </style>
</head>
<body>

    <header>
        <a href="menu.php" class="logo-link">CHMSUOTEL</a>
        <a href="tel:+639938818909" class="contact-bar">+63 993 8818 909</a>
    </header>

    <div class="brand-header">
        <div class="brand-inner">
            <span style="opacity: 0.2; letter-spacing: 5px;">...</span>
            <h1>CHMSUOTEL</h1>
            <span>FOOD MENU</span>
        </div>
    </div>

    <main class="menu-wrapper">
        <section id="diner-section">
            <h2 class="section-title">BREAKFAST</h2>
            <div class="menu-grid">
                <div class="menu-item">
    <div class="tag-space">★ BEST SELLER</div>
    
    <div class="image-slot">
        <div class="arch-frame">
            <img src="images/eggs-benedict.jpg" alt="Eggs Benedict">
        </div>
        
        <div class="item-label">Eggs Benedict</div>
    </div>
    
    <p class="item-text">Toasted English muffins, traditionally topped with Canadian bacon, poached eggs, and a creamy, lemony hollandaise sauce.</p>
</div>

                <div class="menu-item">
                    <div class="tag-space"></div> 
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/ham-cheese.jpg" alt="Ham & Cheese"></div>
                        <div class="item-label">Ham & Cheese</div>
                    </div>
                    <p class="item-text">Béchamel sauce, ham, cheese and a smear of Dijon mustard, grilled until it's oozing.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/pancakes.jpg" alt="Ricotta Pancakes"></div>
                        <div class="item-label">Ricotta Pancakes</div>
                    </div>
                    <p class="item-text">Super moist inside with a flavor that is almost a bit cheesecakey, served with fresh berries.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/omelette.jpg" alt="Egg Omelette"></div>
                        <div class="item-label">Egg Omelette</div>
                    </div>
                    <p class="item-text">A light, airy, and high-protein breakfast dish characterized by a mousse-like texture.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/pani-puri.jpg" alt="Pani Puri"></div>
                        <div class="item-label">Pani Puri</div>
                    </div>
                    <p class="item-text">Golden, light, and perfectly toasted, featuring pockets designed to trap pools of melted butter.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/scrambled-eggs.jpg" alt="Scrambled Eggs"></div>
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
                        <div class="arch-frame"><img src="images/meat-platter.jpg" alt="Grilled Meat Platter"></div>
                        <div class="item-label">Grilled Meat Platter</div>
                    </div>
                    <p class="item-text">Baby back ribs, peri-peri, grilled bacon slab, cajun rice, and mango salsa.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/calamari.jpg" alt="Squid Ink Calamari"></div>
                        <div class="item-label">Squid Ink Calamari</div>
                    </div>
                    <p class="item-text">Deep-fried squid served with parmesan cheese and rich squid ink.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/lechon.jpg" alt="Lechon Pork Belly"></div>
                        <div class="item-label">Lechon Pork Belly</div>
                    </div>
                    <p class="item-text">Homemade atchara, sarsa, pan-seared banana, and spring onion on banana leaves.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/lapu-lapu.jpg" alt="Lapu-Lapu Caprice"></div>
                        <div class="item-label">Lapu-Lapu Caprice</div>
                    </div>
                    <p class="item-text">Fresh Lapu-Lapu with lemon caper sauce and sweet torched bananas.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space">★ BEST SELLER</div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/chicken-peri.jpg" alt="Chicken Peri-Peri"></div>
                        <div class="item-label">Chicken Peri-Peri</div>
                    </div>
                    <p class="item-text">Grilled chicken marinated in spicy peri-peri sauce, served with fresh coleslaw.</p>
                </div>

                <div class="menu-item">
                    <div class="tag-space"></div>
                    <div class="image-slot">
                        <div class="arch-frame"><img src="images/spareribs.jpg" alt="Thai Pork Spareribs"></div>
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
                <div class="arch-frame"><img src="images/beef-wellington.jpg" alt="Beef Wellington"></div>
                <div class="item-label">Beef Wellington</div>
            </div>
            <p class="item-text">Prime beef tenderloin filet coated in mushroom duxelles and savory pâté, wrapped in prosciutto and encased in a golden-brown, flaky puff pastry.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="images/steak-tartare.jpg" alt="Steak Tartare"></div>
                <div class="item-label">Steak Tartare</div>
            </div>
            <p class="item-text">Finely chopped or minced raw beef mixed with seasonings like capers, onions, parsley, Worcestershire sauce, and Dijon mustard.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space">★ BEST SELLER</div>
            <div class="image-slot">
                <div class="arch-frame"><img src="images/baked-salmon.jpg" alt="Baked Salmon Belly"></div>
                <div class="item-label">Baked Salmon Belly</div>
            </div>
            <p class="item-text">Succulent cut of the fish, oven-roasted until the edges are crisp and the center is melt-in-your-mouth tender.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="images/lamb.jpg" alt="Herb-Crusted Lamb"></div>
                <div class="item-label">Herb-Crusted Lamb</div>
            </div>
            <p class="item-text">Pan-seared with a balsamic or red wine reduction glaze, served over a bed of creamy mashed potatoes and sautéed green beans.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="images/caviar.jpg" alt="White Sturgeon Caviar"></div>
                <div class="item-label">White Sturgeon Caviar</div>
            </div>
            <p class="item-text">White sturgeon caviar served on ice to maintain its temperature, accompanied by toasted brioche points and crème fraîche.</p>
        </div>

        <div class="menu-item">
            <div class="tag-space"></div>
            <div class="image-slot">
                <div class="arch-frame"><img src="images/wagyu.jpg" alt="A5 Japanese Wagyu"></div>
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