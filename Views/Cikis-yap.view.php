<?php if($this->getSessionManager()->has('login')) : ?>

	<div class="m-3 p-3 rounded border border-success text-success" style="background-color: #43ED00;">Başarıyla çıkış yaptınız.</div>

	<?php else: ?>

	<div class="m-3 p-3 rounded border border-dark text-dark" style="background-color: #FF0000;">Zaten giriş yapmamışsınız.</div>

<?php endif; ?>