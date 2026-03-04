<?php
/**
 * Garten2000 – Admin Panel
 * Bilder-Verwaltung für die Galerie
 *
 * Zugang: /admin/ (passwortgeschützt per Session)
 */

session_start();

// ----------------------------------------------------------------
// Konfiguration
// ----------------------------------------------------------------
/**
 * Admin-Passwort als bcrypt-Hash.
 * Um das Passwort zu ändern, folgenden Befehl ausführen und den
 * resultierenden Hash hier eintragen:
 *   php -r "echo password_hash('NeuesPasswort', PASSWORD_DEFAULT);"
 *
 * Standard-Passwort: Garten2000!
 */
define('ADMIN_PASSWORD_HASH', '$2y$10$OscGjOW7AjQMNl09IXApheLhT9ChUQRs9yokYdr2iu6Dk7A9jxZI6');

/** Erlaubte Bilddateitypen (MIME-Typen und Erweiterungen) */
define('ALLOWED_MIME_TYPES', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp', 'gif']);

/** Maximale Dateigröße: 10 MB */
define('MAX_FILE_SIZE', 10 * 1024 * 1024);

/** Pfad zum Galerieordner (relativ zu diesem Skript) */
define('GALLERY_DIR', __DIR__ . '/../assets/img/gallery/');

// ----------------------------------------------------------------
// Aktionen verarbeiten (POST-Requests)
// ----------------------------------------------------------------
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF-Token prüfen (einfacher Session-basierter Schutz)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(403);
        die('Ungültige Anfrage.');
    }

    $action = $_POST['action'] ?? '';

    // --- Login ---
    if ($action === 'login') {
        if (isset($_POST['password']) && password_verify($_POST['password'], ADMIN_PASSWORD_HASH)) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: index.php');
            exit;
        } else {
            $message = 'Falsches Passwort. Bitte erneut versuchen.';
            $messageType = 'error';
        }
    }

    // --- Logout ---
    if ($action === 'logout') {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Alle weiteren Aktionen nur für eingeloggte Admins
    if ($action !== 'login' && empty($_SESSION['admin_logged_in'])) {
        header('Location: index.php');
        exit;
    }

    // --- Bild löschen ---
    if ($action === 'delete') {
        $file = basename($_POST['file'] ?? '');
        if ($file && file_exists(GALLERY_DIR . $file)) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ALLOWED_EXTENSIONS, true)) {
                unlink(GALLERY_DIR . $file);
                $message = 'Bild "' . htmlspecialchars($file) . '" wurde gelöscht.';
                $messageType = 'success';
            } else {
                $message = 'Ungültige Datei.';
                $messageType = 'error';
            }
        } else {
            $message = 'Datei nicht gefunden.';
            $messageType = 'error';
        }
    }

    // --- Bild hochladen ---
    if ($action === 'upload' && isset($_FILES['image'])) {
        $file    = $_FILES['image'];
        $error   = $file['error'];
        $tmpPath = $file['tmp_name'];
        $size    = $file['size'];
        $origName = $file['name'];

        if ($error !== UPLOAD_ERR_OK) {
            $message = 'Upload-Fehler (Code: ' . (int)$error . ').';
            $messageType = 'error';
        } elseif ($size > MAX_FILE_SIZE) {
            $message = 'Die Datei ist zu groß (max. 10 MB).';
            $messageType = 'error';
        } else {
            // MIME-Typ prüfen (nicht nur die Erweiterung)
            $finfo    = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($tmpPath);

            if (!in_array($mimeType, ALLOWED_MIME_TYPES, true)) {
                $message = 'Ungültiger Dateityp. Erlaubt: JPG, PNG, WebP, GIF.';
                $messageType = 'error';
            } else {
                // Sicheren Dateinamen generieren
                $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                if (!in_array($ext, ALLOWED_EXTENSIONS, true)) {
                    $ext = 'jpg'; // Fallback
                }
                $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                $safeName = substr($safeName, 0, 60) . '_' . time() . '.' . $ext;
                $destPath = GALLERY_DIR . $safeName;

                if (!is_dir(GALLERY_DIR)) {
                    mkdir(GALLERY_DIR, 0755, true);
                }

                if (move_uploaded_file($tmpPath, $destPath)) {
                    $message = 'Bild "' . htmlspecialchars($safeName) . '" wurde erfolgreich hochgeladen.';
                    $messageType = 'success';
                } else {
                    $message = 'Fehler beim Speichern der Datei.';
                    $messageType = 'error';
                }
            }
        }
    }
}

// CSRF-Token generieren (einmal pro Session)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

