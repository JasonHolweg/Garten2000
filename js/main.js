/* ============================================================
   Garten2000 – Haupt-JavaScript
   Alle interaktiven Funktionen der Webseite in einem File.
   Jeder Abschnitt ist als eigenständige IIFE (Immediately
   Invoked Function Expression) gekapselt, um globale Variablen
   zu vermeiden und Konflikte zwischen Abschnitten zu verhindern.
   ============================================================ */

'use strict';

// ============================================================
// INTRO SPLASH – Animiertes 50-Jahre-Jubiläums-Intro
// Zeigt sich beim ersten Laden der Seite und blendet sich
// nach 5,5 Sekunden automatisch aus (oder auf Klick/Escape).
// ============================================================
(function initIntro() {
  // DOM-Elemente holen
  const intro      = document.getElementById('intro');
  const skipBtn    = document.getElementById('introSkip');
  const leavesContainer = document.getElementById('introLeaves');

  // Falls das Intro-Element nicht existiert (z.B. auf Unterseiten), abbrechen
  if (!intro) return;

  // ---- Blatt-Partikel generieren ----
  // Drei verschiedene SVG-Formen für die animierten Blätter
  const leafSVGs = [
    // Einfache Blattform
    `<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 8C8 10 5.9 16.17 3.82 20.33L5.71 21l1-2.3A4.49 4.49 0 0 0 8 19c8 0 12-8 12-8a11.9 11.9 0 0 1-3 3z"/></svg>`,
    // Ovales Blatt (gedreht)
    `<svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><ellipse cx="12" cy="12" rx="6" ry="10" transform="rotate(-30 12 12)"/></svg>`,
    // Kleine Blüte
    `<svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="4"/><circle cx="12" cy="5" r="3"/><circle cx="12" cy="19" r="3"/><circle cx="5" cy="12" r="3"/><circle cx="19" cy="12" r="3"/></svg>`,
  ];

  // Grüntöne für die Blatt-SVGs
  const greenShades = [
    'rgba(82,183,136,0.7)',
    'rgba(149,213,178,0.6)',
    'rgba(116,198,157,0.65)',
    'rgba(52,183,99,0.55)',
    'rgba(208,243,220,0.5)',
  ];

  // 18 Blatt-Partikel mit zufälligen Positionen und Timings erstellen
  for (let i = 0; i < 18; i++) {
    const leaf = document.createElement('div');
    leaf.className = 'leaf';

    // SVG-Form reihum zuweisen
    const svgIndex = i % leafSVGs.length;
    leaf.innerHTML = leafSVGs[svgIndex];

    // Farbe des SVG-Pfads setzen
    leaf.querySelector('svg').style.fill = greenShades[i % greenShades.length];

    // Zufällige horizontale Startposition (0–100 % Breite)
    const startX = Math.random() * 100;
    // Zufällige Verzögerung vor dem Start der Animation
    const delay  = Math.random() * 2.5;
    // Zufällige Animationsdauer
    const dur    = 3 + Math.random() * 2;
    // Zufällige Skalierung (Größe)
    const size   = 0.6 + Math.random() * 1.2;

    leaf.style.left              = `${startX}%`;
    leaf.style.animationDelay    = `${delay}s`;
    leaf.style.animationDuration = `${dur}s`;
    leaf.style.transform         = `scale(${size})`;

    leavesContainer.appendChild(leaf);
  }

  // ---- Intro ausblenden ----
  // Gesamtzeit: 1,5 s Verzögerung + 3,5 s Ladebalken + 0,5 s Puffer
  const AUTO_DISMISS_MS = 5500;

  function dismiss() {
    // CSS-Klasse "hidden" blendet das Intro per Transition aus
    intro.classList.add('hidden');
    // Hintergrundscrollen wieder freigeben
    document.body.style.overflow = '';
  }

  // Scrollen blockieren, solange das Intro sichtbar ist
  document.body.style.overflow = 'hidden';

  // Automatisches Ausblenden nach Timeout
  const timer = setTimeout(dismiss, AUTO_DISMISS_MS);

  // Manuelles Überspringen per Klick auf den "Überspringen"-Button
  skipBtn.addEventListener('click', function () {
    clearTimeout(timer); // Timer stoppen damit dismiss() nicht doppelt aufgerufen wird
    dismiss();
  });

  // Intro auch per Escape-Taste überspringen
  document.addEventListener('keydown', function onKey(e) {
    if (e.key === 'Escape') {
      clearTimeout(timer);
      dismiss();
      // Event-Listener nach einmaliger Nutzung entfernen
      document.removeEventListener('keydown', onKey);
    }
  });
})();

