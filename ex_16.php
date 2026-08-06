<?php

function contarMaiusculas($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(ctype_upper($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}

function contarMinusculas($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(ctype_lower($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}

function contarNumeros($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(is_numeric($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}

function contarEspeciais($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(!ctype_alnum($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}

function classificarSenha($senha){

    if(strlen($senha) < 8){
        return "Fraca";
    }

    if(contarMaiusculas($senha) > 0 && contarMinusculas($senha) > 0 && contarNumeros($senha) > 0 && contarEspeciais($senha) > 0){
        return "Muito Forte";
    }

    if(contarMaiusculas($senha) > 0 && contarMinusculas($senha) > 0 && contarNumeros($senha) > 0){
        return "Forte";
    }

    return "Média";
}

function analisarSenha($senha){

    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Nível" => classificarSenha($senha)
    ];

}

$senha = "Andre@123";

$resultado = analisarSenha($senha);

echo "Senha: " . $senha . "<br>";
echo "Maiúsculas: " . $resultado["Maiúsculas"] . "<br>";
echo "Minúsculas: " . $resultado["Minúsculas"] . "<br>";
echo "Números: " . $resultado["Números"] . "<br>";
echo "Especiais: " . $resultado["Especiais"] . "<br>";
echo "Tamanho: " . $resultado["Tamanho"] . "<br>";
echo "Nível de Segurança: " . $resultado["Nível"];