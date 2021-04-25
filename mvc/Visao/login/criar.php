
<div class="row">
			
			<div class="col-sm-12">
				<div class="form-user">
					<h1 class="">Login</h1>
                    <form action="<?= URL_RAIZ . 'login' ?>" method="post">
                        <div class="form-group <?= $this->getErroCss('login') ?>">
                            <label class="control-label" for="nome">nome</label>
                            <input id="nome" name="nome" class="form-control" autofocus value="<?= $this->getPost('nome') ?>" placeholder="Insira seu nome">
                        </div>
                        <div class="form-group <?= $this->getErroCss('login') ?>">
                            <label class="control-label" for="senha">Senha</label>
                            <input id="senha" name="senha" class="form-control" type="password" placeholder="Insira sua senha">
                        </div>
                        <div class="form-group has-error text-center">
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
                        </div>
                        <input type="submit" class="" value="Entrar">

                    </form>
                    <p class="text-center">
                        <a href="<?= URL_RAIZ . 'usuarios/criar' ?>">Não tem um usuário? Cadastrar-se aqui!</a>
                    </p>

				</div>
			</div>	
		
		</div>