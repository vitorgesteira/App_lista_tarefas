<?php
    //CRUD
    class TarefaService{

        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa){
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        public function inserir(){ //create
            $query = 'insert into tb_tarefas(tarefa)value(:tarefa)';
            $stm = $this->conexao->prepare($query);
            $stm->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stm->execute();
        }

        public function recuperar(){ //read
            $query = '
                select
                    t.id, s.status, t.tarefa
                from
                    tb_tarefas as t
                left join
                    tb_status as s 
                on (t.id_status = s.id)                
            ';

            $stm = $this->conexao->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizar(){ //update
            // print_r($this->tarefa);
            $query = 'update tb_tarefas set tarefa = ? where id = ?';
            $stm = $this->conexao->prepare($query);
            $stm->bindValue(1, $this->tarefa->__get('tarefa'));
            $stm->bindValue(2, $this->tarefa->__get('id'));
            return $stm->execute();
        }

        public function remover(){ //delete
            $query = 'delete from tb_tarefas where id = :id';
            $stm = $this->conexao->prepare($query);
            $stm->bindValue(':id', $this->tarefa->__get('id'));
            $stm->execute();
        }

        public function marcarRealizada(){ //update realizada
            $query = 'update tb_tarefas set id_status = ? where id = ?';
            $stm = $this->conexao->prepare($query);
            $stm->bindValue(1, $this->tarefa->__get('id_status'));
            $stm->bindValue(2, $this->tarefa->__get('id'));
            return $stm->execute();
        }

        public function recuperarTarefasPendentes(){
            $query = '
                SELECT 
                    t.id, s.status, t.tarefa 
                FROM 
                    tb_tarefas as t
                LEFT JOIN 
                    tb_status as s
                ON 
                    (t.id_status = s.id)
                WHERE 
                    t.id_status = :id_status
            ';

            $stm = $this->conexao->prepare($query);
            $stm->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>