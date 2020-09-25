<!-- Funções exucutadas pelo sistema relacionadas à Equipe -->

<?php

interface iServicosEquipe
{
    public function listarEquipes();
    public function listarEquipePorId($curso_id);
    public function listarEquipesSemProjeto();

    public function pesquisarEquipe($filtro);

    public function cadastrarEquipe($equipe_turma_id, $equipe_gestor, $equipe_membro1, $equipe_membro2, $equipe_membro3, $equipe_membro4, $equipe_membro5);
    
    public function alterarEquipe($equipe_turma_id, $equipe_gestor, $equipe_membro1, $equipe_membro2, $equipe_membro3, $equipe_membro4, $equipe_membro5, $equipe_id);
    
    public function deletarEquipe($equipe_id);
    
    public function atribuirNota($equipe_nota, $equipe_id);
}

class ServicosEquipe implements iServicosEquipe
{

    function listarEquipes()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        INNER JOIN equipes
          ON equipes.equipe_turma_id = turmas.turma_id";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarEquipePorId($equipe_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        INNER JOIN equipes
          ON equipes.equipe_turma_id = turmas.turma_id 
        WHERE equipe_id = {$equipe_id}";

        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function listarEquipesSemProjeto()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        INNER JOIN equipes
          ON equipes.equipe_turma_id = turmas.turma_id 
        WHERE equipe_tem_projeto = 0";

        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function pesquisarEquipe($filtro)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        INNER JOIN equipes
          ON equipes.equipe_turma_id = turmas.turma_id
        WHERE equipes.equipe_gestor LIKE '%{$filtro}%' OR equipes.equipe_membro1 LIKE '%{$filtro}%' OR equipes.equipe_membro2 LIKE '%{$filtro}%' OR equipes.equipe_membro3 LIKE '%{$filtro}%' OR equipes.equipe_membro4 LIKE '%{$filtro}%' OR equipes.equipe_membro5 LIKE '%{$filtro}%'";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function cadastrarEquipe($equipe_turma_id, $equipe_gestor, $equipe_membro1, $equipe_membro2, $equipe_membro3, $equipe_membro4, $equipe_membro5)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $equipe_tem_projeto = 0;
        $query = "INSERT INTO equipes (equipe_turma_id, equipe_gestor, equipe_membro1, equipe_membro2, equipe_membro3, equipe_membro4, equipe_membro5, equipe_tem_projeto) 
        VALUES ($equipe_turma_id, '$equipe_gestor','$equipe_membro1','$equipe_membro2','$equipe_membro3','$equipe_membro4','$equipe_membro5','$equipe_tem_projeto')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            echo $query;
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;
        }
    }

    function alterarEquipe($equipe_turma_id, $equipe_gestor, $equipe_membro1, $equipe_membro2, $equipe_membro3, $equipe_membro4, $equipe_membro5, $equipe_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();

        if ($equipe_nota = "") {
            $equipe_nota = "null";
        }
        $query = "UPDATE equipes SET equipe_gestor = '{$equipe_gestor}', equipe_membro1 = '{$equipe_membro1}', equipe_membro2 = '{$equipe_membro2}', equipe_membro3 = '{$equipe_membro3}', equipe_membro4 = '{$equipe_membro4}', equipe_membro5 = '{$equipe_membro5}' WHERE equipe_id = {$equipe_id}";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            echo $query;
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }

    function deletarEquipe($equipe_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM equipes WHERE equipe_id = {$equipe_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function atribuirNota($equipe_nota, $equipe_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "UPDATE equipes SET equipe_nota = {$equipe_nota} WHERE equipe_id = {$equipe_id}";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }
}
