<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function innerJoin($table, $table2, $column, $column2)
    {
        $sql = sprintf(
            'select * from %s inner join %s on %s = %s;',
            $table,
            $table2,
            $column,
            $column2
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong.');
        }

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function select($table, $column, $data)
    {
        $sql = sprintf(
            "select * from %s where %s = '%s';",
            $table,
            $column,
            $data
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong.');
        }

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $parametrs)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s);',
            $table,
            implode(',', array_keys($parametrs)),
            implode(',', array_values($parametrs))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong');
        }
    }

    public function deleteAll($table)
    {
        $sql = "delete from {$table};";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }

    public function delete($table, $id)
    {
        $sql = "delete from {$table} where id = {$id};";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }

    public function lastRecord($table)
    {
        $sql = sprintf(
            'select id from %s order by id desc limit 1;',
            $table
        );

        try {
             $statement = $this->pdo->prepare($sql);
             $statement->execute();
        } catch (Exception $e) {
             die('Something went wrong.');
        }

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function execute($sql)
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong.');
        }

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function executeUpdate($sql)
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }

    public function login()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch();

        return $user;
    }

}