// ============================================================
// NAVBAR – Scroll-Verhalten und mobiles Hamburger-Menü
// Die Navbar bekommt beim Runterscrollen einen Glaseffekt-
// Hintergrund. Auf mobilen Geräten wird ein Hamburger-Menü
// angezeigt, das per Klick auf- und zugeklappt wird.
// ============================================================
(function initNavbar() {
  const navbar      = document.getElementById('navbar');
  const hamburger   = document.getElementById('navHamburger');
  const mobileMenu  = document.getElementById('navMobile');

  // Abbrechen wenn keine Navbar gefunden (sollte nicht passieren)
  if (!navbar) return;

  let ticking = false; // requestAnimationFrame-Flag: verhindert zu viele Scroll-Updates

  /**
   * Navbar-Zustand aktualisieren:
   * Bei mehr als 50 px Scroll-Tiefe wird die Klasse "scrolled" gesetzt,
   * die in CSS den Glaseffekt-Hintergrund aktiviert.
   */
  function updateNavbar() {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
    ticking = false;
  }

  // Scroll-Handler: nutzt requestAnimationFrame für Performance
  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(updateNavbar);
      ticking = true;
    }
  }, { passive: true }); // passive: true verbessert Scroll-Performance

  // Initialer Aufruf (für den Fall, dass die Seite bereits gescrollt ist)
  updateNavbar();

  // ---- Mobiles Hamburger-Menü ----
  if (hamburger && mobileMenu) {
    // Klick auf das Hamburger-Icon öffnet/schließt das mobile Menü
    hamburger.addEventListener('click', function () {
      const isOpen = mobileMenu.classList.toggle('open');
      hamburger.classList.toggle('open', isOpen);
      // Barrierefreiheit: aria-expanded und aria-label aktualisieren
      hamburger.setAttribute('aria-expanded', String(isOpen));
      hamburger.setAttribute('aria-label', isOpen ? 'Menü schließen' : 'Menü öffnen');
    });

    // Menü schließen wenn ein Link im mobilen Menü geklickt wird
    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
      });
    });

    // Menü schließen wenn irgendwo außerhalb geklickt wird
    document.addEventListener('click', function (e) {
      if (!navbar.contains(e.target) && !mobileMenu.contains(e.target)) {
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
      }
    });
  }
})();

// ============================================================
// SCROLL REVEAL ANIMATIONS
// Elemente mit den Klassen .reveal, .reveal-left oder
// .reveal-right werden sichtbar, sobald sie in den sichtbaren
// Bereich des Browsers scrollen (IntersectionObserver).
// Geschwister-Elemente werden leicht versetzt eingeblendet
// (Staffelung).
// ============================================================
(function initScrollReveal() {
  const revealSelectors = '.reveal, .reveal-left, .reveal-right';
  const elements = document.querySelectorAll(revealSelectors);

  // Falls keine Elemente vorhanden, nichts tun
  if (!elements.length) return;

  /**
   * IntersectionObserver: wird aufgerufen, wenn ein Element in den
   * sichtbaren Bereich scrollt (oder herausgescrollt wird).
   * threshold: 0.1 = 10 % des Elements müssen sichtbar sein
   * rootMargin: 48 px Puffer am unteren Rand (verhindert zu frühes Triggern)
   */
  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          // Staffelung berechnen: Geschwister-Elemente mit gleichen Klassen
          // werden jeweils 80 ms versetzt eingeblendet
          const siblings = entry.target.parentElement
            ? entry.target.parentElement.querySelectorAll(revealSelectors)
            : null;

          let delay = 0;
          if (siblings && siblings.length > 1) {
            siblings.forEach(function (sib, index) {
              if (sib === entry.target) {
                delay = index * 80; // 80 ms Versatz pro Element
              }
            });
          }

          // Klasse "visible" nach Verzögerung setzen (CSS-Transition startet)
          setTimeout(function () {
            entry.target.classList.add('visible');
          }, delay);

          // Element nicht mehr beobachten (Animation läuft nur einmal)
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.1,
      rootMargin: '0px 0px -48px 0px',
    }
  );

  // Alle Reveal-Elemente dem Observer hinzufügen
  elements.forEach(function (el) {
    observer.observe(el);
  });
})();

