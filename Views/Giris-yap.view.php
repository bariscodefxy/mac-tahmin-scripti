<form class="form m-3" method="POST" action="">
	<?php if(@$notice) : ?>
		<?php if(@$notice[0] === "success"): ?>
			<div class="m-3 p-3 rounded border border-success text-success" style="background-color: #43ED00;"><?= $notice[1] ?></div>
		<?php else: ?>
			<div class="m-3 p-3 rounded border border-dark text-dark" style="background-color: #FF0000;"><?= $notice[1] ?></div>
		<?php endif; ?>
	<?php endif; ?>
	<h2 align="center">Giriş Formu</h2>
	<div class="mb-3 mx-auto col-2">
		<label for="username" class="form-label">Kullanıcı Adı:</label>
		<input type="text" name="username" id="username" class="form-control" autocomplete="off" />
	</div>
	<div class="mb-3 mx-auto col-2">
		<label for="password" class="form-label">Şifre:</label>
		<input type="password" name="password" id="password" class="form-control" autocomplete="off" />
	</div>
	<div class="mb-3 mx-auto col-2">
		<button class="btn btn-primary">Giriş Yap</button>
	</div>
</form>