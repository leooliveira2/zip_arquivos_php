<?php

class PDFBase64
{
    public function pdfToBase64(string $pathAndFile) : String
    {
        $handle = fopen($pathAndFile, "rb");
        $file_content = fread($handle, filesize($pathAndFile));
        fclose($handle);
        $encoded = chunk_split(base64_encode($file_content));

        // exibir o arquivo no formato string base64
        return $encoded;
    }

    public function base64ToPdf(string $base64)
    {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"" . "Guia.pdf" . "\";");
        echo file_get_contents("data://application/pdf;base64," . $base64);
    }
}