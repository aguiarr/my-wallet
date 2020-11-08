<?php


namespace Wallet\Model\Infrastructure\Persistence;


class CreateTables
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function verificaDB(){
        $sqlQuery = "SHOW TABLES LIKE 'competencia';";
        $stmt = $this->connection->query($sqlQuery);
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function crateTables()
    {
        $sqlQuery = "CREATE TABLE IF NOT EXISTS banco(
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) 
    );
    
    CREATE TABLE IF NOT EXISTS metodo_pagamento(
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) 
    );
    
    CREATE TABLE IF NOT EXISTS competencia(
        id INT PRIMARY KEY AUTO_INCREMENT,
        competencia VARCHAR(100),
        initial_date DATE,
        final_date DATE,
        valor DECIMAL(10,2)
    );

    CREATE TABLE IF NOT EXISTS entradas(
        id INT PRIMARY KEY AUTO_INCREMENT,
        valor DECIMAL(10,2) NOT NULL,
        descricao VARCHAR(500),
        date DATE,
        id_banco INT NOT NULL,
        id_competencia INT NOT NULL,
        id_metodo_pagamento INT NOT NULL
    );
    
    CREATE TABLE IF NOT EXISTS despesas(
        id INT PRIMARY KEY AUTO_INCREMENT,
        valor DECIMAL(10,2) NOT NULL,
        descricao VARCHAR(500),
        date DATE,
        id_banco INT NOT NULL,
        id_competencia INT NOT NULL,
        id_metodo_pagamento INT NOT NULL
    );
        ALTER TABLE entradas ADD FOREIGN KEY(id_banco) REFERENCES banco(id);
        ALTER TABLE entradas ADD FOREIGN KEY(id_competencia) REFERENCES competencia(id);
        ALTER TABLE entradas ADD FOREIGN KEY(id_metodo_pagamento) REFERENCES metodo_pagamento(id);
        
        ALTER TABLE despesas ADD FOREIGN KEY(id_banco) REFERENCES banco(id);
        ALTER TABLE despesas ADD FOREIGN KEY(id_competencia) REFERENCES competencia(id);
        ALTER TABLE despesas ADD FOREIGN KEY(id_metodo_pagamento) REFERENCES metodo_pagamento(id);
        
    ";
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->execute();
    }

}