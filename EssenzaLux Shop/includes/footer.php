<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lux Footer</title>
  <style>
    :root {
      --main-color: #c19a6b;
      --gold: #bfa270;
      --text-color: #ddd;
      --white: #fff;
      --dark-bg:rgb(0, 0, 0);
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f2f2;
      color: var(--text-color);
    }

    .footer {
      background: var(--dark-bg);
      color: var(--text-color);
      padding: 5rem 2rem 3rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .footer::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 200%;
      height: 200%;
      background: linear-gradient(120deg, transparent 40%, var(--gold) 60%);
      opacity: 0.04;
      animation: shimmer 15s linear infinite;
      transform: rotate(5deg);
      z-index: 0;
    }

    @keyframes shimmer {
      0% { transform: translateX(-100%) rotate(5deg); }
      100% { transform: translateX(100%) rotate(5deg); }
    }

    .footer .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto 3rem;
      position: relative;
      z-index: 2;
    }

    .footer .box {
      padding: 2rem;
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.7s ease;
    }

    .footer .box.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .footer .box img {
      width: 50px;
      height: 50px;
      margin-bottom: 1rem;
      filter: brightness(0) invert(1);
      animation: pulse 2s infinite ease-in-out;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.05); opacity: 0.9; }
    }

    .footer .box h3 {
      margin-bottom: 1rem;
      font-size: 1.4rem;
      color: var(--gold);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .footer .box a,
    .footer .box p {
      color: var(--text-color);
      font-size: 1rem;
      text-decoration: none;
      margin-bottom: 0.5rem;
      transition: color 0.3s ease;
    }

    .footer .box a:hover {
      color: var(--gold);
    }

    .social-links {
      margin-top: 1.5rem;
      z-index: 2;
      position: relative;
    }

    .social-links a {
      display: inline-block;
      margin: 0 1rem;
    }

    .social-links img {
      width: 34px;
      height: 34px;
      filter: grayscale(100%) brightness(1.3);
      transition: transform 0.3s ease, filter 0.3s ease;
    }

    .social-links a:hover img {
      filter: none;
      transform: scale(1.2) rotate(5deg);
    }

    .footer .credit {
      font-size: 1.5rem;
      background: #111;
      padding: 2.5rem 1rem 1rem;
      color: var(--white);
      font-weight: 400;
      position: relative;
      z-index: 2;
      line-height: 2;
      animation: fadeIn 2s ease-in-out forwards;
    }

    .footer .credit span {
      display: block;
      font-size: 1.3rem;
      color: var(--gold);
      margin-top: 0.5rem;
      font-style: italic;
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
      .footer .credit {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>

  <footer class="footer">
    <section class="grid">
      <div class="box">
        <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Email">
        <h3>Email</h3>
        <a href="mailto:afafmzaourou8@gmail.com">contact@essenzalux.ma</a>
      </div>
      <div class="box">
        <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Delivery">
        <h3>Delivery</h3>
        <p>Free delivery in Casablanca</p>
        <p>2-3 days for other cities</p>
      </div>
      <div class="box">
        <img src="https://cdn-icons-png.flaticon.com/512/171/171990.png" alt="Location">
        <h3>Location</h3>
        <a href="#">Casablanca, Morocco</a>
      </div>
      <div class="box">
        <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" alt="Phone">
        <h3>Phone</h3>
        <a href="tel:+212608238391">+212 608 238 391</a>
      </div>
    </section>

    <div class="social-links">
      <a href="https://www.facebook.com/share/15DKYmxqRH/" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/145/145802.png" alt="Facebook">
      </a>
      <a href="https://instagram.com" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram">
      </a>
      <a href="https://wa.me/212608238391" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp">
      </a>
    </div>

    <div class="credit">
      &copy; 2025 <strong>EssenzaLux</strong> — Where Luxury Meets Simplicity.
      <span>Indulge your senses. Uncover the elegance of every drop.</span>
    </div>
  </footer>

  <script>
    const boxes = document.querySelectorAll('.footer .box');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.2 });

    boxes.forEach(box => observer.observe(box));
  </script>
</body>
</html>