// ----------------------------------------------------------------
// Galeriebilder laden
// ----------------------------------------------------------------
$images = [];
if ($_SESSION['admin_logged_in'] ?? false) {
    if (is_dir(GALLERY_DIR)) {
        $files = scandir(GALLERY_DIR);
        foreach ($files as $f) {
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (in_array($ext, ALLOWED_EXTENSIONS, true)) {
                $images[] = $f;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow" />
  <title>Admin – Garten2000 Galerie</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/admin.css" />
</head>
<body>

<?php if (empty($_SESSION['admin_logged_in'])): ?>
  <!-- ============================================================
       LOGIN-FORMULAR
       ============================================================ -->
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-logo">
        <img src="../assets/img/logo big on white.jpeg" alt="Garten2000 Logo" />
      </div>
      <h1>Admin-Bereich</h1>
      <p class="login-subtitle">Garten2000 Galerie-Verwaltung</p>

      <?php if ($message): ?>
        <div class="alert alert-<?= $messageType ?>">
          <?= htmlspecialchars($message) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="index.php">
        <input type="hidden" name="action" value="login" />
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>" />

        <div class="form-group">
          <label for="password">Passwort</label>
          <input
            type="password"
            id="password"
            name="password"
            required
            autocomplete="current-password"
            placeholder="Admin-Passwort eingeben"
          />
        </div>
        <button type="submit" class="btn-primary">Anmelden</button>
      </form>

      <a href="../index.php" class="back-link">← Zurück zur Webseite</a>
    </div>
  </div>

<?php else: ?>
  <!-- ============================================================
       ADMIN-PANEL (eingeloggt)
       ============================================================ -->
  <header class="admin-header">
    <div class="admin-header-inner">
      <div class="admin-brand">
        <img src="../assets/img/logo navbar.png" alt="Garten2000" class="admin-brand-logo" />
        <span>Admin-Panel</span>
      </div>
      <form method="POST" action="index.php" style="margin:0">
        <input type="hidden" name="action" value="logout" />
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>" />
        <button type="submit" class="btn-logout">Abmelden</button>
      </form>
    </div>
  </header>

  <main class="admin-main">

    <?php if ($message): ?>
      <div class="alert alert-<?= $messageType ?>" role="alert">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <!-- Upload-Bereich -->
    <section class="admin-section">
      <h2>Bild hochladen</h2>
      <p class="admin-hint">
        Erlaubte Formate: JPG, PNG, WebP, GIF · Maximale Größe: 10 MB<br />
        Die Bilder werden in <code>assets/img/gallery/</code> gespeichert und erscheinen
        automatisch in der Galerie auf der Webseite.
      </p>

      <form
        method="POST"
        action="index.php"
        enctype="multipart/form-data"
        class="upload-form"
        id="uploadForm"
      >
        <input type="hidden" name="action" value="upload" />
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>" />

        <div class="drop-zone" id="dropZone">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="17 8 12 3 7 8"/>
            <line x1="12" y1="3" x2="12" y2="15"/>
          </svg>
          <p>Bild hier ablegen oder <label for="imageInput" class="file-label">Datei auswählen</label></p>
          <input type="file" id="imageInput" name="image" accept="image/*" required />
          <span class="drop-zone-filename" id="dropZoneFilename"></span>
        </div>

        <button type="submit" class="btn-primary" id="uploadBtn" disabled>
          Bild hochladen
        </button>
      </form>
    </section>

    <!-- Galerie-Übersicht -->
    <section class="admin-section">
      <h2>Galerie-Bilder (<?= count($images) ?>)</h2>

      <?php if (empty($images)): ?>
        <div class="empty-gallery">
          <p>Noch keine Bilder in der Galerie. Laden Sie oben das erste Bild hoch.</p>
        </div>
      <?php else: ?>
        <div class="admin-gallery-grid">
          <?php foreach ($images as $img): ?>
            <div class="admin-gallery-item">
              <div class="admin-gallery-thumb">
                <img
                  src="../assets/img/gallery/<?= htmlspecialchars($img) ?>"
                  alt="<?= htmlspecialchars($img) ?>"
                  loading="lazy"
                />
              </div>
              <div class="admin-gallery-info">
                <span class="admin-gallery-name" title="<?= htmlspecialchars($img) ?>">
                  <?= htmlspecialchars($img) ?>
                </span>
                <form
                  method="POST"
                  action="index.php"
                  onsubmit="return confirm('Bild &quot;<?= htmlspecialchars($img, ENT_QUOTES) ?>&quot; wirklich löschen?')"
                >
                  <input type="hidden" name="action" value="delete" />
                  <input type="hidden" name="file" value="<?= htmlspecialchars($img) ?>" />
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>" />
                  <button type="submit" class="btn-delete" aria-label="Löschen">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14H6L5 6"/>
                      <path d="M10 11v6M14 11v6"/>
                      <path d="M9 6V4h6v2"/>
                    </svg>
                    Löschen
                  </button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <div class="admin-footer-link">
      <a href="../index.php" target="_blank" rel="noopener">↗ Webseite in neuem Tab öffnen</a>
    </div>

  </main>

  <!-- Drag-and-Drop JavaScript für den Upload-Bereich -->
  <script>
    (function () {
      'use strict';

      var dropZone  = document.getElementById('dropZone');
      var fileInput = document.getElementById('imageInput');
      var filename  = document.getElementById('dropZoneFilename');
      var uploadBtn = document.getElementById('uploadBtn');

      // Wenn eine Datei ausgewählt wird, Dateinamen anzeigen und Schaltfläche freischalten
      fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
          filename.textContent  = this.files[0].name;
          uploadBtn.disabled    = false;
          dropZone.classList.add('has-file');
        }
      });

      // Drag-over: visuelles Feedback
      dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropZone.classList.add('drag-over');
      });

      // Drag-leave: Feedback entfernen
      dropZone.addEventListener('dragleave', function () {
        dropZone.classList.remove('drag-over');
      });

      // Drop: Datei übernehmen
      dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        var files = e.dataTransfer.files;
        if (files.length > 0) {
          fileInput.files  = files;
          filename.textContent = files[0].name;
          uploadBtn.disabled   = false;
          dropZone.classList.add('has-file');
        }
      });
    })();
  </script>

<?php endif; ?>

</body>
</html>
