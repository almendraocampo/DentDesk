<?php
class BaseDatos {
    private $pdo;
    public function __construct() {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../db/base_datos.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->crearTabla();
    }

    private function crearTabla() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS transacciones (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            tipo TEXT,
            monto REAL,
            descripcion TEXT,
            fecha DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function obtenerConexion() {
        return $this->pdo;
    }
}
