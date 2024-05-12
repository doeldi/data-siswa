<?php
session_start();

// Proses kirim data siswa
if (isset($_POST['kirim'])) {
    $siswa = array(
        'nama' => $_POST['nama'],
        'nis' => $_POST['nis'],
        'rayon' => $_POST['rayon']
    );

    if (isset($_SESSION['siswa'])) {
        $_SESSION['siswa'][] = $siswa;
    } else {
        $_SESSION['siswa'] = array($siswa);
    }
}

// Proses hapus data siswa
if (isset($_POST['hapus'])) {
    $index = $_POST['hapus'];
    if (isset($_SESSION['siswa'][$index])) {
        unset($_SESSION['siswa'][$index]); // Menghapus data siswa dari session
        $_SESSION['siswa'] = array_values($_SESSION['siswa']); // Menyusun kembali indeks array
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Siswa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        @media print {
            h2,
            form {
                display: none;
            }

            .table th,
            .table td {
                border-top: 1px solid #dee2e6;
                border-bottom: 1px solid #dee2e6;
                padding: 8px;
                margin: 10px;
                font-size: 30px;
            }

            h4 {
                font-size: 40px;
            }

            .table th {
                background-color: #f8f9fa;
                font-weight: bold;
            }

            .table {
                border-collapse: collapse;
                width: 95%;
            }

            .table th:last-child,
            .table td:last-child {
                display: none;
            }

            /* Add this rule to display the delete button when printing */
            .table .btn {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Form Input Data Siswa</h2>
        <form method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rayon">Rayon:</label>
                        <input type="text" class="form-control" id="rayon" name="rayon" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="kirim"><i class="fas fa-paper-plane"></i>
                        Kirim</button>
                    <button type="button" class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i>
                        Cetak</button>
                </div>
            </div>
        </form>

        <div class="container mt-3">
            <h4>Data Siswa:</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Rayon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['siswa'])): ?>
                        <?php foreach ($_SESSION['siswa'] as $index => $siswa): ?>
                            <tr>
                                <td><?php echo $siswa['nama']; ?></td>
                                <td><?php echo $siswa['nis']; ?></td>
                                <td><?php echo $siswa['rayon']; ?></td>
                                <td>
                                    <form method="POST">
                                        <button type="submit" class="btn btn-sm btn-danger" name="hapus"
                                            value="<?php echo $index; ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Belum ada data siswa yang tersimpan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>