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

        }

        public function atualizar(){ //update
        
        }

        public function remover(){ //delete

        }
    }
?>