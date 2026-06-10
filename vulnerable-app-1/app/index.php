<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PixelDrop Gallery</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #17202a;
            --muted: #6b7280;
            --line: #d9e2ec;
            --paper: #ffffff;
            --wash: #f6f8fb;
            --accent: #0f766e;
            --accent-strong: #115e59;
            --coral: #f9735b;
            --gold: #f4b942;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 18%, rgba(249, 115, 91, .18), transparent 28rem),
                radial-gradient(circle at 88% 12%, rgba(15, 118, 110, .16), transparent 26rem),
                linear-gradient(135deg, #fffaf3 0%, #eef7f4 48%, #f8fbff 100%);
        }

        main {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            padding: 48px 0;
        }

        .shell {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(340px, 440px);
            gap: 28px;
            align-items: stretch;
        }

        .intro,
        .uploader {
            border: 1px solid rgba(23, 32, 42, .08);
            background: rgba(255, 255, 255, .82);
            box-shadow: 0 24px 70px rgba(23, 32, 42, .12);
            backdrop-filter: blur(16px);
        }

        .intro {
            min-height: 620px;
            padding: 34px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-size: .78rem;
            color: var(--accent-strong);
        }

        .mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: var(--accent);
            color: #fff;
            font-weight: 900;
        }

        h1 {
            max-width: 720px;
            margin: 70px 0 18px;
            font-size: clamp(2.4rem, 6vw, 5.4rem);
            line-height: .95;
            letter-spacing: 0;
        }

        .lede {
            max-width: 600px;
            margin: 0;
            color: #415060;
            font-size: 1.08rem;
            line-height: 1.7;
        }

        .mosaic {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 44px;
        }

        .tile {
            min-height: 132px;
            border-radius: 8px;
            background-size: cover;
            background-position: center;
            border: 1px solid rgba(23, 32, 42, .08);
        }

        .tile:nth-child(1) {
            grid-column: span 2;
            background-image: linear-gradient(135deg, rgba(15,118,110,.8), rgba(15,118,110,.12)), url("https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80");
        }

        .tile:nth-child(2) {
            background-image: linear-gradient(135deg, rgba(244,185,66,.82), rgba(244,185,66,.08)), url("https://images.unsplash.com/photo-1493246507139-91e8fad9978e?auto=format&fit=crop&w=600&q=80");
        }

        .tile:nth-child(3) {
            background-image: linear-gradient(135deg, rgba(249,115,91,.78), rgba(249,115,91,.08)), url("https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=600&q=80");
        }

        .tile:nth-child(4) {
            background-image: linear-gradient(135deg, rgba(23,32,42,.72), rgba(23,32,42,.08)), url("https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80");
        }

        .tile:nth-child(5) {
            grid-column: span 2;
            background-image: linear-gradient(135deg, rgba(17,94,89,.76), rgba(17,94,89,.08)), url("https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=900&q=80");
        }

        .uploader {
            border-radius: 8px;
            padding: 26px;
            align-self: start;
        }

        .panel-title {
            margin: 0 0 6px;
            font-size: 1.35rem;
        }

        .hint {
            margin: 0 0 22px;
            color: var(--muted);
            line-height: 1.5;
        }

        .dropzone {
            position: relative;
            min-height: 250px;
            border: 2px dashed #9bc6bf;
            border-radius: 8px;
            background: var(--wash);
            display: grid;
            place-items: center;
            padding: 22px;
            text-align: center;
            transition: border-color .2s ease, background .2s ease, transform .2s ease;
            overflow: hidden;
        }

        .dropzone.is-dragging {
            border-color: var(--coral);
            background: #fff7f3;
            transform: translateY(-2px);
        }

        .dropzone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .drop-content {
            pointer-events: none;
        }

        .icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 16px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #dff3ef;
            color: var(--accent-strong);
            font-size: 1.9rem;
        }

        .drop-title {
            margin: 0;
            font-weight: 800;
            font-size: 1.05rem;
        }

        .drop-copy {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: .92rem;
        }

        .preview {
            width: 100%;
            min-height: 250px;
            display: none;
            background: #111827;
        }

        .preview img {
            width: 100%;
            height: 100%;
            max-height: 330px;
            object-fit: cover;
            display: block;
        }

        label {
            display: block;
            margin: 20px 0 8px;
            font-weight: 700;
        }

        .filename-row {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            width: 100%;
            min-width: 0;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 13px 14px;
            font: inherit;
            background: #fff;
            color: var(--ink);
        }

        button {
            border: 0;
            border-radius: 8px;
            background: var(--accent);
            color: #fff;
            padding: 0 18px;
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        button[type="submit"] {
            width: 100%;
            margin-top: 20px;
            min-height: 52px;
            background: linear-gradient(135deg, var(--accent), var(--coral));
        }

        .status {
            min-height: 22px;
            margin-top: 14px;
            color: #b42318;
            font-weight: 700;
            font-size: .92rem;
        }

        @media (max-width: 880px) {
            main {
                padding: 24px 0;
            }

            .shell {
                grid-template-columns: 1fr;
            }

            .intro {
                min-height: auto;
            }

            h1 {
                margin-top: 44px;
            }

            .mosaic {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            main {
                width: min(100% - 20px, 1120px);
            }

            .intro,
            .uploader {
                padding: 20px;
            }

            .mosaic {
                gap: 8px;
            }

            .tile {
                min-height: 96px;
            }

            .filename-row {
                flex-direction: column;
            }

            button {
                min-height: 46px;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="shell">
            <section class="intro" aria-labelledby="page-title">
                <div>
                    <div class="brand">
                        <span class="mark">P</span>
                        <span>PixelDrop Studio</span>
                    </div>
                    <h1 id="page-title">Build a brighter image wall.</h1>
                    <p class="lede">Upload a photo for the shared gallery. The studio accepts common image formats and prepares a clean preview before publishing.</p>
                </div>

                <div class="mosaic" aria-hidden="true">
                    <div class="tile"></div>
                    <div class="tile"></div>
                    <div class="tile"></div>
                    <div class="tile"></div>
                    <div class="tile"></div>
                </div>
            </section>

            <section class="uploader" aria-labelledby="upload-title">
                <h2 id="upload-title" class="panel-title">New gallery image</h2>
                <p class="hint">Choose a JPG, PNG, GIF, or WebP image. The gallery stores uploads in a media library and serves them back after publishing.</p>

                <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data">
                    <div id="dropzone" class="dropzone">
                        <input id="file" type="file" name="file" accept="image/png,image/jpeg,image/gif,image/webp" required>
                        <div id="drop-content" class="drop-content">
                            <div class="icon">+</div>
                            <p class="drop-title">Drop an image here</p>
                            <p class="drop-copy">or click anywhere in this panel to browse</p>
                        </div>
                        <div id="preview" class="preview">
                            <img id="preview-image" alt="">
                        </div>
                    </div>

                    <label for="filename">Library filename</label>
                    <div class="filename-row">
                        <input id="filename" type="text" name="filename" value="summer-gallery.jpg" size="40" autocomplete="off">
                        <button id="reset-button" type="button">Reset</button>
                    </div>

                    <div id="status" class="status" role="status" aria-live="polite"></div>
                    <button type="submit">Publish image</button>
                </form>
            </section>
        </div>
    </main>

    <script>
        const form = document.getElementById('upload-form');
        const input = document.getElementById('file');
        const filename = document.getElementById('filename');
        const status = document.getElementById('status');
        const dropzone = document.getElementById('dropzone');
        const preview = document.getElementById('preview');
        const previewImage = document.getElementById('preview-image');
        const dropContent = document.getElementById('drop-content');
        const resetButton = document.getElementById('reset-button');
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        function setStatus(message) {
            status.textContent = message;
        }

        function resetPreview() {
            input.value = '';
            preview.style.display = 'none';
            previewImage.removeAttribute('src');
            dropContent.style.display = 'block';
            setStatus('');
        }

        function useFile(file) {
            if (!file) {
                resetPreview();
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                resetPreview();
                setStatus('Please choose an image file: JPG, PNG, GIF, or WebP.');
                return;
            }

            const reader = new FileReader();
            reader.onload = () => {
                previewImage.src = reader.result;
                preview.style.display = 'block';
                dropContent.style.display = 'none';
                setStatus('');

                if (!filename.value.trim()) {
                    filename.value = file.name;
                }
            };
            reader.readAsDataURL(file);
        }

        input.addEventListener('change', () => useFile(input.files[0]));

        ['dragenter', 'dragover'].forEach((eventName) => {
            dropzone.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropzone.classList.add('is-dragging');
            });
        });

        ['dragleave', 'drop'].forEach((eventName) => {
            dropzone.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropzone.classList.remove('is-dragging');
            });
        });

        dropzone.addEventListener('drop', (event) => {
            input.files = event.dataTransfer.files;
            useFile(input.files[0]);
        });

        resetButton.addEventListener('click', resetPreview);

        form.addEventListener('submit', (event) => {
            const file = input.files[0];
            if (!file || !allowedTypes.includes(file.type)) {
                event.preventDefault();
                setStatus('Select an image before publishing.');
            }
        });
    </script>
</body>
</html>
