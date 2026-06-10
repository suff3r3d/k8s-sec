<?php
$upload_dir = "/var/www/uploads/";
$filename = basename($_GET["name"] ?? "");
$path = $upload_dir . $filename;

if ($filename === "" || !is_file($path)) {
    http_response_code(404);
    echo "Image not found";
    exit;
}

$mime = mime_content_type($path);
$allowed_mimes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

if (!in_array($mime, $allowed_mimes, true)) {
    http_response_code(415);
    echo "Unsupported image type";
    exit;
}

header("Content-Type: " . $mime);
header("Content-Length: " . filesize($path));
readfile($path);
?>