// ============================================================
// BACK-TO-TOP BUTTON
// Zeigt einen Pfeil-Button an, sobald der Nutzer mehr als
// 400 px gescrollt hat. Ein Klick scrollt sanft nach oben.
// ============================================================
(function initBackTop() {
  const btn = document.getElementById('back-top');
  if (!btn) return;

  let ticking = false;

  // Scroll-Event: Button anzeigen/verstecken
  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(function () {
        // Klasse "visible" steuert die Sichtbarkeit via CSS
        btn.classList.toggle('visible', window.scrollY > 400);
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  // Klick: sanft nach oben scrollen
  btn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
})();

// ============================================================
// GALLERY LIGHTBOX
// Ein Klick auf ein Galerie-Bild öffnet es in einem
// Vollbild-Overlay (Lightbox). Schließen per Klick auf das
// X-Icon, Klick auf den dunklen Hintergrund oder Escape-Taste.
// ============================================================
(function initLightbox() {
  const lightbox      = document.getElementById('lightbox');
  const lightboxImg   = document.getElementById('lightboxImg');
  const lightboxClose = document.getElementById('lightboxClose');
  const galerieGrid   = document.getElementById('galerieGrid');

  // Abbrechen wenn Lightbox oder Grid nicht im DOM
  if (!lightbox || !galerieGrid) return;

  /**
   * Lightbox öffnen:
   * Setzt src und alt des Lightbox-Bildes, fügt die Klasse "open"
   * hinzu (CSS-Transition) und setzt den Fokus auf das Schließen-Icon
   * (Barrierefreiheit).
   */
  function openLightbox(src, alt) {
    lightboxImg.src = src;
    lightboxImg.alt = alt;
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden'; // Hintergrundscrollen blockieren
    lightboxClose.focus();
  }

  /**
   * Lightbox schließen:
   * Entfernt die Klasse "open" und gibt das Scrollen wieder frei.
   * src wird geleert, damit das vorherige Bild nicht beim nächsten
   * Öffnen kurz aufblitzt.
   */
  function closeLightbox() {
    lightbox.classList.remove('open');
    document.body.style.overflow = '';
    lightboxImg.src = '';
  }

  // Event-Delegation: Klick auf ein beliebiges Galerie-Item abfangen
  galerieGrid.addEventListener('click', function (e) {
    // Nächstes übergeordnetes .galerie-item-Element finden
    const item = e.target.closest('.galerie-item');
    if (!item) return;
    const img = item.querySelector('img');
    if (!img) return;

    // Für die Lightbox eine größere Version des Bildes laden
    // (bei Unsplash-URLs: Breitenparameter auf 1600 erhöhen)
    const fullSrc = img.src.replace(/w=\d+/, 'w=1600').replace(/q=\d+/, 'q=90');
    openLightbox(fullSrc, img.alt);
  });

  // Schließen-Button
  lightboxClose.addEventListener('click', closeLightbox);

  // Klick auf den dunklen Hintergrund (nicht auf das Bild selbst)
  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) closeLightbox();
  });

  // Escape-Taste schließt die Lightbox
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && lightbox.classList.contains('open')) {
      closeLightbox();
    }
  });
})();

