<div class="row">
			
	<div class="col-sm-12">
		<div class="form-user">
            <?php if ($mensagemFlash) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
                 </div>
            <?php endif ?>
		<h1 class="">Cadastre-se no Sistema</h1>
        <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('nome') ?>">
                <label class="control-label" for="nome">E-mail *</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                <input id="nome" name="nome" class="form-control" autofocus value="<?= $this->getPost('nome') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('numero') ?>">
                <label class="control-label" for="numero">E-mail *</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'numero']) ?>
                <input id="numero" name="numero" class="form-control" autofocus value="<?= $this->getPost('numero') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('senha') ?>">
                <label class="control-label" for="senha">Senha *</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>
            <div class="form-group <?= $this->getErroCss('foto') ?>">
                <label class="control-label" for="foto">Foto (somente PNG)</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
                <input id="foto" name="foto" class="form-control" type="file">
            </div>
            <input type="submit" class="" value="Cadastrar-se">
        </form>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'login' ?>">Voltar para a tela de Login</a>
        </p>

		</div>
	</div>			
</div>