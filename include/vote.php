<?php

namespace App;

class Vote
{
    private $pdo;
    private $former_vote;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function recordExists($ref, $productId)
    {
        $req = $this->pdo->prepare("SELECT * FROM $ref where id = ?");
        $req->execute([$productId]);
        if ($req->rowCount() == 0) {
            throw new Exception('impossible de voter');
        }
    }

    public function like($ref, $productId, $client_id)
    {
        if ($this->vote($ref, $productId, $client_id, 1)) {
            $sql_part = "";
            if ($this->former_vote) {
                $sql_part = ", dislike_count = dislike_count -1 ";
            }
            $this->pdo->query("UPDATE $ref SET like_count = like_count + 1 $sql_part WHERE id = $productId");
            return true;
        }
        return false;
    }

    public function dislike($ref, $productId, $client_id)
    {
        if ($this->vote($ref, $productId, $client_id, -1)) {
            $sql_part = "";
            if ($this->former_vote) {
                $sql_part = ", like_count = like_count -1 ";
            }
            $this->pdo->query("UPDATE $ref SET dislike_count = dislike_count + 1 $sql_part WHERE id = $productId");
            return true;
        }
        return false;
    }
    /**
     * Permet d'ajouter une classe is-liked ou is disliked sivant un enregistrement
     */
    public static function getClass($vote)
    {
        if ($vote) {
            return $vote->vote === 1 ? 'is-liked' : 'is-disliked';
        }
        return null;
    }

    private function vote($ref, $productId, $client_id, $vote)
    {
        $this->recordExists($ref, $productId);
        $req = $this->pdo->prepare("SELECT id, vote from votes WHERE ref = :ref AND product_id = :product_id AND 
        client_id = :client_id ");
        $req->execute([
            ':ref' => $ref,
            ':product_id' => $productId,
            ':client_id' => $client_id,
        ]);
        $vote_row = $req->fetch();

        if ($vote_row) {
            if ($vote_row->vote == $vote) {
                return false;
            }
            $this->former_vote = $vote_row;
            $this->pdo->prepare("UPDATE votes SET vote = ?, created_at = ?  WHERE id = {$vote_row->id}")->execute([$vote, date('Y-m-d- H:i:s')]);

            return true;
        }
        $req = $this->pdo->prepare("INSERT INTO votes (ref, product_id, client_id, created_at, vote)
                VALUES (:ref, :product_id, :client_id, NOW(), $vote)");
        $req->execute([
            ':ref' => $ref,
            ':product_id' => $productId,
            ':client_id' => $client_id,
        ]);
        return true;
    }

    public function updateCount($ref, $productId)
    {
        $req = $this->pdo->prepare("SELECT count(id) as count, vote from votes WHERE ref = :ref AND 
        product_id = :product_id GROUP BY vote");
        $req->execute([
            ':ref' => $ref,
            ':product_id' => $productId,
        ]);
        $votes = $req->fetchAll();
        $counts = [
            '-1' => 0,
            '1' => 0
        ];
        foreach ($votes as $vote) {
            $counts[$vote->vote] = $vote->count;
        }
        $req = $this->pdo->prepare("UPDATE $ref SET like_count = {$counts[1]}, dislike_count = {$counts[-1]}  
        WHERE id = $productId");
        return true;
    }
}
