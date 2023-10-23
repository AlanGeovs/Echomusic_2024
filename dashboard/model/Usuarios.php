<?php
require_once "Conn.php";

class Usuarios extends Conn
{
    public static function validaLogin($correo, $password)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM users WHERE mail_user=:correo AND password_user=:password ");
        // $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo=:correo AND confirmPass=:password ");
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $result = $stmt->fetch();
            $stmt->closeCursor();  // Corrected method name and placed it before the return statement
            return $result;
        } else {
            $stmt->closeCursor();  // Corrected method name and placed it before the return statement
            return false; // You can also return an error or false here to indicate failure
        }
    }

    // public static function validaLogin($correo, $password)
    // {
    //     $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo=:correo AND confirmPass=:password");
    //     $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
    //     $stmt->bindParam(":password", $password, PDO::PARAM_STR);

    //     if ($stmt->execute()) {
    //         $result = $stmt->fetch();
    //         $stmt->closeCursor();  // Corrected method name and placed it before the return statement
    //         return $result;
    //     } else {
    //         $stmt->closeCursor();  // Corrected method name and placed it before the return statement
    //         return false; // You can also return an error or false here to indicate failure
    //     }
    // }

    public static function registrarBitacora($usuario, $tabla, $accion)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, accion) VALUES (:usuario, :accion)");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":accion", $accion, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt->closeCursor(); // Corrected method name and placed it before the return statement
            return "ok";
        } else {
            $stmt->closeCursor(); // Corrected method name and placed it before the return statement
            return "error";
        }
    }
    public static function consultaPrueba()
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, usuario, tipo FROM usuarios WHERE tipo like 'admin'");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor(); // cerrar el cursor aquí antes de retornar
        return $result;
    }
}
