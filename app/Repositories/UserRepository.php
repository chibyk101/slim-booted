<?php

namespace App\Repositories;

use App\Database\DB;

class UserRepository implements RepositoryInterface
{
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->db->query()->from('users')->select('*')->fetchAllAssociative();
    }

    public function create(array $data)
    {
        $insert = $this->db->query()->insert('users');

        foreach ($data as $column => $value) {
            $insert->setValue($column, ":$column");

            if ($column == 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }

            $insert->setParameter($column, $value);
        }

        return $insert->executeQuery();
    }

    public function find(int|string $id)
    {
        return $this->db->query()
            ->from('users')
            ->select('*')
            ->where("id = ?")
            ->setParameter(0, $id)
            ->executeQuery()
            ->fetchAssociative();
    }

    public function update(array $data, $id)
    {
        $updateQuery = $this->db->query()
            ->update('users')
            ->where("id = :id")
            ->setParameter('id', $id);

        foreach ($data as $column => $value) {

            $updateQuery->set($column, ":$column");

            if ($column == 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }

            $updateQuery->setParameter($column, $value);
        }

        return $updateQuery->executeQuery();
    }

    public function delete(int|string $id)
    {
        return $this->db->query()
            ->delete('users')
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery();
    }
}
