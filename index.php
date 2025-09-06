<?php
require_once __DIR__ . '/src/Transaccion.php';
$transaccion = new Transaccion();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    $monto = $_POST['monto'] ?? 0;
    $descripcion = $_POST['descripcion'] ?? '';
    $transaccion->agregar($tipo, $monto, $descripcion);
}

$transacciones = $transaccion->obtenerTodas();
$total = $transaccion->totalMensual() ?? 0; // Evita null
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrador de Finanzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Administrador de Finanzas</h1>

    <!-- Formulario -->
    <div class="card p-4 mb-4 shadow-sm">
        <h3 class="mb-3">Total del mes: <span class="text-success">$<?= number_format($total, 2) ?></span></h3>
        <form method="POST">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Tipo:</label>
                    <select name="tipo" class="form-select" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="ingreso">Ingreso</option>
                        <option value="egreso">Egreso</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Monto:</label>
                    <input type="number" step="0.01" name="monto" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Descripción:</label>
                    <input type="text" name="descripcion" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Agregar Transacción</button>
        </form>
    </div>

    <!-- Tabla de transacciones -->
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Transacciones recientes</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($transacciones as $t): ?>
                        <tr>
                            <td><?= ($t['tipo']) ?></td>
                            <td><?= number_format($t['monto'] ?? 0,2) ?></td>
                            <td><?= ($t['descripcion']) ?></td>
                            <td><?= $t['fecha'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
