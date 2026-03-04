<?php
/**
 * Garten2000 – Startseite
 * Liest Galeriebilder dynamisch aus assets/img/gallery/
 */

// Erlaubte Bilddateierweiterungen für die Galerie
$allowedGalleryExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
$galleryDir  = __DIR__ . '/assets/img/gallery/';
$galleryImgs = [];

if (is_dir($galleryDir)) {
    $files = scandir($galleryDir);
    foreach ($files as $f) {
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedGalleryExt, true)) {
            $galleryImgs[] = $f;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Garten2000 in Handewitt – Ihr Gartencenter für Pflanzen, Gartendeko und mehr. Seit 50 Jahren Ihr Ansprechpartner für einen schönen Garten." />
  <meta name="keywords" content="Gartencenter, Handewitt, Pflanzen, Gartendeko, Stauden, Blumen, Garten2000" />
  <meta name="theme-color" content="#1B4332" />

  <!-- Open Graph -->
  <meta property="og:title" content="Garten2000 – Gartencenter Handewitt" />
  <meta property="og:description" content="Entdecken Sie unser vielfältiges Sortiment. Pflanzen, Deko, Werkzeug und mehr – seit 50 Jahren in Handewitt." />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80" />

  <title>Garten2000 – Gartencenter Handewitt</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- ============================================================
       INTRO SPLASH – 50 Jahre Garten2000
       ============================================================ -->
  <div id="intro" role="dialog" aria-label="Jubiläumsintro">
    <!-- Leaf particles -->
    <div class="intro-leaves" id="introLeaves"></div>

    <div class="intro-content">
      <div class="intro-badge">✦ Jubiläum ✦</div>
      <div class="intro-fifty" aria-label="50">50</div>
      <div class="intro-jahre">Jahre</div>
      <div class="intro-brand">Garten<span>2000</span></div>
      <div class="intro-tagline">Handewitt · Seit 1976 · Mit Leidenschaft</div>
      <div class="intro-progress" aria-hidden="true">
        <div class="intro-progress-bar"></div>
      </div>
      <button class="intro-skip" id="introSkip" aria-label="Intro überspringen">
        Überspringen →
      </button>
    </div>
  </div>

  <!-- ============================================================
       NAVIGATION
       ============================================================ -->
  <nav id="navbar" role="navigation" aria-label="Hauptnavigation">
    <a href="#hero" class="nav-logo" aria-label="Garten2000 Startseite">
      <img src="assets/img/logo navbar.png" alt="Garten2000 Handewitt" class="nav-logo-img" />
    </a>

    <ul class="nav-links" role="list">
      <li><a href="#oeffnungszeiten">Öffnungszeiten</a></li>
      <li><a href="#ueber-uns">Über uns</a></li>
      <li><a href="#sortiment">Sortiment</a></li>
      <li><a href="#galerie">Galerie</a></li>
      <li><a href="#kontakt" class="nav-cta">Kontakt</a></li>
    </ul>

    <button class="nav-hamburger" id="navHamburger" aria-label="Menü öffnen" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- Mobile nav -->
  <div class="nav-mobile" id="navMobile" role="navigation" aria-label="Mobile Navigation">
    <a href="#oeffnungszeiten">🕐 Öffnungszeiten</a>
    <a href="#ueber-uns">🌿 Über uns</a>
    <a href="#sortiment">🌸 Sortiment</a>
    <a href="#galerie">📷 Galerie</a>
    <a href="#kontakt">📍 Kontakt</a>
  </div>

  <!-- ============================================================
       HERO
       ============================================================ -->
  <section id="hero" aria-label="Willkommen bei Garten2000">
    <div class="hero-bg"></div>
    <div class="hero-image" role="img" aria-label="Blühender Garten"></div>

    <!-- Decorative floral SVG overlays -->
    <div class="hero-floral hero-floral-tl" aria-hidden="true">
      <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
        <g opacity="1">
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#52B788" transform="rotate(0 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#40916C" transform="rotate(40 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#2D6A4F" transform="rotate(80 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#52B788" transform="rotate(120 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#74C69D" transform="rotate(160 200 200)"/>
          <circle cx="200" cy="200" r="28" fill="#95D5B2"/>
        </g>
      </svg>
    </div>

    <div class="hero-floral hero-floral-br" aria-hidden="true">
      <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
        <g opacity="1">
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#2D6A4F" transform="rotate(0 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#52B788" transform="rotate(45 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#40916C" transform="rotate(90 200 200)"/>
          <ellipse cx="200" cy="200" rx="160" ry="60" fill="#74C69D" transform="rotate(135 200 200)"/>
          <circle cx="200" cy="200" r="28" fill="#95D5B2"/>
        </g>
      </svg>
    </div>

    <div class="hero-content">
      <div class="hero-eyebrow">
        <span class="dot"></span>
        50 Jahre Garten2000 · Handewitt
      </div>

      <h1 class="hero-title">
        Ihr Garten.
        <span class="accent">Unser Herz.</span>
      </h1>

      <p class="hero-subtitle">
        Willkommen in Ihrem Gartencenter in Handewitt. Seit 1976 bringen wir Farbe, Leben und 
        Freude in Ihre Gärten – mit Leidenschaft, Erfahrung und einem Lächeln.
      </p>

      <div class="hero-actions">
        <a href="#oeffnungszeiten" class="btn btn-primary">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7z"/></svg>
          Öffnungszeiten
        </a>
        <a href="#ueber-uns" class="btn btn-glass">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
          Über uns
        </a>
      </div>
    </div>

    <div class="hero-scroll" aria-hidden="true">
      <div class="scroll-mouse"></div>
      <span>Entdecken</span>
    </div>

    <!-- Wave divider -->
    <div class="hero-wave" aria-hidden="true">
      <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#ffffff"/>
      </svg>
    </div>
  </section>

  <!-- ============================================================
       QUICK INFO BAR
       ============================================================ -->
  <section id="quick-info" aria-label="Schnellinfos">
    <div class="quick-info-grid">
      <div class="quick-info-item reveal">
        <div class="quick-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7z"/></svg>
        </div>
        <div class="quick-info-text">
          <strong>Mo–Fr 9–18 Uhr</strong>
          <span>Sa 9–17 · So 10–14 Uhr</span>
        </div>
      </div>
      <div class="quick-info-item reveal">
        <div class="quick-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
        </div>
        <div class="quick-info-text">
          <strong>Handewitt</strong>
          <span>Direkt an der B200</span>
        </div>
      </div>
      <div class="quick-info-item reveal">
        <div class="quick-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79a15.91 15.91 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24 11.72 11.72 0 0 0 3.67.59 1 1 0 0 1 1 1v3.58a1 1 0 0 1-1 1A17 17 0 0 1 3 5a1 1 0 0 1 1-1h3.59a1 1 0 0 1 1 1 11.72 11.72 0 0 0 .59 3.67 1 1 0 0 1-.25 1.01z"/></svg>
        </div>
        <div class="quick-info-text">
          <strong>04608 / XXXXX</strong>
          <span>Wir beraten Sie gerne</span>
        </div>
      </div>
      <div class="quick-info-item reveal">
        <div class="quick-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 8C8 10 5.9 16.17 3.82 20.33L5.71 21l1-2.3A4.49 4.49 0 0 0 8 19c8 0 12-8 12-8a11.9 11.9 0 0 1-3 3z"/><path d="M15 3c-2.21 0-4 1.34-4 3v2c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V6c0-1.66-1.79-3-4-3z"/></svg>
        </div>
        <div class="quick-info-text">
          <strong>50 Jahre Erfahrung</strong>
          <span>Kompetente Fachberatung</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       ÖFFNUNGSZEITEN
       ============================================================ -->
  <section id="oeffnungszeiten" aria-labelledby="oe-heading">
    <div class="container">
      <div class="section-header">
        <span class="section-label">Wann wir für Sie da sind</span>
        <h2 class="section-title" id="oe-heading">Öffnungszeiten</h2>
        <p class="section-subtitle">
          Wir freuen uns auf Ihren Besuch! Kommen Sie vorbei und lassen Sie sich von unserem 
          vielfältigen Sortiment inspirieren.
        </p>
      </div>

      <div class="oeffnungszeiten-wrapper">
        <!-- Öffnungszeiten Tabelle -->
        <div class="oeffnungszeiten-card reveal-left">
          <div class="oe-header">
            <div class="oe-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7z"/></svg>
            </div>
            <div class="oe-header-text">
              <h3>Öffnungszeiten</h3>
              <span>
                <span class="oe-badge oe-badge-open">
                  <span class="dot"></span><span class="oe-badge-label">Jetzt geöffnet</span>
                </span>
              </span>
            </div>
          </div>

          <table class="oe-table" aria-label="Öffnungszeiten">
            <tbody>
              <tr>
                <td>Montag</td>
                <td>9:00 – 18:00 Uhr</td>
              </tr>
              <tr>
                <td>Dienstag</td>
                <td>9:00 – 18:00 Uhr</td>
              </tr>
              <tr>
                <td>Mittwoch</td>
                <td>9:00 – 18:00 Uhr</td>
              </tr>
              <tr>
                <td>Donnerstag</td>
                <td>9:00 – 18:00 Uhr</td>
              </tr>
              <tr>
                <td>Freitag</td>
                <td>9:00 – 18:00 Uhr</td>
              </tr>
              <tr>
                <td>Samstag</td>
                <td>9:00 – 17:00 Uhr</td>
              </tr>
              <tr>
                <td>Sonntag</td>
                <td>10:00 – 14:00 Uhr</td>
              </tr>
            </tbody>
          </table>

          <div class="oe-note" role="note">
            🌸 <strong>Saisonhinweis:</strong> In der Hauptgartensaison (März–Juni) können die 
            Öffnungszeiten abweichen. Bitte rufen Sie vorab an oder schauen Sie auf unsere 
            sozialen Medien.
          </div>
        </div>

        <!-- Info-Karten -->
        <div class="info-card reveal-right">
          <div class="info-block">
            <div class="info-block-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
            </div>
            <div class="info-block-text">
              <h4>Adresse</h4>
              <p>Garten2000 Handewitt<br />Norderstraße 45<br />24983 Handewitt</p>
            </div>
          </div>

          <div class="info-block">
            <div class="info-block-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79a15.91 15.91 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24 11.72 11.72 0 0 0 3.67.59 1 1 0 0 1 1 1v3.58a1 1 0 0 1-1 1A17 17 0 0 1 3 5a1 1 0 0 1 1-1h3.59a1 1 0 0 1 1 1 11.72 11.72 0 0 0 .59 3.67 1 1 0 0 1-.25 1.01z"/></svg>
            </div>
            <div class="info-block-text">
              <h4>Telefon & E-Mail</h4>
              <p>
                <a href="tel:+490000000000">04608 / XXXXX</a><br />
                <a href="mailto:info@garten2000-handewitt.de">info@garten2000-handewitt.de</a>
              </p>
            </div>
          </div>

          <div class="info-block">
            <div class="info-block-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-5h14v5z"/><circle cx="7.5" cy="14.5" r="1.5"/><circle cx="16.5" cy="14.5" r="1.5"/></svg>
            </div>
            <div class="info-block-text">
              <h4>Parken &amp; Anreise</h4>
              <p>Kostenloser Parkplatz direkt vor dem Geschäft. Gut erreichbar über die B200.</p>
            </div>
          </div>

          <div class="info-block">
            <div class="info-block-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"/></svg>
            </div>
            <div class="info-block-text">
              <h4>Newsletter</h4>
              <p>Aktuelle Angebote und saisonale Tipps direkt in Ihr Postfach.<br />
                <a href="mailto:info@garten2000-handewitt.de">Jetzt anmelden →</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       ÜBER UNS
       ============================================================ -->
  <div class="wave-divider" aria-hidden="true" style="background: linear-gradient(180deg, #c7f0d5 0%, #ffffff 100%);">
    <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0,30 C480,60 960,0 1440,30 L1440,0 L0,0 Z" fill="#D8F3DC"/>
    </svg>
  </div>

  <section id="ueber-uns" aria-labelledby="ue-heading">
    <div class="container">
      <div class="ueber-grid">
        <!-- Images -->
        <div class="ueber-images reveal-left">
          <img
            src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=800&q=80&fit=crop"
            alt="Unser Gartencenter in Handewitt mit vielfältigem Pflanzensortiment"
            class="ueber-img-main"
            loading="lazy"
          />
          <img
            src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=400&q=80&fit=crop"
            alt="Frische Saisonpflanzen in unserem Gartencenter"
            class="ueber-img-float"
            loading="lazy"
          />
          <div class="ueber-anniversary" aria-label="50 Jahre Jubiläum">
            <div class="ann-number">50</div>
            <div class="ann-text">Jahre</div>
            <div class="ann-text">Garten2000</div>
          </div>
        </div>

        <!-- Content -->
        <div class="ueber-content reveal-right">
          <span class="section-label">Über uns</span>
          <h2 class="section-title" id="ue-heading">
            Leidenschaft für den Garten – seit 1976
          </h2>

          <p class="ueber-text">
            Was 1976 als kleines Gartencenter in Handewitt begann, ist heute eine Institution 
            in der Region Schleswig-Holstein. In diesem besonderen Jahr feiern wir unser 
            <strong>50-jähriges Jubiläum</strong> – und das mit Ihnen, unseren treuen Kunden.
          </p>

          <p class="ueber-text">
            Auf unserem weitläufigen Gelände direkt an der B200 bieten wir Ihnen auf 
            mehreren tausend Quadratmetern eine riesige Auswahl an Pflanzen, Gartenbedarf 
            und Dekoration – stets frisch, saisonal und mit fachkundiger Beratung.
          </p>

          <p class="ueber-text">
            Unser Team aus erfahrenen Gärtnern und Fachberatern steht Ihnen das ganze Jahr 
            mit Rat und Tat zur Seite. Ob Balkonbepflanzung, Staudenrabatte oder 
            Weihnachtsgestaltung – wir finden gemeinsam die perfekte Lösung für Ihren Garten.
          </p>

          <!-- Ausbildung -->
          <div class="ueber-ausbildung">
            <div class="ausbildung-icon" aria-hidden="true">🌱</div>
            <div>
              <h3>Ausbildung bei Garten2000</h3>
              <p>
                Wir bilden seit vielen Jahren erfolgreich aus! Bei uns können Sie eine 
                Ausbildung zum <strong>Gärtner/zur Gärtnerin (Fachrichtung Zierpflanzenbau)</strong>
                oder zum <strong>Verkäufer/zur Verkäuferin</strong> absolvieren. 
                Theorie und Praxis gehen bei uns Hand in Hand – in einem familiären, 
                herzlichen Umfeld mit echten Entwicklungsmöglichkeiten.
              </p>
              <p>
                Interesse? Schreiben Sie uns einfach eine E-Mail oder kommen Sie direkt 
                in unserem Gartencenter vorbei. Wir freuen uns auf engagierte Nachwuchskräfte, 
                die Pflanzen und Natur genauso lieben wie wir!
              </p>
            </div>
          </div>

          <div class="ueber-values">
            <div class="ueber-value">
              <div class="ueber-value-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
              </div>
              <div class="ueber-value-text">
                <strong>Familiengeführt</strong>
                <span>Persönliche Beratung &amp; Herzlichkeit</span>
              </div>
            </div>
            <div class="ueber-value">
              <div class="ueber-value-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 8C8 10 5.9 16.17 3.82 20.33L5.71 21l1-2.3A4.49 4.49 0 0 0 8 19c8 0 12-8 12-8a11.9 11.9 0 0 1-3 3z"/><path d="M15 3c-2.21 0-4 1.34-4 3v2c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V6c0-1.66-1.79-3-4-3z"/></svg>
              </div>
              <div class="ueber-value-text">
                <strong>Regionale Qualität</strong>
                <span>Frische Pflanzen aus der Region</span>
              </div>
            </div>
            <div class="ueber-value">
              <div class="ueber-value-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              </div>
              <div class="ueber-value-text">
                <strong>50 Jahre Erfahrung</strong>
                <span>Fachkompetenz die überzeugt</span>
              </div>
            </div>
            <div class="ueber-value">
              <div class="ueber-value-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
              </div>
              <div class="ueber-value-text">
                <strong>Ausbildungsbetrieb</strong>
                <span>Wir bilden mit Herz aus</span>
              </div>
            </div>
          </div>

          <div class="team-note">
            <div class="team-note-avatar" aria-hidden="true">🌱</div>
            <div class="team-note-text">
              „Wir lieben Pflanzen und Gärten – und diese Leidenschaft teilen wir jeden Tag 
              mit unseren Kunden. Kommen Sie vorbei, wir beraten Sie herzlich gerne!"
              <strong>– Das Team von Garten2000</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       SORTIMENT
       ============================================================ -->
  <div class="wave-divider" aria-hidden="true" style="background: white;">
    <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0,0 C480,60 960,0 1440,60 L1440,60 L0,60 Z" fill="#2D6A4F"/>
    </svg>
  </div>

  <section id="sortiment" aria-labelledby="sortiment-heading">
    <div class="container">
      <div class="section-header">
        <span class="section-label">Was wir anbieten</span>
        <h2 class="section-title" id="sortiment-heading">Unser Sortiment</h2>
        <p class="section-subtitle">
          Von seltenen Stauden bis zu klassischen Gartengeräten – bei uns finden Sie alles 
          für einen schönen Garten.
        </p>
      </div>

      <div class="sortiment-grid">
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Blume">🌸</span>
          <h3>Saisonpflanzen</h3>
          <p>Bunte Wechselbepflanzung für Balkon, Terrasse und Beete – frisch und farbenfroh.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Baum">🌳</span>
          <h3>Bäume &amp; Sträucher</h3>
          <p>Heimische und exotische Gehölze für jeden Garten – vom Zierstrauch bis zum Obstbaum.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Pflanze">🌿</span>
          <h3>Stauden</h3>
          <p>Mehrjährige Prachtpflanzen für naturnahe und pflegeleichte Gärten.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Kräuter">🌱</span>
          <h3>Kräuter &amp; Gemüse</h3>
          <p>Aromatische Kräuter, Tomatenpflanzen und Gemüsesetzlinge für Ihren Nutzgarten.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Blumentopf">🪴</span>
          <h3>Erde &amp; Dünger</h3>
          <p>Hochwertige Substrate und Dünger für optimales Pflanzenwachstum.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Werkzeug">🛠️</span>
          <h3>Werkzeug &amp; Zubehör</h3>
          <p>Hochwertige Gartengeräte und praktisches Zubehör für jede Gartenaufgabe.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Deko">🏡</span>
          <h3>Gartendekoration</h3>
          <p>Stilvolle Deko für Garten und Terrasse – von klassisch bis modern.</p>
        </div>
        <div class="sortiment-card reveal">
          <span class="sortiment-emoji" role="img" aria-label="Stuhl">🪑</span>
          <h3>Gartenmöbel</h3>
          <p>Komfortable und wetterfeste Möbel für entspannte Stunden im Freien.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       GALERIE
       ============================================================ -->
  <div class="wave-divider" aria-hidden="true" style="background: #2D6A4F;">
    <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0,60 C480,0 960,60 1440,0 L1440,60 L0,60 Z" fill="#F0FBF3"/>
    </svg>
  </div>

  <section id="galerie" aria-labelledby="galerie-heading">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Eindrücke</span>
        <h2 class="section-title" id="galerie-heading">Galerie</h2>
        <p class="section-subtitle">
          Lassen Sie sich von der Vielfalt und Schönheit unseres Gartencenters inspirieren.
        </p>
      </div>

      <div class="galerie-grid" id="galerieGrid">
        <?php
        // CSS-Klassen für abwechselnde Hintergründe der Galerie-Items
        $bgClasses = ['galerie-bg-1','galerie-bg-2','galerie-bg-3','galerie-bg-4','galerie-bg-5','galerie-bg-6'];
        $bgCount   = count($bgClasses);

        if (!empty($galleryImgs)):
          // Eigene Galeriebilder aus assets/img/gallery/ anzeigen
          foreach ($galleryImgs as $i => $imgFile):
            $bgClass = $bgClasses[$i % $bgCount];
            $imgPath = 'assets/img/gallery/' . htmlspecialchars($imgFile);
            $imgAlt  = htmlspecialchars(pathinfo($imgFile, PATHINFO_FILENAME));
        ?>
        <div class="galerie-item <?= $bgClass ?> reveal" data-caption="<?= $imgAlt ?>">
          <img
            src="<?= $imgPath ?>"
            alt="<?= $imgAlt ?>"
            loading="lazy"
          />
          <div class="galerie-overlay">
            <span class="galerie-overlay-text"><?= $imgAlt ?></span>
          </div>
        </div>
        <?php
          endforeach;
        else:
          // Platzhalter-Bilder wenn die Galerie noch leer ist
          $placeholders = [
            ['src'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=75&fit=crop','alt'=>'Farbenfrohe Blumen und Pflanzen in unserem Gartencenter','caption'=>'Blühende Vielfalt','bg'=>'galerie-bg-1'],
            ['src'=>'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=75&fit=crop','alt'=>'Pflanzenhalle mit grünen Pflanzen und Sträuchern','caption'=>'Pflanzenhalle','bg'=>'galerie-bg-2'],
            ['src'=>'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=600&q=75&fit=crop','alt'=>'Frische Kräuter und Gemüsesetzlinge','caption'=>'Kräuter &amp; Gemüse','bg'=>'galerie-bg-3'],
            ['src'=>'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&q=75&fit=crop','alt'=>'Vielfältige Staudenpflanzen im Freiland','caption'=>'Stauden &amp; Beete','bg'=>'galerie-bg-4'],
            ['src'=>'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=600&q=75&fit=crop','alt'=>'Elegante Gartendekoration und Keramik','caption'=>'Gartendekoration','bg'=>'galerie-bg-5'],
            ['src'=>'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=800&q=75&fit=crop','alt'=>'Große Bäume und Sträucher im Außenbereich','caption'=>'Bäume &amp; Sträucher','bg'=>'galerie-bg-1'],
            ['src'=>'https://images.unsplash.com/photo-1485955900006-10f4d324d411?w=600&q=75&fit=crop','alt'=>'Dekorative Topfpflanzen und Zimmerpflanzen','caption'=>'Topfpflanzen','bg'=>'galerie-bg-6'],
            ['src'=>'https://images.unsplash.com/photo-1597848212624-a19eb35e2651?w=600&q=75&fit=crop','alt'=>'Strahlende Sonnenblumen in voller Blüte','caption'=>'Sonnenblumen','bg'=>'galerie-bg-2'],
            ['src'=>'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=800&q=75&fit=crop','alt'=>'Weitläufiger Außenbereich mit Bäumen und Sträuchern','caption'=>'Außenbereich','bg'=>'galerie-bg-3'],
          ];
          foreach ($placeholders as $p):
        ?>
        <div class="galerie-item <?= $p['bg'] ?> reveal" data-caption="<?= $p['caption'] ?>">
          <img
            src="<?= $p['src'] ?>"
            alt="<?= $p['alt'] ?>"
            loading="lazy"
          />
          <div class="galerie-overlay">
            <span class="galerie-overlay-text"><?= $p['caption'] ?></span>
          </div>
        </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </section>

  <!-- ============================================================
       WARUM GARTEN2000
       ============================================================ -->
  <section id="warum" aria-labelledby="warum-heading">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">Gute Gründe</span>
        <h2 class="section-title" id="warum-heading">Warum Garten2000?</h2>
        <p class="section-subtitle">
          Wir sind mehr als ein Gartencenter – wir sind Ihr Partner für einen schönen Garten.
        </p>
      </div>

      <div class="warum-grid">
        <div class="warum-card reveal">
          <div class="warum-number" aria-hidden="true">01</div>
          <h3>Persönliche Beratung</h3>
          <p>Unser erfahrenes Team nimmt sich Zeit für Sie und Ihre Fragen. Egal ob Gartenanfänger 
             oder leidenschaftlicher Hobbygärtner – wir helfen Ihnen gerne weiter.</p>
        </div>
        <div class="warum-card reveal">
          <div class="warum-number" aria-hidden="true">02</div>
          <h3>Riesige Auswahl</h3>
          <p>Auf unserer großzügigen Fläche finden Sie Tausende von Pflanzensorten, Gartenzubehör 
             und Dekoartikel – immer frisch und saisonal passend.</p>
        </div>
        <div class="warum-card reveal">
          <div class="warum-number" aria-hidden="true">03</div>
          <h3>Regionale Qualität</h3>
          <p>Wir beziehen einen Großteil unserer Pflanzen von regionalen Gärtnereien – für 
             maximale Frische und klimatisch passende Pflanzenauswahl.</p>
        </div>
        <div class="warum-card reveal">
          <div class="warum-number" aria-hidden="true">04</div>
          <h3>Barrierearm</h3>
          <p>Ebenerdige Wege, breite Gänge und ein freundliches Team sorgen dafür, dass sich 
             alle Besucher bei uns wohlfühlen.</p>
        </div>
        <div class="warum-card reveal">
          <div class="warum-number" aria-hidden="true">05</div>
          <h3>Kostenloser Parkplatz</h3>
          <p>Großer, kostenloser Parkplatz direkt am Eingang – bequemes Einkaufen ohne Stress 
             und mit viel Platz für Ihren Einkauf.</p>
        </div>
        <div class="warum-card reveal">
          <div class="warum-number" aria-hidden="true">06</div>
          <h3>50 Jahre Vertrauen</h3>
          <p>Seit einem halben Jahrhundert vertrauen Familien aus der Region Handewitt auf unsere 
             Expertise, Qualität und Herzlichkeit.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       CTA BANNER
       ============================================================ -->
  <section id="cta-banner" aria-label="Besuchen Sie uns">
    <div class="container">
      <div class="cta-content reveal">
        <h2>Besuchen Sie uns noch heute!</h2>
        <p>
          Entdecken Sie die Vielfalt von Garten2000 persönlich. Unser freundliches Team 
          freut sich auf Sie – täglich frische Pflanzen warten auf ihr neues Zuhause.
        </p>
        <div class="cta-actions">
          <a href="#oeffnungszeiten" class="btn btn-white">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7z"/></svg>
            Öffnungszeiten
          </a>
          <a href="#kontakt" class="btn btn-glass">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
            Anfahrt &amp; Kontakt
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       KONTAKT
       ============================================================ -->
  <section id="kontakt" aria-labelledby="kontakt-heading">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-label">So finden Sie uns</span>
        <h2 class="section-title" id="kontakt-heading">Kontakt &amp; Anfahrt</h2>
        <p class="section-subtitle">
          Wir sind direkt an der B200 in Handewitt – leicht zu finden, bequem zu parken.
        </p>
      </div>

      <div class="kontakt-grid">
        <!-- Contact info -->
        <div class="kontakt-info reveal-left">
          <div class="kontakt-card">
            <h3>Kontaktdaten</h3>
            <div class="kontakt-item">
              <div class="kontakt-item-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
              </div>
              <div class="kontakt-item-text">
                <strong>Adresse</strong>
                Garten2000 Handewitt<br />
                Norderstraße 45<br />
                24983 Handewitt
              </div>
            </div>
            <div class="kontakt-item">
              <div class="kontakt-item-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79a15.91 15.91 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24 11.72 11.72 0 0 0 3.67.59 1 1 0 0 1 1 1v3.58a1 1 0 0 1-1 1A17 17 0 0 1 3 5a1 1 0 0 1 1-1h3.59a1 1 0 0 1 1 1 11.72 11.72 0 0 0 .59 3.67 1 1 0 0 1-.25 1.01z"/></svg>
              </div>
              <div class="kontakt-item-text">
                <strong>Telefon</strong>
                <a href="tel:+490000000000">04608 / XXXXX</a>
              </div>
            </div>
            <div class="kontakt-item">
              <div class="kontakt-item-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"/></svg>
              </div>
              <div class="kontakt-item-text">
                <strong>E-Mail</strong>
                <a href="mailto:info@garten2000-handewitt.de">info@garten2000-handewitt.de</a>
              </div>
            </div>
            <div class="kontakt-item">
              <div class="kontakt-item-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7z"/></svg>
              </div>
              <div class="kontakt-item-text">
                <strong>Öffnungszeiten</strong>
                Mo–Fr: 9:00–18:00 Uhr<br />
                Sa: 9:00–17:00 Uhr<br />
                So: 10:00–14:00 Uhr
              </div>
            </div>
          </div>
        </div>

        <!-- Map -->
        <div class="kontakt-map reveal-right">
          <div class="map-header">
            <h3>Standort Handewitt</h3>
            <a
              href="https://www.google.com/maps/search/Garten2000+Handewitt"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="In Google Maps öffnen"
            >
              <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M19 19H5V5h7V3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/></svg>
              In Google Maps öffnen
            </a>
          </div>
          <div class="map-placeholder">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
            <p>Garten2000 · Norderstraße 45 · 24983 Handewitt</p>
            <a
              href="https://www.google.com/maps/search/Garten2000+Handewitt"
              target="_blank"
              rel="noopener noreferrer"
            >
              Route planen →
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       FOOTER
       ============================================================ -->
  <footer role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo">
            <div class="logo-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 8C8 10 5.9 16.17 3.82 20.33L5.71 21l1-2.3A4.49 4.49 0 0 0 8 19c8 0 12-8 12-8a11.9 11.9 0 0 1-3 3z"/>
                <path d="M15 3c-2.21 0-4 1.34-4 3v2c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V6c0-1.66-1.79-3-4-3z"/>
              </svg>
            </div>
            Garten2000
          </div>
          <p>
            Ihr Gartencenter in Handewitt seit 1976. Qualität, Leidenschaft und 
            persönliche Beratung – das ist unser Versprechen.
          </p>
          <div class="footer-social">
            <a href="#" aria-label="Facebook">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" aria-label="Instagram">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" fill="none" stroke="currentColor" stroke-width="2"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="currentColor" stroke-width="2"/></svg>
            </a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Navigation</h4>
          <ul role="list">
            <li><a href="#hero">Startseite</a></li>
            <li><a href="#oeffnungszeiten">Öffnungszeiten</a></li>
            <li><a href="#ueber-uns">Über uns</a></li>
            <li><a href="#sortiment">Sortiment</a></li>
            <li><a href="#galerie">Galerie</a></li>
            <li><a href="#kontakt">Kontakt</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Sortiment</h4>
          <ul role="list">
            <li><a href="#sortiment">Saisonpflanzen</a></li>
            <li><a href="#sortiment">Bäume &amp; Sträucher</a></li>
            <li><a href="#sortiment">Stauden</a></li>
            <li><a href="#sortiment">Kräuter &amp; Gemüse</a></li>
            <li><a href="#sortiment">Erde &amp; Dünger</a></li>
            <li><a href="#sortiment">Gartendekoration</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Kontakt</h4>
          <ul role="list">
            <li><a href="tel:+490000000000">📞 04608 / XXXXX</a></li>
            <li><a href="mailto:info@garten2000-handewitt.de">✉ E-Mail</a></li>
            <li><a href="#kontakt">📍 Anfahrt</a></li>
            <li><a href="https://www.garten2000-handewitt.de" target="_blank" rel="noopener">🔗 Alte Webseite</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2026 Garten2000 Handewitt · 50 Jahre Leidenschaft für Ihren Garten 🌿</p>
        <nav class="footer-bottom-links" aria-label="Rechtliche Links">
          <a href="pages/impressum.php">Impressum</a>
          <a href="pages/datenschutz.php">Datenschutz</a>
        </nav>
      </div>
    </div>
  </footer>

  <!-- Lightbox -->
  <div id="lightbox" role="dialog" aria-label="Bildansicht" aria-modal="true">
    <div class="lightbox-inner">
      <button class="lightbox-close" id="lightboxClose" aria-label="Schließen">×</button>
      <img id="lightboxImg" src="" alt="" />
    </div>
  </div>

  <!-- Back to top -->
  <button id="back-top" aria-label="Nach oben scrollen">
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
    </svg>
  </button>

  <!-- Script -->
  <script src="js/main.js"></script>
</body>
</html>
