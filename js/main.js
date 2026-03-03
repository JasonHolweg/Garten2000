/* ============================================================
   Garten2000 – Main JavaScript
   ============================================================ */

'use strict';

// ============================================================
// INTRO SPLASH
// ============================================================
(function initIntro() {
  const intro      = document.getElementById('intro');
  const skipBtn    = document.getElementById('introSkip');
  const leavesContainer = document.getElementById('introLeaves');

  if (!intro) return;

  // Generate leaf particles
  const leafSVGs = [
    // Simple leaf shape 1
    `<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 8C8 10 5.9 16.17 3.82 20.33L5.71 21l1-2.3A4.49 4.49 0 0 0 8 19c8 0 12-8 12-8a11.9 11.9 0 0 1-3 3z"/></svg>`,
    // Rounded leaf shape 2
    `<svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><ellipse cx="12" cy="12" rx="6" ry="10" transform="rotate(-30 12 12)"/></svg>`,
    // Small flower
    `<svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="4"/><circle cx="12" cy="5" r="3"/><circle cx="12" cy="19" r="3"/><circle cx="5" cy="12" r="3"/><circle cx="19" cy="12" r="3"/></svg>`,
  ];

  const greenShades = [
    'rgba(82,183,136,0.7)',
    'rgba(149,213,178,0.6)',
    'rgba(116,198,157,0.65)',
    'rgba(52,183,99,0.55)',
    'rgba(208,243,220,0.5)',
  ];

  for (let i = 0; i < 18; i++) {
    const leaf = document.createElement('div');
    leaf.className = 'leaf';
    const svgIndex = i % leafSVGs.length;
    leaf.innerHTML = leafSVGs[svgIndex];
    leaf.querySelector('svg').style.fill = greenShades[i % greenShades.length];

    const startX = Math.random() * 100;
    const delay  = Math.random() * 2.5;
    const dur    = 3 + Math.random() * 2;
    const size   = 0.6 + Math.random() * 1.2;

    leaf.style.left             = `${startX}%`;
    leaf.style.animationDelay   = `${delay}s`;
    leaf.style.animationDuration = `${dur}s`;
    leaf.style.transform        = `scale(${size})`;

    leavesContainer.appendChild(leaf);
  }

  // Dismiss intro
  const AUTO_DISMISS_MS = 5500; // 1.5s delay + 3.5s fill + 0.5s buffer

  function dismiss() {
    intro.classList.add('hidden');
    // Re-enable scroll
    document.body.style.overflow = '';
  }

  // Prevent background scroll while intro is visible
  document.body.style.overflow = 'hidden';

  // Auto dismiss
  const timer = setTimeout(dismiss, AUTO_DISMISS_MS);

  // Manual skip
  skipBtn.addEventListener('click', function () {
    clearTimeout(timer);
    dismiss();
  });

  // Also skip on Escape key
  document.addEventListener('keydown', function onKey(e) {
    if (e.key === 'Escape') {
      clearTimeout(timer);
      dismiss();
      document.removeEventListener('keydown', onKey);
    }
  });
})();

// ============================================================
// NAVBAR – scroll behavior & mobile menu
// ============================================================
(function initNavbar() {
  const navbar      = document.getElementById('navbar');
  const hamburger   = document.getElementById('navHamburger');
  const mobileMenu  = document.getElementById('navMobile');

  if (!navbar) return;

  // Scroll state
  let lastScroll = 0;
  let ticking    = false;

  function updateNavbar() {
    const scrollY = window.scrollY;
    if (scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
    lastScroll = scrollY;
    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(updateNavbar);
      ticking = true;
    }
  }, { passive: true });

  // Initial call
  updateNavbar();

  // Mobile hamburger
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function () {
      const isOpen = mobileMenu.classList.toggle('open');
      hamburger.classList.toggle('open', isOpen);
      hamburger.setAttribute('aria-expanded', String(isOpen));
      hamburger.setAttribute('aria-label', isOpen ? 'Menü schließen' : 'Menü öffnen');
    });

    // Close mobile menu when a link is clicked
    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
      });
    });

    // Close on outside click
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
// ============================================================
(function initScrollReveal() {
  const revealSelectors = '.reveal, .reveal-left, .reveal-right';
  const elements = document.querySelectorAll(revealSelectors);

  if (!elements.length) return;

  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          // Stagger children if parent has multiple siblings
          const siblings = entry.target.parentElement
            ? entry.target.parentElement.querySelectorAll(revealSelectors)
            : null;

          let delay = 0;
          if (siblings && siblings.length > 1) {
            siblings.forEach(function (sib, index) {
              if (sib === entry.target) {
                delay = index * 80;
              }
            });
          }

          setTimeout(function () {
            entry.target.classList.add('visible');
          }, delay);

          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.1,
      rootMargin: '0px 0px -48px 0px',
    }
  );

  elements.forEach(function (el) {
    observer.observe(el);
  });
})();

