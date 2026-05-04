<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class UserManager extends AbstractEntityManager 
{
    /**
     * Récupère un user par son email.
     * @param string $email
     * @return ?User
     */
    public function getUserByEmail(string $email) : ?User
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);

        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user !== false) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère un user par son id.
     * @param string $id
     * @return ?User
     */
    public function getUserById(string $id) : ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Ajoute un utilisateur à la base de donnée et retourne son Id.
     * @return int
     */
    public function addUser(User $user) : int
    {
        $sql = "INSERT INTO users (pseudo, email, pass_word, date_creation) VALUES (:pseudo, :email, :pass_word, NOW())";
        $result = $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'pass_word' => $user->getPassword()
        ]);

        if ($result->rowCount() > 0) {
            return $this->db->getPDO()->lastInsertId();
        }
        else {
            throw new Exception("L'utilisateur n'a pas pu être créer.");
        }
    }

    /**
     * Modifie un utilisateur.
     * @param User $user : utilisateur à modifier.
     * @return void
     */
    public function updateAccount(User $user) : void
    {
        $sql = "UPDATE users SET pseudo = :pseudo, email = :email, pass_word = :pass_word WHERE id = :id";
        $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'pass_word' => $user->getPassword(),
            'id' => $user->getId(),
        ]);
    }
}