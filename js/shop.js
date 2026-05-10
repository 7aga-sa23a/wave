const PRODUCTS = {
        "T-Shirt — H": {
          cat: "T-Shirts",
          price: "199 EGP",
          meta: "100% Cotton • Sizes S→XXL",
          stars: 5,
          reviews: 318,
          desc: "Premium oversized t-shirt made from 100% breathable cotton. Perfect for everyday wear.",
          images: [
            "../assets/img/HT/1_0001s_0000_Layer-46.png",
            "../assets/img/HT/1_0001s_0001_Layer-47.png",
          ],
        },
        "T-Shirt — S": {
          cat: "T-Shirts",
          price: "249 EGP",
          meta: "Cotton • Graphic Print",
          stars: 4,
          reviews: 142,
          desc: "Unique graphic print t-shirt with bold design. Made from soft cotton fabric.",
          images: [
            "../assets/img/ST/1_0006s_0000_Layer-31.png",
            "../assets/img/ST/1_0006s_0001_Layer-32.png",
          ],
        },
        "T-Shirt — Z": {
          cat: "T-Shirts",
          price: "299 EGP",
          meta: "Limited Edition • Multi-color",
          stars: 5,
          reviews: 56,
          desc: "Exclusive limited edition t-shirt in multiple colorways — grab yours before they are gone.",
          images: [
            "../assets/img/ZT/1_0011s_0000_Layer-9.png",
            "../assets/img/ZT/1_0011s_0001_Layer-10.png",
            "../assets/img/ZT/1_0011s_0002_Layer-11.png",
            "../assets/img/ZT/1_0011s_0003_Layer-12.png",
            "../assets/img/ZT/1_0011s_0004_Layer-13.png",
            "../assets/img/ZT/1_0011s_0005_Layer-14.png",
          ],
        },
        "Stainless Flask — H": {
          cat: "Flasks",
          price: "349 EGP",
          meta: "304 Stainless • 24h Insulation",
          stars: 5,
          reviews: 421,
          desc: "High-grade 304 stainless steel flask. Keeps drinks cold 24h / hot 12h. Leak-proof lid.",
          images: [
            "../assets/img/HF/1_0002s_0000_Layer-42.png",
            "../assets/img/HF/1_0002s_0001_Layer-43.png",
            "../assets/img/HF/1_0002s_0002_Layer-44.png",
          ],
        },
        "Stainless Flask — S": {
          cat: "Flasks",
          price: "449 EGP",
          meta: "Large Capacity • Premium Build",
          stars: 4,
          reviews: 189,
          desc: "Large capacity stainless flask with premium build quality. Ideal for long days out.",
          images: [
            "../assets/img/SF/1_0007s_0000_Layer-27.png",
            "../assets/img/SF/1_0007s_0001_Layer-28.png",
            "../assets/img/SF/1_0007s_0002_Layer-29.png",
          ],
        },
        "Stainless Flask — Z": {
          cat: "Flasks",
          price: "279 EGP",
          oldPrice: "349 EGP",
          meta: "Slim & Lightweight • Multi-color",
          stars: 5,
          reviews: 267,
          desc: "Slim and lightweight flask in multiple color options. Great for travel and daily use.",
          images: [
            "../assets/img/ZF/1_0010s_0000_Layer-21.png",
            "../assets/img/ZF/1_0010s_0001_Layer-22.png",
            "../assets/img/ZF/1_0010s_0002_Layer-23.png",
            "../assets/img/ZF/1_0010s_0003_Layer-24.png",
            "../assets/img/ZF/1_0010s_0004_Layer-25.png",
          ],
        },
        "Tote Bag — H": {
          cat: "Tote Bags",
          price: "149 EGP",
          meta: "Canvas • Holds up to 15 kg",
          stars: 5,
          reviews: 534,
          desc: "Sturdy canvas tote bag holding up to 15kg. Perfect for shopping, beach, or daily carry.",
          images: [
            "../assets/img/HTB/1_0000s_0000_Layer-49.png",
            "../assets/img/HTB/1_0000s_0001_Layer-51.png",
          ],
        },
        "Tote Bag — S": {
          cat: "Tote Bags",
          price: "179 EGP",
          meta: "Minimal Design",
          stars: 4,
          reviews: 201,
          desc: "Clean minimal tote bag with sleek aesthetic. Lightweight yet durable.",
          images: [
            "../assets/img/STB/1_0005s_0000_Layer-34.png",
            "../assets/img/STB/1_0005s_0001_Layer-35.png",
          ],
        },
        "Sticker Pack — Z": {
          cat: "Stickers",
          price: "49 EGP",
          meta: "4 Unique Designs",
          stars: 5,
          reviews: 629,
          desc: "Pack of 4 waterproof, UV-resistant sticker designs. Perfect for laptops and bottles.",
          images: [
            "../assets/img/ZS/1_0008s_0000_Layer-16.png",
            "../assets/img/ZS/1_0008s_0001_Layer-17.png",
            "../assets/img/ZS/1_0008s_0002_Layer-18.png",
            "../assets/img/ZS/1_0008s_0003_Layer-19.png",
          ],
        },
        "Notebook — S": {
          cat: "Notebooks",
          price: "119 EGP",
          meta: "200 Pages • Hardcover",
          stars: 5,
          reviews: 629,
          desc: "200-page hardcover notebook with smooth paper. Perfect for journaling and note-taking.",
          images: [
            "../assets/img/SB/1_0003s_0000_Layer-39.png",
            "../assets/img/SB/1_0003s_0001_Layer-40.png",
            "../assets/img/SB/1_0004s_0000_Layer-37.png",
          ],
        },
        "Notebook — Z": {
          cat: "Notebooks",
          price: "159 EGP",
          meta: "Multiple Colors • Premium Quality",
          stars: 4,
          reviews: 183,
          desc: "Premium quality notebook in multiple colors. Thick paper with minimal bleed-through.",
          images: [
            "../assets/img/ZB/1_0009s_0000_Layer-3.png",
            "../assets/img/ZB/1_0009s_0001_Layer-2.png",
            "../assets/img/ZB/1_0009s_0002_Layer-4.png",
            "../assets/img/ZB/1_0009s_0003_Layer-5.png",
            "../assets/img/ZB/1_0009s_0004_Layer-6.png",
            "../assets/img/ZB/1_0009s_0005_Layer-7.png",
          ],
        },
        "T-Shirt — B": {
          cat: "T-Shirts",
          price: "220 EGP",
          meta: "Soft Cotton • Classic Fit",
          stars: 5,
          reviews: 42,
          desc: "Comfortable and stylish t-shirt made of soft cotton with a classic fit.",
          images: [
            "../assets/img/BT/11_0002s_0000_Layer-63.png",
            "../assets/img/BT/11_0002s_0001_Layer-64.png",
          ],
        },
        "T-Shirt — R": {
          cat: "T-Shirts",
          price: "240 EGP",
          meta: "Premium Quality • Durable",
          stars: 5,
          reviews: 28,
          desc: "Durable t-shirt with a premium feel, designed to last and stay looking great.",
          images: [
            "../assets/img/RT/111_0001s_0000_Layer-71.png",
            "../assets/img/RT/111_0001s_0001_Layer-72.png",
            "../assets/img/RT/111_0001s_0002_Layer-73.png",
          ],
        },
        "Stainless Flask — B": {
          cat: "Flasks",
          price: "320 EGP",
          meta: "Hot & Cold • Leak-Proof",
          stars: 5,
          reviews: 89,
          desc: "Keep your drinks hot or cold for hours with this stylish leak-proof flask.",
          images: [
            "../assets/img/BF/11_0004s_0000_Layer-57.png",
          ],
        },
        "Stainless Flask — R": {
          cat: "Flasks",
          price: "310 EGP",
          meta: "Eco-friendly • Durable",
          stars: 4,
          reviews: 45,
          desc: "Eco-friendly stainless flask designed for outdoor adventures and daily commutes.",
          images: [
            "../assets/img/RF/111_0002s_0000_Layer-69.png",
          ],
        },
        "Tote Bag — B": {
          cat: "Tote Bags",
          price: "160 EGP",
          meta: "Spacious • Canvas",
          stars: 5,
          reviews: 64,
          desc: "Spacious canvas tote bag. Perfect for groceries, books, or beach essentials.",
          images: [
            "../assets/img/BTB/11_0003s_0000_Layer-59.png",
            "../assets/img/BTB/11_0003s_0001_Layer-60.png",
            "../assets/img/BTB/11_0003s_0002_Layer-61.png",
          ],
        },
        "Tote Bag — R": {
          cat: "Tote Bags",
          price: "180 EGP",
          meta: "Trendy • Heavy Duty",
          stars: 5,
          reviews: 31,
          desc: "Heavy duty trendy tote bag that can handle all your heavy loads securely.",
          images: [
            "../assets/img/RTB/111_0000s_0000_Layer-74.png",
          ],
        },
        "Notebook — B": {
          cat: "Notebooks",
          price: "130 EGP",
          meta: "Lined • 150 Pages",
          stars: 5,
          reviews: 112,
          desc: "Lined notebook with 150 pages, perfect for jotting down notes and ideas.",
          images: [
            "../assets/img/BB/11_0001s_0000_Layer-53.png",
            "../assets/img/BB/11_0001s_0001_Layer-54.png",
            "../assets/img/BB/11_0001s_0002_Layer-55.png",
          ],
        },
        "Notebook — R": {
          cat: "Notebooks",
          price: "140 EGP",
          meta: "Dotted • Premium Paper",
          stars: 4,
          reviews: 87,
          desc: "Premium quality dotted notebook for sketching, journaling, or bullet notes.",
          images: [
            "../assets/img/RB/111_0003s_0000_Layer-66.png",
            "../assets/img/RB/111_0003s_0001_Layer-67.png",
            "../assets/img/RB/111_0003s_0002_Layer-68.png",
          ],
        },
        "T-Shirt — K": {
          cat: "T-Shirts",
          price: "230 EGP",
          meta: "Signature Design • Cotton Blend",
          stars: 5,
          reviews: 37,
          desc: "A signature t-shirt featuring a cotton blend for maximum comfort and style.",
          images: [
            "../assets/img/KT/11_0001s_0000_Layer-83.png",
            "../assets/img/KT/11_0001s_0001_Layer-84.png",
            "../assets/img/KT/11_0001s_0002_Layer-85.png",
          ],
        },
        "Stainless Flask — K": {
          cat: "Flasks",
          price: "330 EGP",
          meta: "Matte Finish • 500ml",
          stars: 5,
          reviews: 61,
          desc: "Elegant stainless steel flask with a modern matte finish. Holds up to 500ml.",
          images: [
            "../assets/img/KF/11_0002s_0000_Layer-79.png",
            "../assets/img/KF/11_0002s_0001_Layer-80.png",
            "../assets/img/KF/11_0002s_0002_Layer-81.png",
          ],
        },
        "Tote Bag — K": {
          cat: "Tote Bags",
          price: "170 EGP",
          meta: "Eco-friendly • Durable",
          stars: 4,
          reviews: 25,
          desc: "A spacious, eco-friendly tote bag with durable straps for everyday carry.",
          images: [
            "../assets/img/KTB/11_0000s_0000_Layer-86.png",
          ],
        },
        "Notebook — K": {
          cat: "Notebooks",
          price: "120 EGP",
          meta: "Softcover • Pocket Size",
          stars: 5,
          reviews: 95,
          desc: "Compact softcover notebook that fits perfectly in your pocket. Great for quick notes.",
          images: [
            "../assets/img/KB/11_0003s_0000_Layer-76.png",
            "../assets/img/KB/11_0003s_0001_Layer-77.png",
          ],
        },
      };

      lucide.createIcons();

      // Function 3ashan n-filter el products bel category (T-shirts, Flasks, etc..)
      function filterCat(el, cat) {
        document
          .querySelectorAll(".cat")
          .forEach((c) => c.classList.remove("active"));
        el.classList.add("active");
        document.querySelectorAll(".sec-wrap").forEach((sec) => {
          sec.style.display =
            cat === "all" || sec.dataset.section === cat ? "" : "none";
        });
      }

      document.querySelectorAll(".product-card").forEach((card) => {
        card.addEventListener("click", (e) => {
          const name = card.querySelector(".prod-name").textContent.trim();
          openProduct(name);
        });
      });

      document.querySelectorAll(".add-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
          e.stopPropagation();
          const card = btn.closest(".product-card");
          const name = card.querySelector(".prod-name").textContent.trim();
          openProduct(name);
        });
      });

      let currentProduct = null;
      let cartItems = [];

      // Function b-tafta7 el modal beta3 el product w t3red tafaseelo
      function openProduct(name) {
        currentProduct = name;
        const p = PRODUCTS[name];
        if (!p) return;
        document.getElementById("modalCat").textContent = p.cat;
        document.getElementById("modalName").textContent = name;
        document.getElementById("modalPrice").textContent = p.price;
        document.getElementById("modalOld").textContent = p.oldPrice || "";
        document.getElementById("modalMeta").textContent = p.meta;
        document.getElementById("modalDesc").textContent = p.desc;
        const starsEl = document.getElementById("modalStars");
        starsEl.innerHTML =
          "★".repeat(p.stars) +
          (p.stars < 5
            ? '<span style="color:#e5e7eb">' +
              "★".repeat(5 - p.stars) +
              "</span>"
            : "") +
          `<small>(${p.reviews} reviews)</small>`;
        // gallery
        const thumbsEl = document.getElementById("modalThumbs");
        thumbsEl.innerHTML = "";
        p.images.forEach((src, i) => {
          const t = document.createElement("div");
          t.className = "modal-thumb" + (i === 0 ? " active" : "");
          t.innerHTML = `<img src="${src}" alt="">`;
          t.onclick = () => setMainImg(src, t);
          thumbsEl.appendChild(t);
        });
        setMainImg(p.images[0], null);
        document.getElementById("prodModal").classList.add("open");
        document.body.style.overflow = "hidden";
        lucide.createIcons();
      }

      // Function 3ashan n-ghayar el sora el kbera lma n-click 3ala thumbnail
      function setMainImg(src, thumb) {
        document.getElementById("modalMainImg").src = src;
        if (thumb) {
          document
            .querySelectorAll(".modal-thumb")
            .forEach((t) => t.classList.remove("active"));
          thumb.classList.add("active");
        }
      }

      // Function 3ashan n-2fel el product modal w n-rg3 el scroll lel body
      function closeModal(e, force) {
        if (force || e.target === document.getElementById("prodModal")) {
          document.getElementById("prodModal").classList.remove("open");
          document.body.style.overflow = "";
        }
      }

      // Function 3ashan n-zawed el product fel cart array w n-update el UI
      function addToCart() {
        if (!currentProduct) return;
        const p = PRODUCTS[currentProduct];
        cartItems.push({
          name: currentProduct,
          price: parseInt(p.price),
          img: p.images[0],
        });
        updateCartUI();
        closeModal(null, true);
      }

      // Function b-te7seb el total w t-render el items ely fel cart gowa el modal
      function updateCartUI() {
        document.getElementById("headerCartCount").textContent =
          cartItems.length;
        let total = cartItems.reduce((sum, item) => sum + item.price, 0);


        document.getElementById("cartModalTotal").textContent = `${total} EGP`;

        const container = document.getElementById("cartItemsContainer");
        container.innerHTML = "";
        if (cartItems.length === 0) {
          container.innerHTML =
            '<div style="text-align:center; padding: 40px 0; color:var(--gray);"><i data-lucide="shopping-cart" style="width:48px;height:48px;margin-bottom:16px;opacity:0.5;display:inline-block;"></i><p>Your cart is empty.</p></div>';
        } else {
          cartItems.forEach((item, index) => {
            container.innerHTML += `
        <div style="display:flex; align-items:center; gap:16px; background:var(--card-bg); padding:12px; border-radius:16px; border: 1px solid var(--card-border);">
          <img src="${item.img}" style="width:70px; height:70px; object-fit:contain; background:#fff; border-radius:10px; padding: 4px;">
          <div style="flex:1;">
            <div style="font-weight:700; font-size:15px; color:var(--text);">${item.name}</div>
            <div style="color:var(--primary); font-weight:800; margin-top:4px;">${item.price} EGP</div>
          </div>
          <button onclick="removeFromCart(${index})" style="background:#fee2e2; border:none; color:#dc2626; border-radius: 10px; cursor:pointer; padding:10px; display:flex; align-items:center; justify-content:center; transition: background 0.15s;">
            <i data-lucide="trash-2" style="width:18px;height:18px;"></i>
          </button>
        </div>
      `;
          });
        }
        lucide.createIcons();
      }

      // Function 3ashan n-msa7 item mn el cart bel index beta3o
      function removeFromCart(index) {
        cartItems.splice(index, 1);
        updateCartUI();
      }

      // Function b-tafta7 el cart modal 3ashan n-shof el items ely e5tarnaha
      function openCartModal() {
        updateCartUI();
        document.getElementById("cartModal").classList.add("open");
        document.body.style.overflow = "hidden";
      }

      // Function 3ashan n-2fel el cart modal
      function closeCartModal(e, force) {
        if (force || e.target === document.getElementById("cartModal")) {
          document.getElementById("cartModal").classList.remove("open");
          if (
            !document.getElementById("prodModal").classList.contains("open")
          ) {
            document.body.style.overflow = "";
          }
        }
      }

      // Initial setup
      updateCartUI();
