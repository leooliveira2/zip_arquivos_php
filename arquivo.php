<?php

include_once("PDFBase64.php");

$leitorPDF = new PDFBase64();

$stringBase64 = $leitorPDF->pdfToBase64("arquivos/exe1.txt");

$base64Decode = base64_decode($stringBase64);

$pdf = fopen("arquivos/exe2.txt", "w");
fwrite($pdf, $base64Decode);
fclose($pdf);

$zip = new ZipArchive();

$diretorioArquivos = "arquivos/";

$nomeArquivoZip = md5(time()) . ".zip";

$caminhoArquivoZip = "arquivosZip/" . $nomeArquivoZip;

if ($zip->open($caminhoArquivoZip, \ZipArchive::CREATE)) {
    $zip->addFile($diretorioArquivos . "exe1.txt", "exe1.txt");
    $zip->addFile($diretorioArquivos . "exe2.txt", "exe2.txt");

    $zip->close();
}


if (file_exists($caminhoArquivoZip)) {
    $arquivo = file_get_contents($caminhoArquivoZip);
    $zipBase64 = base64_encode($arquivo);

    $file_pointer = $caminhoArquivoZip;

    // Use unlink() function to delete a file
    if (!unlink($file_pointer)) {
        http_response_code(404);
        echo ("$file_pointer cannot be deleted due to an error");
    } else {
        http_response_code(200);
        echo $zipBase64;
    }

}