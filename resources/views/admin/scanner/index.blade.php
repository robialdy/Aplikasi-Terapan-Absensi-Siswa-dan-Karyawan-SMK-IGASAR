<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <!-- Menggunakan CDN dari jsDelivr -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        h1 {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            z-index: 10;
        }
    </style>
</head>
<body>
    <h1>Scan QR Code Milik Anda</h1>

    <!-- Div untuk menampilkan video dari kamera -->
    <div id="reader" style="width: 100%; height: 100%;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('reader');

            // Cek apakah browser mendukung getUserMedia
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Menginisialisasi Html5Qrcode
                const html5QrCode = new Html5Qrcode("reader");

                // Fungsi sukses ketika QR code terdeteksi
                function onScanSuccess(decodedText, decodedResult) {
                    alert(`QR Code Detected: ${decodedText}`);
                }

                // Fungsi error jika terjadi kesalahan dalam pemindaian
                function onScanError(errorMessage) {
                    console.warn(errorMessage);
                }

                // Mulai kamera dan mulai pemindaian QR code
                html5QrCode.start(
                    { facingMode: "environment" },
                    { fps: 10, qrbox: 250 }, // Pengaturan FPS dan ukuran kotak pemindaian
                    onScanSuccess,
                    onScanError
                ).catch(function(err) {
                    console.error("Gagal membuka kamera:", err);
                });
            } else {
                alert('Your browser does not support camera access.');
            }
        });
    </script>
</body>
</html>
