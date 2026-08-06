<?php
function totalConsultas($agenda){
    return count($agenda);
}

function pacientesDiferentes($agenda){
    $pacientes = [];

    foreach($agenda as $consulta){
        $pacientes[] = $consulta["paciente"]; 
    }

    return count(array_unique($pacientes));
}

function contarEspecialidades($agenda){
    $especialidades = [];
    foreach($agenda as $consulta){

        if(isset($especialidades[$consulta["especialidade"]])){
            $especialidades[$consulta["especialidade"]]++;
        }else{
            $especialidades[$consulta["especialidade"]] = 1;
        }
    }
    return $especialidades;
}


function ordenarHorarios($agenda){
    usort($agenda, function($a,$b){
        return strcmp($a["horario"], $b["horario"]);
    });
    return $agenda;
}

function pesquisarPaciente($agenda,$nome){
    foreach($agenda as $consulta){
        if($consulta["paciente"] == $nome){
            return $consulta;
        }
    }

    return "Paciente não encontrado";
}

function horarioDuplicado($agenda){

    $horarios = [];

    foreach($agenda as $consulta){

        if(in_array($consulta["horario"], $horarios)){
            return "Sim";
        }

        $horarios[] = $consulta["horario"];
    }

    return "Não";
}

function organizarAgenda($agenda, $nome){

    $agenda = ordenarHorarios($agenda);

    return [
        "total" => totalConsultas($agenda),
        "pacientes" => pacientesDiferentes($agenda),
        "especialidades" => contarEspecialidades($agenda),
        "primeiro" => $agenda[0],
        "ultimo" => $agenda[count($agenda)-1],
        "lista" => $agenda,
        "pesquisa" => pesquisarPaciente($agenda, $nome),
        "duplicado" => horarioDuplicado($agenda)
    ];
}

$agenda = [
    ["paciente"=>"Andre","especialidade"=>"Cardiologia","data"=>"06/08/2026","horario"=>"08:00"],
    ["paciente"=>"Brayan","especialidade"=>"Ortopedia","data"=>"06/08/2026","horario"=>"10:00"],
    ["paciente"=>"Maria","especialidade"=>"Pediatria","data"=>"06/08/2026","horario"=>"09:00"],
    ["paciente"=>"Pedro","especialidade"=>"Cardiologia","data"=>"06/08/2026","horario"=>"11:00"]
];

$resultado = organizarAgenda($agenda, "Maria");

echo "Total de consultas: " . $resultado["total"] . "<br><br>";

echo "Pacientes diferentes: " . $resultado["pacientes"] . "<br><br>";

echo "Consultas por especialidade:<br>";
foreach($resultado["especialidades"] as $esp => $qtd){
    echo $esp . ": " . $qtd . "<br>";
}

echo "<br>Primeiro atendimento:<br>";
echo "Paciente: " . $resultado["primeiro"]["paciente"] . "<br>";
echo "Especialidade: " . $resultado["primeiro"]["especialidade"] . "<br>";
echo "Data: " . $resultado["primeiro"]["data"] . "<br>";
echo "Horário: " . $resultado["primeiro"]["horario"] . "<br>";

echo "<br>Último atendimento:<br>";
echo "Paciente: " . $resultado["ultimo"]["paciente"] . "<br>";
echo "Especialidade: " . $resultado["ultimo"]["especialidade"] . "<br>";
echo "Data: " . $resultado["ultimo"]["data"] . "<br>";
echo "Horário: " . $resultado["ultimo"]["horario"] . "<br>";

echo "<br>Agenda ordenada:<br>";
foreach($resultado["lista"] as $consulta){
    echo "Paciente: " . $consulta["paciente"] . " - ";
    echo "Horário: " . $consulta["horario"] . "<br>";
}

echo "<br>Pesquisa do paciente:<br>";

if(is_array($resultado["pesquisa"])){
    echo "Paciente: " . $resultado["pesquisa"]["paciente"] . "<br>";
    echo "Especialidade: " . $resultado["pesquisa"]["especialidade"] . "<br>";
    echo "Data: " . $resultado["pesquisa"]["data"] . "<br>";
    echo "Horário: " . $resultado["pesquisa"]["horario"] . "<br>";
}else{
    echo $resultado["pesquisa"] . "<br>";
}

echo "<br>Horários duplicados: " . $resultado["duplicado"];






?>