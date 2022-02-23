<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <section class="container p-2">
        <a class="navbar-brand" href="<?= app_base ?>"><img class="img-fluid mx-1" width="48" height="48"
                src="<?= app_base . "assets/images/logo.png" ?>" />Maç Tahminleri</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <section class="container-sm"></section>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>" style="white-space: nowrap;">Canlı
                        Maçlar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>mac-tahminleri" style="white-space: nowrap;">Maç Tahminleri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>plani-degistir" style="white-space: nowrap;">Yükselt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>profil" style="white-space: nowrap;">Profilim</a>
                </li>
                <?php if($this->getSessionManager()->has("login")): ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>cikis-yap" style="white-space: nowrap;">Çıkış Yap</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>kayit-ol"
                        style="white-space: nowrap;">Kayıt Ol</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= app_base ?>giris-yap"
                        style="white-space: nowrap;">Giriş Yap</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </section>
</nav>