<?php require_once __DIR__ . '/../core/config.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StyleHub — Fashion &amp; Accessories</title>
    <meta
      name="description"
      content="T-shirts, stainless flasks, tote bags, stickers and notebooks — all in one place."
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <link rel="stylesheet" href="<?= CSS_URL ?>/shop.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbarsticky.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbar.css" />
    <?php require __DIR__ . '/paths.php'; ?>
    <script src="<?= JS_URL ?>/auth.js"></script>
  </head>
  <body>        
    <div id="navbar"></div>
    <script src="<?= COMPONENTS_URL ?>/navbar.js?v=4"></script>
    
    <div class="page">
      <div class="hero">
        <div class="hero-text">
          <h1>Style That Speaks for You</h1>
          <p>
            T-shirts, stainless flasks, tote bags, stickers &amp; notebooks —
            curated collections, all in one place.
          </p>
          <button class="hero-btn">
            <i data-lucide="shopping-bag"></i> Shop Now
          </button>
        </div>
        <div class="hero-stats">
          <div class="hero-stat">
            <span class="hero-stat-num">5</span>
            <span class="hero-stat-label">Categories</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-num">3</span>
            <span class="hero-stat-label">Designers</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-num">Free</span>
            <span class="hero-stat-label">Delivery</span>
          </div>
        </div>
      </div>

      <div class="cats">
        <div class="cat active" onclick="filterCat(this, 'all')">
          <i data-lucide="layout-grid"></i> All
        </div>
        <div class="cat" onclick="filterCat(this, 'tshirts')">
          <i data-lucide="shirt"></i> T-Shirts
        </div>
        <div class="cat" onclick="filterCat(this, 'flasks')">
          <i data-lucide="flask-conical"></i> Flasks
        </div>
        <div class="cat" onclick="filterCat(this, 'tote')">
          <i data-lucide="shopping-bag"></i> Tote Bags
        </div>
        <div class="cat" onclick="filterCat(this, 'stickers')">
          <i data-lucide="sticker"></i> Stickers
        </div>
        <div class="cat" onclick="filterCat(this, 'notebooks')">
          <i data-lucide="book-open"></i> Notebooks
        </div>
        <div
          class="cat"
          onclick="openCartModal()"
          style="
            margin-left: auto;
            border-color: var(--primary);
            color: var(--primary);
          "
        >
          <i data-lucide="shopping-cart"></i> Cart
          <span class="cart-count" id="headerCartCount">0</span>
        </div>
      </div>

      <!-- T-SHIRTS -->
      <div class="sec-wrap" data-section="tshirts">
        <div class="sec-header">
          <h2><i data-lucide="shirt" class="sec-icon"></i> T-Shirts</h2>
          <button class="see-all">
            <i data-lucide="arrow-right"></i> View All
          </button>
        </div>
        <div class="product-grid">
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-hot"
                ><i data-lucide="flame"></i> Best Seller</span
              >
              <img src="<?= IMG_URL ?>/HT/1_0001s_0000_Layer-46.png" alt="T-Shirt H" />
            </div>
            <div class="prod-body">
              <div class="prod-name">T-Shirt — H</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span
                ><span class="star-count">(318)</span>
              </div>
              <div class="prod-meta">100% Cotton &bull; Sizes S→XXL</div>
              <div class="prod-footer">
                <div><span class="prod-price">199 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/ST/1_0006s_0000_Layer-31.png" alt="T-Shirt S" />
            </div>
            <div class="prod-body">
              <div class="prod-name">T-Shirt — S</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span
                ><span class="star-count">(142)</span>
              </div>
              <div class="prod-meta">Cotton &bull; Graphic Print</div>
              <div class="prod-footer">
                <div><span class="prod-price">249 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-lim"
                ><i data-lucide="gem"></i> Limited</span
              >
              <img src="<?= IMG_URL ?>/ZT/1_0011s_0000_Layer-9.png" alt="T-Shirt Z" />
            </div>
            <div class="prod-body">
              <div class="prod-name">T-Shirt — Z</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(56)</span>
              </div>
              <div class="prod-meta">Limited Edition &bull; Multi-color</div>
              <div class="prod-footer">
                <div><span class="prod-price">299 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/BT/11_0002s_0000_Layer-63.png" alt="T-Shirt B" />
            </div>
            <div class="prod-body">
              <div class="prod-name">T-Shirt — B</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(42)</span>
              </div>
              <div class="prod-meta">Soft Cotton &bull; Classic Fit</div>
              <div class="prod-footer">
                <div><span class="prod-price">220 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/RT/111_0001s_0000_Layer-71.png" alt="T-Shirt R" />
            </div>
            <div class="prod-body">
              <div class="prod-name">T-Shirt — R</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(28)</span>
              </div>
              <div class="prod-meta">Premium Quality &bull; Durable</div>
              <div class="prod-footer">
                <div><span class="prod-price">240 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/KT/11_0001s_0000_Layer-83.png" alt="T-Shirt K" />
            </div>
            <div class="prod-body">
              <div class="prod-name">T-Shirt — K</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(37)</span>
              </div>
              <div class="prod-meta">Signature Design &bull; Cotton Blend</div>
              <div class="prod-footer">
                <div><span class="prod-price">230 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FLASKS -->
      <div class="sec-wrap" data-section="flasks">
        <div class="sec-header">
          <h2>
            <i data-lucide="flask-conical" class="sec-icon"></i> Stainless
            Flasks
          </h2>
          <button class="see-all">
            <i data-lucide="arrow-right"></i> View All
          </button>
        </div>
        <div class="product-grid">
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-hot"
                ><i data-lucide="flame"></i> Best Seller</span
              >
              <img src="<?= IMG_URL ?>/HF/1_0002s_0000_Layer-42.png" alt="Flask H" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Stainless Flask — H</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span
                ><span class="star-count">(421)</span>
              </div>
              <div class="prod-meta">304 Stainless &bull; 24h Insulation</div>
              <div class="prod-footer">
                <div><span class="prod-price">349 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/SF/1_0007s_0000_Layer-27.png" alt="Flask S" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Stainless Flask — S</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span
                ><span class="star-count">(189)</span>
              </div>
              <div class="prod-meta">Large Capacity &bull; Premium Build</div>
              <div class="prod-footer">
                <div><span class="prod-price">449 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-sale"
                ><i data-lucide="tag"></i> 20% Off</span
              >
              <img src="<?= IMG_URL ?>/ZF/1_0010s_0000_Layer-21.png" alt="Flask Z" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Stainless Flask — Z</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span
                ><span class="star-count">(267)</span>
              </div>
              <div class="prod-meta">
                Slim &amp; Lightweight &bull; Multi-color
              </div>
              <div class="prod-footer">
                <div>
                  <span class="prod-price">279 EGP</span
                  ><span class="prod-old">349 EGP</span>
                </div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/BF/11_0004s_0000_Layer-57.png" alt="Flask B" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Stainless Flask — B</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(89)</span>
              </div>
              <div class="prod-meta">Hot &amp; Cold &bull; Leak-Proof</div>
              <div class="prod-footer">
                <div><span class="prod-price">320 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/RF/111_0002s_0000_Layer-69.png" alt="Flask R" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Stainless Flask — R</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span><span class="star-count">(45)</span>
              </div>
              <div class="prod-meta">Eco-friendly &bull; Durable</div>
              <div class="prod-footer">
                <div><span class="prod-price">310 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/KF/11_0002s_0000_Layer-79.png" alt="Flask K" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Stainless Flask — K</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(61)</span>
              </div>
              <div class="prod-meta">Matte Finish &bull; 500ml</div>
              <div class="prod-footer">
                <div><span class="prod-price">330 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TOTE BAGS -->
      <div class="sec-wrap" data-section="tote">
        <div class="sec-header">
          <h2><i data-lucide="shopping-bag" class="sec-icon"></i> Tote Bags</h2>
          <button class="see-all">
            <i data-lucide="arrow-right"></i> View All
          </button>
        </div>
        <div class="product-grid">
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-hot"
                ><i data-lucide="flame"></i> Trending</span
              >
              <img src="<?= IMG_URL ?>/HTB/1_0000s_0000_Layer-49.png" alt="Tote Bag H" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Tote Bag — H</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span
                ><span class="star-count">(534)</span>
              </div>
              <div class="prod-meta">Canvas &bull; Holds up to 15 kg</div>
              <div class="prod-footer">
                <div><span class="prod-price">149 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/STB/1_0005s_0000_Layer-34.png" alt="Tote Bag S" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Tote Bag — S</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span
                ><span class="star-count">(201)</span>
              </div>
              <div class="prod-meta">Minimal Design</div>
              <div class="prod-footer">
                <div><span class="prod-price">179 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/BTB/11_0003s_0000_Layer-59.png" alt="Tote Bag B" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Tote Bag — B</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(64)</span>
              </div>
              <div class="prod-meta">Spacious &bull; Canvas</div>
              <div class="prod-footer">
                <div><span class="prod-price">160 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/RTB/111_0000s_0000_Layer-74.png" alt="Tote Bag R" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Tote Bag — R</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(31)</span>
              </div>
              <div class="prod-meta">Trendy &bull; Heavy Duty</div>
              <div class="prod-footer">
                <div><span class="prod-price">180 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/KTB/11_0000s_0000_Layer-86.png" alt="Tote Bag K" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Tote Bag — K</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span><span class="star-count">(25)</span>
              </div>
              <div class="prod-meta">Eco-friendly &bull; Durable</div>
              <div class="prod-footer">
                <div><span class="prod-price">170 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- STICKERS -->
      <div class="sec-wrap" data-section="stickers">
        <div class="sec-header">
          <h2><i data-lucide="sticker" class="sec-icon"></i> Stickers</h2>
          <button class="see-all">
            <i data-lucide="arrow-right"></i> View All
          </button>
        </div>
        <div class="product-grid">
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-hot"
                ><i data-lucide="flame"></i> Best Seller</span
              >
              <img src="<?= IMG_URL ?>/ZS/1_0008s_0000_Layer-16.png" alt="Sticker Z" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Sticker Pack — Z</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span
                ><span class="star-count">(629)</span>
              </div>
              <div class="prod-meta">4 Unique Designs</div>
              <div class="prod-footer">
                <div><span class="prod-price">49 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- NOTEBOOKS -->
      <div class="sec-wrap" data-section="notebooks">
        <div class="sec-header">
          <h2><i data-lucide="book-open" class="sec-icon"></i> Notebooks</h2>
          <button class="see-all">
            <i data-lucide="arrow-right"></i> View All
          </button>
        </div>
        <div class="product-grid">
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-hot"
                ><i data-lucide="flame"></i> Best Seller</span
              >
              <img src="<?= IMG_URL ?>/SB/1_0003s_0000_Layer-39.png" alt="Notebook S" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Notebook — S</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span
                ><span class="star-count">(629)</span>
              </div>
              <div class="prod-meta">200 Pages &bull; Hardcover</div>
              <div class="prod-footer">
                <div><span class="prod-price">119 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/ZB/1_0009s_0000_Layer-3.png" alt="Notebook Z" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Notebook — Z</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span
                ><span class="star-count">(183)</span>
              </div>
              <div class="prod-meta">
                Multiple Colors &bull; Premium Quality
              </div>
              <div class="prod-footer">
                <div><span class="prod-price">159 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/BB/11_0001s_0000_Layer-53.png" alt="Notebook B" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Notebook — B</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(112)</span>
              </div>
              <div class="prod-meta">Lined &bull; 150 Pages</div>
              <div class="prod-footer">
                <div><span class="prod-price">130 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/RB/111_0003s_0000_Layer-66.png" alt="Notebook R" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Notebook — R</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star empty">★</span><span class="star-count">(87)</span>
              </div>
              <div class="prod-meta">Dotted &bull; Premium Paper</div>
              <div class="prod-footer">
                <div><span class="prod-price">140 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
          <div class="product-card">
            <div class="prod-img-wrap">
              <span class="prod-badge badge-new"
                ><i data-lucide="sparkles"></i> New</span
              >
              <img src="<?= IMG_URL ?>/KB/11_0003s_0000_Layer-76.png" alt="Notebook K" />
            </div>
            <div class="prod-body">
              <div class="prod-name">Notebook — K</div>
              <div class="stars">
                <span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star">★</span
                ><span class="star">★</span><span class="star-count">(95)</span>
              </div>
              <div class="prod-meta">Softcover &bull; Pocket Size</div>
              <div class="prod-footer">
                <div><span class="prod-price">120 EGP</span></div>
                <button class="add-btn"><i data-lucide="plus"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <!-- PRODUCT MODAL -->
    <div class="modal-overlay" id="prodModal" onclick="closeModal(event)">
      <div class="modal-box">
        <button class="modal-close" onclick="closeModal(null, true)">
          <i data-lucide="x"></i>
        </button>
        <div class="modal-inner">
          <div class="modal-gallery">
            <div class="modal-main-img">
              <img id="modalMainImg" src="" alt="" />
            </div>
            <div class="modal-thumbs" id="modalThumbs"></div>
          </div>
          <div class="modal-info">
            <div class="modal-cat" id="modalCat"></div>
            <div class="modal-name" id="modalName"></div>
            <div class="modal-stars" id="modalStars"></div>
            <div class="modal-price-row">
              <span class="modal-price" id="modalPrice"></span
              ><span class="modal-old" id="modalOld"></span>
            </div>
            <div class="modal-meta-tag" id="modalMeta"></div>
            <div class="modal-desc" id="modalDesc"></div>
            <button class="modal-add-btn" onclick="addToCart()">
              <i data-lucide="shopping-cart"></i> Add to Cart
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-overlay" id="cartModal" onclick="closeCartModal(event)">
      <div class="modal-box" style="max-width: 600px; max-height: 85vh">
        <button class="modal-close" onclick="closeCartModal(null, true)">
          <i data-lucide="x"></i>
        </button>
        <div
          style="
            padding: 28px;
            display: flex;
            flex-direction: column;
            height: 100%;
          "
        >
          <h2
            style="
              font-size: 24px;
              font-weight: 800;
              margin-bottom: 20px;
              color: var(--text);
            "
          >
            <i
              data-lucide="shopping-cart"
              style="vertical-align: middle; margin-right: 8px"
            ></i>
            Your Cart
          </h2>
          <div
            id="cartItemsContainer"
            style="
              display: flex;
              flex-direction: column;
              gap: 16px;
              overflow-y: auto;
              flex: 1;
              padding-right: 8px;
            "
          >
          </div>
          <div
            style="
              margin-top: 24px;
              border-top: 2px solid var(--card-border);
              padding-top: 20px;
              display: flex;
              justify-content: space-between;
              align-items: center;
            "
          >
            <div>
              <span style="font-size: 14px; color: var(--gray)">Total</span>
              <div
                style="font-size: 24px; font-weight: 900; color: var(--primary)"
                id="cartModalTotal"
              >
                0 EGP
              </div>
            </div>
            <button
              class="checkout-btn"
              style="padding: 14px 28px; font-size: 16px"
            >
              <i data-lucide="credit-card"></i> Checkout
            </button>
          </div>
        </div>
      </div>
    </div>

    <script src="<?= JS_URL ?>/main.js"></script>
    <script src="<?= JS_URL ?>/shop.js"></script>
  </body>
</html>
