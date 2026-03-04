<?php
$pageTitle = 'Impressum – Garten2000 Handewitt';
$pageDesc  = 'Impressum und rechtliche Angaben von Garten2000 in Handewitt.';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>" />
  <meta name="robots" content="noindex, follow" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/pages.css" />
</head>
<body class="subpage">

  <!-- Navbar -->
  <nav id="navbar" role="navigation" aria-label="Hauptnavigation">
    <a href="../index.php" class="nav-logo" aria-label="Garten2000 Startseite">
      <img src="../assets/img/logo navbar.png" alt="Garten2000 Logo" class="nav-logo-img" />
    </a>
    <ul class="nav-links" role="list">
      <li><a href="../index.php#oeffnungszeiten">Öffnungszeiten</a></li>
      <li><a href="../index.php#ueber-uns">Über uns</a></li>
      <li><a href="../index.php#sortiment">Sortiment</a></li>
      <li><a href="../index.php#galerie">Galerie</a></li>
      <li><a href="../index.php#kontakt" class="nav-cta">Kontakt</a></li>
    </ul>
    <button class="nav-hamburger" id="navHamburger" aria-label="Menü öffnen" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- Mobile nav -->
  <div class="nav-mobile" id="navMobile" role="navigation" aria-label="Mobile Navigation">
    <a href="../index.php#oeffnungszeiten">🕐 Öffnungszeiten</a>
    <a href="../index.php#ueber-uns">🌿 Über uns</a>
    <a href="../index.php#sortiment">🌸 Sortiment</a>
    <a href="../index.php#galerie">📷 Galerie</a>
    <a href="../index.php#kontakt">📍 Kontakt</a>
  </div>

  <main class="subpage-main">
    <div class="container">
      <div class="subpage-header">
        <a href="../index.php" class="back-link">← Zurück zur Startseite</a>
        <span class="section-label">Rechtliches</span>
        <h1 class="section-title">Impressum</h1>
      </div>

      <div class="legal-content">

        <section class="legal-section">
          <h2>Angaben gemäß § 5 TMG</h2>
          <address>
            <strong>Garten2000 Handewitt</strong><br />
            Norderstraße 45<br />
            24983 Handewitt<br />
            Deutschland
          </address>
        </section>

        <section class="legal-section">
          <h2>Kontakt</h2>
          <p>
            Telefon: <a href="tel:+4904608XXXXX">04608 / XXXXX</a><br />
            E-Mail: <a href="mailto:info@garten2000-handewitt.de">info@garten2000-handewitt.de</a>
          </p>
        </section>

        <section class="legal-section">
          <h2>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h2>
          <address>
            Garten2000 Handewitt<br />
            Norderstraße 45<br />
            24983 Handewitt
          </address>
        </section>

        <section class="legal-section">
          <h2>Umsatzsteuer-Identifikationsnummer</h2>
          <p>
            Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz:<br />
            DE XXXXXXXXX
          </p>
        </section>

        <section class="legal-section">
          <h2>Haftung für Inhalte</h2>
          <p>
            Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten
            nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als
            Diensteanbieter jedoch nicht unter der Verpflichtung, übermittelte oder gespeicherte
            fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine
            rechtswidrige Tätigkeit hinweisen.
          </p>
          <p>
            Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den
            allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch
            erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei
            Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend
            entfernen.
          </p>
        </section>

        <section class="legal-section">
          <h2>Haftung für Links</h2>
          <p>
            Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir
            keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr
            übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter
            oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt
            der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum
            Zeitpunkt der Verlinkung nicht erkennbar.
          </p>
          <p>
            Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete
            Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von
            Rechtsverletzungen werden wir derartige Links umgehend entfernen.
          </p>
        </section>

        <section class="legal-section">
          <h2>Urheberrecht</h2>
          <p>
            Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten
            unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung
            und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der
            schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien
            dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.
          </p>
          <p>
            Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die
            Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche
            gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam
            werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von
            Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
          </p>
        </section>

        <section class="legal-section">
          <h2>Online-Streitbeilegung</h2>
          <p>
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
            <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer">
              https://ec.europa.eu/consumers/odr
            </a>.<br />
            Unsere E-Mail-Adresse finden Sie oben im Impressum.
          </p>
          <p>
            Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
            Verbraucherschlichtungsstelle teilzunehmen.
          </p>
        </section>

      </div><!-- .legal-content -->
    </div><!-- .container -->
  </main>

  <!-- Footer -->
  <footer role="contentinfo">
    <div class="container">
      <div class="footer-bottom" style="border-top: none; padding-top: 40px;">
        <p>© 2026 Garten2000 Handewitt · 50 Jahre Leidenschaft für Ihren Garten 🌿</p>
        <nav class="footer-bottom-links" aria-label="Rechtliche Links">
          <a href="impressum.php" aria-current="page">Impressum</a>
          <a href="datenschutz.php">Datenschutz</a>
        </nav>
      </div>
    </div>
  </footer>

  <script src="../js/main.js"></script>
</body>
</html>