// ============================================================
// BACK TO TOP BUTTON
// ============================================================
(function initBackTop() {
  const btn = document.getElementById('back-top');
  if (!btn) return;

  let ticking = false;

  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(function () {
        btn.classList.toggle('visible', window.scrollY > 400);
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  btn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
})();

// ============================================================
// GALLERY LIGHTBOX
// ============================================================
(function initLightbox() {
  const lightbox     = document.getElementById('lightbox');
  const lightboxImg  = document.getElementById('lightboxImg');
  const lightboxClose = document.getElementById('lightboxClose');
  const galerieGrid  = document.getElementById('galerieGrid');

  if (!lightbox || !galerieGrid) return;

  function openLightbox(src, alt) {
    lightboxImg.src  = src;
    lightboxImg.alt  = alt;
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
    lightboxClose.focus();
  }

  function closeLightbox() {
    lightbox.classList.remove('open');
    document.body.style.overflow = '';
    lightboxImg.src = '';
  }

  // Click on gallery item
  galerieGrid.addEventListener('click', function (e) {
    const item = e.target.closest('.galerie-item');
    if (!item) return;
    const img = item.querySelector('img');
    if (!img) return;

    // Use full-size image (remove size params for lightbox)
    const fullSrc = img.src.replace(/w=\d+/, 'w=1600').replace(/q=\d+/, 'q=90');
    openLightbox(fullSrc, img.alt);
  });

  // Close button
  lightboxClose.addEventListener('click', closeLightbox);

  // Background click
  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) closeLightbox();
  });

  // Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && lightbox.classList.contains('open')) {
      closeLightbox();
    }
  });
})();

// ============================================================
// ÖFFNUNGSZEITEN – live open/closed badge
// ============================================================
(function initOpenBadge() {
  const badge = document.querySelector('.oe-badge-open');
  if (!badge) return;

  // German locale opening hours
  const hours = {
    // 0 = Sunday
    0: { open: 10, close: 14 },
    1: { open: 9,  close: 18 },
    2: { open: 9,  close: 18 },
    3: { open: 9,  close: 18 },
    4: { open: 9,  close: 18 },
    5: { open: 9,  close: 18 },
    6: { open: 9,  close: 17 },
  };

  function updateBadge() {
    // Use German timezone CET/CEST
    const now = new Date();
    const germanyTime = new Date(
      now.toLocaleString('en-US', { timeZone: 'Europe/Berlin' })
    );
    const day  = germanyTime.getDay();
    const hour = germanyTime.getHours() + germanyTime.getMinutes() / 60;
    const todayHours = hours[day];

    const isOpen = todayHours
      ? hour >= todayHours.open && hour < todayHours.close
      : false;

    const dot   = badge.querySelector('.dot');
    const label = badge.querySelector('.oe-badge-label');

    if (isOpen) {
      badge.style.background = 'rgba(82,183,136,0.15)';
      badge.style.color       = '#2D6A4F';
      dot.style.background    = '#52B788';
      label.textContent       = 'Jetzt geöffnet';
    } else {
      badge.style.background  = 'rgba(220,53,69,0.1)';
      badge.style.color       = '#842029';
      dot.style.background    = '#dc3545';
      label.textContent       = 'Aktuell geschlossen';
    }
  }

  updateBadge();
  // Update every minute
  setInterval(updateBadge, 60 * 1000);
})();

// ============================================================
// SMOOTH ANCHOR SCROLLING (with navbar offset)
// ============================================================
(function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#') return;

      const target = document.querySelector(href);
      if (!target) return;

      e.preventDefault();

      const navbarHeight = document.getElementById('navbar')
        ? document.getElementById('navbar').offsetHeight
        : 0;

      const targetY = target.getBoundingClientRect().top
        + window.scrollY
        - navbarHeight
        - 16;

      window.scrollTo({ top: targetY, behavior: 'smooth' });
    });
  });
})();

// ============================================================
// ACTIVE NAV LINK highlighting
// ============================================================
(function initActiveNav() {
  const sections  = document.querySelectorAll('section[id], div[id="quick-info"]');
  const navLinks  = document.querySelectorAll('.nav-links a, .nav-mobile a');
  const navHeight = 80;

  if (!sections.length || !navLinks.length) return;

  function getActiveSection() {
    let active = null;
    sections.forEach(function (section) {
      const rect = section.getBoundingClientRect();
      if (rect.top <= navHeight + 40 && rect.bottom > navHeight + 40) {
        active = section.id;
      }
    });
    return active;
  }

  let ticking = false;

  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(function () {
        const activeId = getActiveSection();
        navLinks.forEach(function (link) {
          const href = link.getAttribute('href');
          if (href === '#' + activeId) {
            link.style.color = 'var(--green-300)';
          } else {
            link.style.color = '';
          }
        });
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
})();
