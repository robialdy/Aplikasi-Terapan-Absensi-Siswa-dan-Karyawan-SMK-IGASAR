<!DOCTYPE html>
<html>
<head>
    <title>Scan Barcode</title>
</head>
<body>
    <h1>Scan Barcode ID User</h1>
    <video id="preview" width="400" height="300"></video>

    <div id="user-info" style="display:none;">
        <h2>User Info</h2>
        <p><strong>Nama:</strong> <span id="user-name"></span></p>
        <p><strong>Email:</strong> <span id="user-email"></span></p>
        <p><strong>Waktu Scan:</strong> <span id="scan-time"></span></p>
    </div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
                console.clear(); // biar bersih tiap scan
                console.log("Barcode terbaca mentah:", content);

                try {
                    const parsed = JSON.parse(content);
                    console.log("Parsed JSON:", parsed);
                    alert("ID User: " + parsed.id);
                } catch (err) {
                    console.warn("Gagal parse JSON, isi mungkin bukan JSON:", content);
                    alert("Isi QR:", content);
                }
            // fetch('{{ route('scanner.siswa') }}', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //     },
            //     body: JSON.stringify({ barcode: content })
            // })
            // .then(res => res.json())
            // .then(data => {
            //     if (data.success) {
            //         document.getElementById('user-info').style.display = 'block';
            //         document.getElementById('user-name').textContent = data.user.name;
            //         document.getElementById('user-email').textContent = data.user.email;
            //         document.getElementById('scan-time').textContent = data.log.scanned_at;
            //     } else {
            //         alert(data.message || 'Scan gagal');
            //     }
            // });
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            console.log(cameras);
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('Tidak ada kamera ditemukan.');
            }
        });
    </script>
</body>
</html>
