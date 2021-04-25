
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
                
                <div class="col-md-12">
                    
                    <section class="app_header">
                        
                        <!-- TÍTULO -->
                        <h1>Relatório</h1>

                    </section>

                    <!-- ÁREA DE CONTATOS -->
                    <section class="app_contatos filter">
                        
                                            
                        <form method="get" class="form_filter">
                            
                            <!-- ÁREA DE PESQUISA -->
                            <div class="app_pesquisa">
                                <label class="control-label" for="search">Filtrar por:</label>
                                <input type="text" name="search" placeholder="Conversa, usuários ou mensagens">
                                <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M15.009 13.805h-.636l-.22-.219a5.184 5.184 0 0 0 1.256-3.386 5.207 5.207 0 1 0-5.207 5.208 5.183 5.183 0 0 0 3.385-1.255l.221.22v.635l4.004 3.999 1.194-1.195-3.997-4.007zm-4.808 0a3.605 3.605 0 1 1 0-7.21 3.605 3.605 0 0 1 0 7.21z"></path></svg></button>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="contatoID">Selecionar por:</label>
                                <select id="contatoID" name="contatoID" class="form-control" autofocus>
                                    <option value="">---</option>
                                    
                                        <option value="">Usuários</option>
                                        <option value="">Conversas</option>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary center-block button">Filtrar</button>
                        </form>
                        <section class="app_header">
                            
                            <!-- TÍTULO -->
                        <h1>Resultado Encontrado: Contatos João</h1>
                        </section>
                        <section class="result_filter">

                            <table class="table table-condensed table-bordered">
                                <tr class="active">
                                    <th>Nome</th>
                                    <th>Número</th>
                                </tr>
                                
                                    <tr>
                                        <td class="">Alice</td>
                                        <td class="text-right">429879439854</td>
                                    </tr>
                                    <tr>
                                        <td class="">Rehnan</td>
                                        <td class="text-right">4393803018</td>
                                    </tr>
                                    <tr>
                                        <td class="">Nanda</td>
                                        <td class="text-right">4393803018</td>
                                    </tr>
                                    <tr>
                                        <td class="">Carlos</td>
                                        <td class="text-right">4393803018</td>
                                    </tr>
                                    <tr>
                                        <td class="">Paulo</td>
                                        <td class="text-right">4393803018</td>
                                    </tr>
                            </table>
                        </section>

                        <section class="app_header">

                            <!-- TÍTULO -->
                            <h1>Total:</h1>
                        </section>
                        <section class="result_filter">

                            <table class="table table-condensed table-bordered">
                                <tr class="active">
                                    <th></th>
                                    <th>Usuários</th>
                                    <th>Conversas </th>
                                    <th>Mensagens</th>
                                </tr>
                                
                                    <tr>
                                        <td></td>
                                        <td class="text-right">6</td>
                                        <td class="text-right">150</td>
                                        <td class="text-right">500</td>

                                    </tr>
                                <tr class="active negrito">
                                    <td>TOTAL</td>
                                    <td class="text-right">80</td>
                                    <td class="text-right">860</td>
                                    <td class="text-right">1580</td>

                                </tr>
                            </table>
                        </section>                        
                </div>	
            
            </div>

        </div>