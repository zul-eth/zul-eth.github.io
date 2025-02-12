<?php
// proxy.php

// Mengambil URL target dari parameter GET
$target = isset($_GET['url']) ? $_GET['url'] : 'https://bulletstorm.xyz';

// Mengambil konten dari URL target
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);

// Menambahkan script VConsole ke konten yang didapat
$injection = "<script src='https://unpkg.com/vconsole@latest/dist/vconsole.min.js'></script><script>new VConsole();</script>";

// Jika kamu ingin menyisipkan script sebelum tag </body> (jika ada)
if (stripos($response, '</body>') !== false) {
    $response = str_ireplace('</body>', $injection . '</body>', $response);
} else {
    // Jika tidak ada tag </body>, tambahkan di akhir output
    $response .= $injection;
}

// Output konten yang sudah diinject
echo $response;
?>
