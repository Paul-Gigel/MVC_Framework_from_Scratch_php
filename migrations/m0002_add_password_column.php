<?php
class m0002_add_password_column
{
    public function up()    {
        $db = \paul_core\paul_core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
    }
    public function down()  {
        $db = \paul_core\paul_core\Application::$app->db;
        $SQL = "CREATE TABLE users;";
        $db->pdo->exec($SQL);
    }
}