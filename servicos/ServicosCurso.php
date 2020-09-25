<!-- Funções exucutadas pelo sistema relacionadas ao Curso -->

<?php

interface iServicosCurso
{
    public function listarCursos();
    public function listarCursosPorId($curso_id);

    public function pesquisarCurso($filtro);

    public function cadastrarCurso($curso_nome, $curso_area_id, $curso_coordenador_id);

    public function alterarCurso($curso_id, $curso_nome, $curso_area_id, $curso_coordenador_id);

    public function deletarCurso($curso_id);
}

class ServicosCurso implements iServicosCurso
{

    function listarCursos()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores ON cursos.curso_coordenador_id = coordenadores.coordenador_id";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarCursosPorId($curso_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        WHERE curso_id = {$curso_id}";

        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function pesquisarCurso($filtro)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        WHERE cursos.curso_nome LIKE '%{$filtro}%' OR areas.area_nome LIKE '%{$filtro}%' OR coordenadores.coordenador_nome LIKE '%{$filtro}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarCurso($curso_nome, $curso_area_id, $curso_coordenador_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "INSERT INTO cursos (curso_nome, curso_area_id, curso_coordenador_id) VALUES ('$curso_nome', '$curso_area_id', '$curso_coordenador_id')";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;
        }
    }

    function alterarCurso($curso_id, $curso_nome, $curso_area_id, $curso_coordenador_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "UPDATE cursos SET curso_nome = '{$curso_nome}', curso_area_id = {$curso_area_id}, curso_coordenador_id = {$curso_coordenador_id}  WHERE curso_id = {$curso_id}";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }

    function deletarCurso($curso_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM cursos WHERE curso_id = {$curso_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }
}