// ============================================================
// ÖFFNUNGSZEITEN – Live-Badge "Jetzt geöffnet / Geschlossen"
// Berechnet anhand der aktuellen Berliner Zeit, ob das
// Gartencenter gerade geöffnet ist und aktualisiert das Badge
// automatisch jede Minute.
// ============================================================
(function initOpenBadge() {
  const badge = document.querySelector('.oe-badge-open');
  if (!badge) return;

  // Öffnungszeiten pro Wochentag (0 = Sonntag, 1 = Montag, …)
  const hours = {
    0: { open: 10, close: 14 }, // Sonntag
    1: { open: 9,  close: 18 }, // Montag
    2: { open: 9,  close: 18 }, // Dienstag
    3: { open: 9,  close: 18 }, // Mittwoch
    4: { open: 9,  close: 18 }, // Donnerstag
    5: { open: 9,  close: 18 }, // Freitag
    6: { open: 9,  close: 17 }, // Samstag
  };

  /**
   * Badge aktualisieren:
   * Berechnet die aktuelle Zeit in der Zeitzone "Europe/Berlin"
   * (berücksichtigt automatisch Sommer-/Winterzeit) und vergleicht
   * sie mit den definierten Öffnungszeiten.
   */
  function updateBadge() {
    const now = new Date();
    // Berliner Ortszeit berechnen (unabhängig von der Systemzeit-Zone des Nutzers)
    const germanyTime = new Date(
      now.toLocaleString('en-US', { timeZone: 'Europe/Berlin' })
    );
    const day  = germanyTime.getDay();
    // Stunde als Dezimalzahl (z.B. 9:30 Uhr = 9.5)
    const hour = germanyTime.getHours() + germanyTime.getMinutes() / 60;
    const todayHours = hours[day];

    // Geöffnet: Öffnungszeit <= aktuelle Zeit < Schließzeit
    const isOpen = todayHours
      ? hour >= todayHours.open && hour < todayHours.close
      : false;

    const dot   = badge.querySelector('.dot');
    const label = badge.querySelector('.oe-badge-label');

    if (isOpen) {
      // Grüne Darstellung: "Jetzt geöffnet"
      badge.style.background = 'rgba(82,183,136,0.15)';
      badge.style.color      = '#2D6A4F';
      dot.style.background   = '#52B788';
      label.textContent      = 'Jetzt geöffnet';
    } else {
      // Rote Darstellung: "Aktuell geschlossen"
      badge.style.background = 'rgba(220,53,69,0.1)';
      badge.style.color      = '#842029';
      dot.style.background   = '#dc3545';
      label.textContent      = 'Aktuell geschlossen';
    }
  }

  // Sofort beim Laden aufrufen
  updateBadge();
  // Danach jede Minute aktualisieren
  setInterval(updateBadge, 60 * 1000);
})();

// ============================================================
// SMOOTH ANCHOR SCROLLING (mit Navbar-Offset)
// Alle internen Anker-Links (#section) scrollen sanft zum
// Ziel-Element. Die Höhe der fixierten Navbar wird dabei als
// Offset berücksichtigt, damit der Inhalt nicht hinter der
// Navbar versteckt ist.
// ============================================================
(function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      // Reine "#"-Links ignorieren
      if (href === '#') return;

      const target = document.querySelector(href);
      if (!target) return;

      e.preventDefault(); // Standard-Sprungverhalten des Browsers unterbinden

      // Navbar-Höhe als Offset bestimmen (standard: 0 wenn kein Navbar-Element)
      const navbarHeight = document.getElementById('navbar')
        ? document.getElementById('navbar').offsetHeight
        : 0;

      // Absolute Scroll-Position berechnen:
      // getBoundingClientRect().top = Position relativ zum Viewport
      // + window.scrollY = aktueller Scroll-Offset → absolute Position
      // - navbarHeight - 16 px Puffer
      const targetY = target.getBoundingClientRect().top
        + window.scrollY
        - navbarHeight
        - 16;

      window.scrollTo({ top: targetY, behavior: 'smooth' });
    });
  });
})();

// ============================================================
// AKTIVER NAVIGATIONSLINK (Highlighting)
// Hebt den Navigationslink hervor, der dem aktuell sichtbaren
// Seitenabschnitt entspricht. Wird beim Scrollen laufend
// aktualisiert.
// ============================================================
(function initActiveNav() {
  const sections  = document.querySelectorAll('section[id], div[id="quick-info"]');
  const navLinks  = document.querySelectorAll('.nav-links a, .nav-mobile a');
  const navHeight = 80; // Angenommene Navbar-Höhe in Pixel

  if (!sections.length || !navLinks.length) return;

  /**
   * Aktiven Abschnitt ermitteln:
   * Der erste Abschnitt, dessen oberer Rand (mit Offset) im
   * sichtbaren Bereich liegt, gilt als aktiv.
   */
  function getActiveSection() {
    let active = null;
    sections.forEach(function (section) {
      const rect = section.getBoundingClientRect();
      // Abschnitt gilt als aktiv, wenn sein Kopf im Viewport ist
      if (rect.top <= navHeight + 40 && rect.bottom > navHeight + 40) {
        active = section.id;
      }
    });
    return active;
  }

  let ticking = false;

  // Scroll-Handler: aktualisiert die Hervorhebung via requestAnimationFrame
  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(function () {
        const activeId = getActiveSection();
        navLinks.forEach(function (link) {
          const href = link.getAttribute('href');
          // Link des aktiven Abschnitts farblich hervorheben
          if (href === '#' + activeId) {
            link.style.color = 'var(--green-300)';
          } else {
            link.style.color = ''; // Andere Links: Standardfarbe
          }
        });
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
})();
