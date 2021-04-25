
<div class="app user">
	<header class="nav">
		<div class="container">
			<div class="logo">
				<h1 >Bem vindo ao WhatsApp</h1>
				<!-- <img src="../../img/whatsapp-logo.svg" alt="Logo" /> -->
			</div>
			<nav class="menu">
				<ul>
					<li><a href="<?= URL_RAIZ . 'usuarios' ?>"> Meus Contatos</a></li>
					<li><a href="<?= URL_RAIZ . 'usuarios/1/editar' ?>">Meu Perfil</a></li>
					<li><a href="<?= URL_RAIZ . 'relatorios' ?>">Relátorio</a></li>
					<li><a href="#" onclick="$('#logout').submit()">Sair</a>
					<form id="logout" action="<?= URL_RAIZ . 'login' ?>" method="post" class="hidden">
						<input type="hidden" name="_metodo" value="DELETE">
					</form>
					</li>
				</ul>
			</nav>
		</div>
	</header>
			
		<div class="row">
			
			<div class="col-sm-12" style="
			width: 100%;">
				
				<!-- CABEÇALHO PERFIL -->
				<section class="app_header">
					
					<div class="app_perfil">

						<!-- TÍTULO -->
						<h1>Lista de Usuários</h1>
					</div>

					<!-- ÁREA DE PESQUISA -->
					<div class="app_pesquisa">
						<input type="text" name="" placeholder="Procurar contato">
						<button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M15.009 13.805h-.636l-.22-.219a5.184 5.184 0 0 0 1.256-3.386 5.207 5.207 0 1 0-5.207 5.208 5.183 5.183 0 0 0 3.385-1.255l.221.22v.635l4.004 3.999 1.194-1.195-3.997-4.007zm-4.808 0a3.605 3.605 0 1 1 0-7.21 3.605 3.605 0 0 1 0 7.21z"></path></svg></button>
					</div>

				</section>
				    
				<?php if ($mensagemFlash) : ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?= $mensagemFlash ?>
					</div>
				<?php endif ?>

				<!-- ÁREA DE CONTATOS -->
				<section class="app_contatos">
					
					<!-- LISTA DE CONTATOS -->
					<ul>
					<?php foreach ($usuarios as $usuario) : ?>

						<li>
							<div class="row">
							
								<!-- COLUNA DA FOTO -->
								<div class="col-sm-2">
									<div class="app_foto_contato">
										<figure>
										<img src="<?= URL_IMG . $usuario->getImagem() ?>" alt="Imagem do perfil">
										</figure>
									</div>
								</div>
								<div class="col-sm-8">
								
									<div class="app_info_conato">
										<h2><?= $usuario->getNome() ?></h2>
										<p><?= $usuario->getNumero() ?></p>

										
									</div>
								</div>						
							


								<!-- COLUNA DE AÇÃO  -->
								<div class="col-sm-2">
									<form action="<?= URL_RAIZ . 'contatos/' .  $usuarioLogado->getId() . '/' . $usuario->getId() ?>" method="post">
										<div class="app_navegacao_contato">
											<button type="submit" class="">Adicionar Contato</button>
										</div>
									</form>
								</div>

							</div>
						</li>
						<?php endforeach ?>
						<li>
							<div class="row">
							
								<!-- COLUNA DA FOTO -->
								<div class="col-sm-2">
									<div class="app_foto_contato">
										<figure>
										<img src="<?= URL_IMG . $usuario->getImagem() ?>" alt="Imagem do perfil">
										</figure>
									</div>
								</div>
								<div class="col-sm-8">
								
									<div class="app_info_conato">
										<h2>Rodrigo Ferraz</h2>
										<p>42 9830583950</p>

										
									</div>
								</div>						
							


								<!-- USUARIO EXEMPLO PARA MOSTRAR A TELA DE MENSAGEM  -->
								<div class="col-sm-2">
									<form action="<?= URL_RAIZ . 'mensagens/' .  $usuarioLogado->getId() ?>" method="get">
										<div class="app_navegacao_contato">
											<button type="submit" class="add_exist">Ver conversa</button>
										</div>
									</form>
								</div>

							</div>
						</li>
					</ul>

				</section>


			</div>	
			
			
		
		</div>


	</div>