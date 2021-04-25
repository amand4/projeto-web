
<div class="app">
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
			
			<div class="col-sm-12">
				<div class="form-user">
					<h1 class="">Bem vindo ao WhatsApp</h1>
					<form action="" method="post" class="">

						<!-- FOTO PERFIL -->
						<figure class="perfil_edit">
							<img src="../../img/perfil.jpg">
						</figure>
						<div class="form-group">
							<label class="control-label" for="foto">Adicionar uma foto. (somente PNG)</label>
							<input id="foto" name="foto"  class="form-control" type="file" placeholder="Adicionar uma foto. (somente PNG">
						</div>

						<div class="form-group">
							<label class="control-label" for="name">Seu nome</label>
							<input id="name" name="name" class="form-control" autofocus value="Karoline Silva">
						</div>
						<div class="form-group">
							<label class="control-label" for="telefone">Seu número:</label>
							<input type="tel" id="telefone" name="telefone" class="form-control" autofocus value="42984068155">
						</div>
						
						<input type="submit" class="" value="Atualizar">
					</form>

				</div>
			</div>	
		
		</div>


	</div>