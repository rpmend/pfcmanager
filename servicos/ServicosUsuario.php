<!-- Funções exucutadas pelo sistema relacionadas ao Usuário -->

<?php

interface iServicosUsuario
{
    public function logar($usuario_nome, $usuario_senha);
    public function deslogar();

    public function listarUsuarios();
    public function listarUsuariosPorId($usuario_id);
    public function listarUsuariosPorNome($usuario_nome);

    public function cadastrarUsuario($usuario_nome, $usuario_senha, $usuario_perfil);

    public function alterarUsuario($usuario_id, $usuario_nome, $usuario_senha, $usuario_perfil);

    public function deletarUsuario($usuario_id);
}

class ServicosUsuario implements iServicosUsuario
{

    function logar($usuario_nome, $usuario_senha)
    // A função logar() irá verificar as credenciais do usuario. 
    // Caso os dados existam no banco, a sessão é iniciada com os dados do usuário e a função retorna true. 
    // Caso contrário, a função retorna false.
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM usuarios WHERE usuario_nome = '{$usuario_nome}'";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }

        $linha = mysqli_fetch_assoc($resultado);

        if (empty($linha)) {
            return false;
        } else if(password_verify($usuario_senha, $linha["usuario_senha"])){
            session_start();
            $_SESSION["usuario_id"] = $linha["usuario_id"];
            $_SESSION["usuario_nome"] = $linha["usuario_nome"];
            $_SESSION["usuario_perfil"] = $linha["usuario_perfil"];
            return true;
        }
    }

    function deslogar()
    // A função deslogar() irá remover as variaveis da sessao e destroi a sessao.
    {
        session_unset();
        session_destroy();

        header("location:../inicio/login.php");
    }

    function listarUsuarios()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM usuarios;";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarUsuariosPorId($usuario_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM usuarios WHERE usuario_id = {$usuario_id}";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function listarUsuariosPorNome($usuario_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM usuarios WHERE usuario_nome LIKE '%{$usuario_nome}%' ";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarUsuario($usuario_nome, $usuario_senha, $usuario_perfil)
    {
        require_once("../../banco/conexao.php");

        $senha_segura = password_hash($usuario_senha, PASSWORD_DEFAULT);

        $conexao = conectar();
        $query = "INSERT INTO usuarios (usuario_nome, usuario_senha, usuario_perfil) VALUES ('$usuario_nome', '$senha_segura', '$usuario_perfil')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            if (mysqli_errno($conexao) == 1062) {
                echo "Já existe um usuário com este nome. ";
            }
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;
        }
    }

    function alterarUsuario($usuario_id, $usuario_nome, $usuario_senha, $usuario_perfil)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "UPDATE usuarios SET usuario_nome = '{$usuario_nome}', usuario_senha = '{$usuario_senha}', usuario_perfil = '{$usuario_perfil}' WHERE usuario_id = {$usuario_id}";

        $resultado = mysqli_query($conexao, $query);

        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }

    function deletarUsuario($usuario_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM usuarios WHERE usuario_id = {$usuario_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }
}
