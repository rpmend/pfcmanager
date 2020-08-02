<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
  $servicosCliente = new ServicosCliente();
  ?>

  <?php

  ?>

  <!DOCTYPE html>
  <html lang="pt-BR">

  <head>
    <?php include_once("../compartilhado/head.php"); ?>
  </head>

  <body>
    <?php include_once("../compartilhado/header.php"); ?>
    <main>
      <div class="container">
        <div class="row">
          <form method="post">
            <h3 class="light-blue-text text-darken-3 page-title">Clientes

              <?php
              // Botão adicionar Área (Apenas Administrador e GPE)
              if (($_SESSION["usuario_perfil"]) == "Administrador" || ($_SESSION["usuario_perfil"]) == "GPE") {
              ?>
                <a title="Adicionar Cliente" href="cadastro_cliente.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
                  <i class="material-icons">add</i>
                </a>
              <?php
              }
              ?>

            </h3>
            <div class="input-field col s4 offset-s3">
              <input name="filtro" maxlength="45" type="text">
              <label for="filtro"></label>
            </div>
            <div class="input-field col s4">
              <button class="btn waves-effect waves-light blue" type="submit" name="action">Pesquisar
                <i class="material-icons right ">search</i>
              </button>
            </div>
          </form>
        </div>
        <div class="divider"></div>
        </form>
        <!-- tabela clientes -->
        <div class="table">
          <table class="striped">
            <thead>
              <tr>
                <th>Razão Social</th>
                <th>Nome Fantasia</th>
                <th>Endereço</th>
                <th>Representante</th>
                <th>Telefone</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST["filtro"])) {
              ?>
                <?php
                $resultado = $servicosCliente->pesquisarCliente($_POST["filtro"]);
                while ($linha = mysqli_fetch_assoc($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $linha["cliente_razaosocial"] ?></td>
                    <td><?php echo $linha["cliente_nomefantasia"] ?></td>
                    <td><?php echo $linha["cliente_endereco"] ?></td>
                    <td><?php echo $linha["cliente_nomerepresentante"] ?></td>
                    <td><?php echo $linha["cliente_telrepresentante"] ?></td>
                    <td><?php echo $linha["cliente_emailrepresentante"] ?></td>

                    <?php
                    if (($_SESSION["usuario_perfil"]) == "Administrador") {
                    ?>
                      <td>
                        <a href="alterar_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><i class="material-icons">edit</i></a>
                        <a href="deletar_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><i class="material-icons">delete</i></a>
                      </td>
                    <?php
                    }
                    ?>

                  </tr>
                <?php
                }
              } else {
                ?>
                <?php
                $resultado = $servicosCliente->listarClientes();
                while ($linha = mysqli_fetch_assoc($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $linha["cliente_razaosocial"] ?></td>
                    <td><?php echo $linha["cliente_nomefantasia"] ?></td>
                    <td><?php echo $linha["cliente_endereco"] ?></td>
                    <td><?php echo $linha["cliente_nomerepresentante"] ?></td>
                    <td><?php echo $linha["cliente_telrepresentante"] ?></td>
                    <td><?php echo $linha["cliente_emailrepresentante"] ?></td>

                    <?php
                    if (($_SESSION["usuario_perfil"]) == "Administrador") {
                    ?>
                      <td>
                        <a href="alterar_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><i class="material-icons">edit</i></a>
                        <a href="deletar_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><i class="material-icons">delete</i></a>
                      </td>
                    <?php
                    }
                    ?>

                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
    </main>
    <?php include_once("../compartilhado/footer.php"); ?>
    <script src="../compartilhado/script.js"></script>
  </body>

  </html>

<?php
} else {
  header("location:../inicio/login.php");
}
?>