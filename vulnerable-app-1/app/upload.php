<?php
$upload_dir = "/var/www/uploads/";

// Intentionally trusts the submitted filename for the lab scenario.
$filename = $_POST["filename"];
$target = $upload_dir . $filename;
$success = move_uploaded_file($_FILES["file"]["tmp_name"], $target);
$is_media_upload = $success && realpath($target) !== false && str_starts_with(realpath($target), realpath($upload_dir) . DIRECTORY_SEPARATOR);
$public_name = basename($target);
$public_url = "image.php?name=" . rawurlencode($public_name);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Result</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #17202a;
            background:
                radial-gradient(circle at 20% 15%, rgba(249, 115, 91, .18), transparent 26rem),
                radial-gradient(circle at 84% 20%, rgba(15, 118, 110, .16), transparent 24rem),
                linear-gradient(135deg, #fffaf3 0%, #eef7f4 48%, #f8fbff 100%);
        }

        .result {
            width: min(560px, 100%);
            border: 1px solid rgba(23, 32, 42, .08);
            border-radius: 8px;
            background: rgba(255, 255, 255, .86);
            box-shadow: 0 24px 70px rgba(23, 32, 42, .12);
            padding: 30px;
        }

        .badge {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: #fff;
            font-weight: 900;
            font-size: 1.45rem;
            background: <?php echo $success ? "#0f766e" : "#b42318"; ?>;
        }

        h1 {
            margin: 22px 0 10px;
            font-size: clamp(2rem, 8vw, 3.4rem);
            line-height: 1;
            letter-spacing: 0;
        }

        p {
            margin: 0 0 18px;
            color: #526071;
            line-height: 1.6;
        }

        code {
            display: block;
            width: 100%;
            overflow-wrap: anywhere;
            border: 1px solid #d9e2ec;
            border-radius: 8px;
            background: #f6f8fb;
            padding: 14px;
            color: #17202a;
        }

        a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            margin-top: 22px;
            padding: 0 18px;
            border-radius: 8px;
            background: #0f766e;
            color: #fff;
            text-decoration: none;
            font-weight: 800;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .secondary {
            background: #17202a;
        }
    </style>
</head>
<body>
    <main class="result">
        <div class="badge"><?php echo $success ? "OK" : "!"; ?></div>
        <h1><?php echo $success ? "Image published" : "Upload failed"; ?></h1>
        <p>Storage target:</p>
        <code><?php echo htmlspecialchars($target, ENT_QUOTES, "UTF-8"); ?></code>
        <div class="actions">
            <?php if ($is_media_upload): ?>
                <a href="<?php echo htmlspecialchars($public_url, ENT_QUOTES, "UTF-8"); ?>">View image</a>
            <?php endif; ?>
            <a class="secondary" href="index.php">Back to gallery</a>
        </div>
    </main>
</body>
</html>
