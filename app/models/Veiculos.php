<?php

namespace models;

class Veiculos extends Model {
    
    public function findById($id){
        $stmt = $this->pdo->prepare("select * from veiculos where id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all(){
        $stmt = $this->pdo->prepare("select * from veiculos");
        $stmt->execute();
        
        $list = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($list,$row);
        }

        return $list;
    }

    public function save($data){
        $sql = "INSERT INTO veiculos (placa, modelo, cor, ano) 
                    VALUES 
                (:placa, :modelo, :cor, :ano)";
        
        $stmt = $this->pdo->prepare($sql);
        #dd($data);
        if ($stmt->execute($data)) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }

    public function update($id, $data){
        #seta a ID
        $data["id"] = $id;

        $stmt = $this->pdo->prepare("UPDATE veiculos SET 
                                        placa = :placa, 
                                        modelo = :modelo, 
                                        cor = :cor,
                                        ano = :ano, 
                                    WHERE id = :id");
        if ($stmt->execute($data)) {
            return $id;
        } else {
            return false;
        }
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM veiculos WHERE id = :id");
        return $stmt->execute(["id"=>$id]);
    }
    
}

