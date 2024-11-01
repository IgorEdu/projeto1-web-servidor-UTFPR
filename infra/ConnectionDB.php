<?php

class ConnectionDB
{
    private static $instance;

    public static function getInstance()
    {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO('mysql:host=localhost;dbname=x-airlines', 'root', 'root');
            }
            return self::$instance;
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Erro geral: " . $e->getMessage();
            return null;
        }
    }
}