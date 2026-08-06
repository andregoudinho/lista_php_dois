<?php
function contarCaracteres($texto){
    return strlen($texto);
}

function contarPalavras($texto){
    return str_word_count($texto);
}

function contarFrases($texto){
    return substr_count($texto, ".") + substr_count($texto, "!") + substr_count($texto, "?");
}

function maiorPalavra($texto){

    $palavras = explode(" ", trim($texto));
    $maior = $palavras[0];

    foreach($palavras as $palavra){
        if(strlen($palavra) > strlen($maior)){
            $maior = $palavra;
        }
    }

    return $maior;
}

function menorPalavra($texto){

    $palavras = explode(" ", trim($texto));
    $menor = $palavras[0];

    foreach($palavras as $palavra){
        if(strlen($palavra) < strlen($menor)){
            $menor = $palavra;
        }
    }

    return $menor;
}

function palavrasRepetidas($texto){

    $palavras = explode(" ", strtolower(trim($texto)));
    $contagem = array_count_values($palavras);

    $repetidas = 0;

    foreach($contagem as $valor){
        if($valor > 1){
            $repetidas++;
        }
    }

    return $repetidas;
}

function cincoFrequentes($texto){

    $palavras = explode(" ", strtolower(trim($texto)));
    $contagem = array_count_values($palavras);

    arsort($contagem);

    return array_slice($contagem, 0, 5, true);
}

function tirarEspacos($texto){
    return preg_replace('/\s+/', ' ', trim($texto));
}

function formatarTexto($texto){
    return ucwords(strtolower(tirarEspacos($texto)));
}

function processarTexto($texto){
    return [
        "Caracteres" => contarCaracteres($texto),
        "Palavras" => contarPalavras($texto),
        "Frases" => contarFrases($texto),
        "Maior Palavra" => maiorPalavra($texto),
        "Menor Palavra" => menorPalavra($texto),
        "Palavras Repetidas" => palavrasRepetidas($texto),
        "Cinco Mais Frequentes" => cincoFrequentes($texto),
        "Sem Espaços Duplicados" => tirarEspacos($texto),
        "Texto Formatado" => formatarTexto($texto)
    ];

}

$texto = "Isso é um teste de php.";

$resultado = processarTexto($texto);

echo "Caracteres: " . $resultado["Caracteres"] . "<br>";
echo "Palavras: " . $resultado["Palavras"] . "<br>";
echo "Frases: " . $resultado["Frases"] . "<br>";
echo "Maior Palavra: " . $resultado["Maior Palavra"] . "<br>";
echo "Menor Palavra: " . $resultado["Menor Palavra"] . "<br>";
echo "Palavras Repetidas: " . $resultado["Palavras Repetidas"] . "<br>";

echo "Cinco Palavras Mais Frequentes:<br>";

foreach($resultado["Cinco Mais Frequentes"] as $palavra => $quantidade){
    echo $palavra . " - " . $quantidade . "<br>";
}

echo "<br>Sem Espaços Duplicados: " . $resultado["Sem Espaços Duplicados"] . "<br>";
echo "Texto Formatado: " . $resultado["Texto Formatado"];




?>