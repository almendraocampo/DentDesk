<?php
require_once 'BaseDatos.php';

class Transaccion {
    private $db;

    public function __construct() {
        $this->db = (new BaseDatos())->obtenerConexion();
    }

    public function agregar($tipo, $monto, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO transacciones (tipo, monto, descripcion) VALUES (?, ?, ?)");
        $stmt->execute([$tipo, $monto, $descripcion]);
    }

    public function obtenerTodas() {
        $stmt = $this->db->query("SELECT * FROM transacciones ORDER BY fecha DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalMensual($mes = null, $anio = null) {
        if(!$mes) $mes = date('m');
        if(!$anio) $anio = date('Y');

        $stmt = $this->db->prepare("
            SELECT SUM(CASE WHEN tipo='ingreso' THEN monto ELSE -monto END) as total
            FROM transacciones
            WHERE strftime('%m', fecha)=? AND strftime('%Y', fecha)=?
        ");
        $stmt->execute([str_pad($mes, 2, "0", STR_PAD_LEFT), $anio]);
        return $stmt->fetchColumn();
    }
}
