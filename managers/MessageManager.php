<?php

class MessageManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM messages');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $messages = [];

        foreach ($result as $item) {
            $message= new Message($item["firstname"], $item["lastname"], $item["city"], $item["email"], $item["content"]);
            $message->setId($item["id"]);
            $messages[] = $message;
        }
        return $messages;
    }
    
    public function createMessage(Message $message): void
    {
        $query = $this->db->prepare('INSERT INTO messages (id, firstname, lastname, city, email, content) VALUES (NULL, :firstname, :lastname, :city, :email, :content)');
        $parameters = [
            "firstname" => $message->getFirstname(),
            "lastname" => $message->getLastname(),
            "city" => $message->getCity(),
            "email" => $message->getEmail(),
            "content" => $message->getContent()
        ];
        $query->execute($parameters);
        $message->setId($this->db->lastInsertId());
    }

    public function getMessageById(int $id): ?Message
    {
        $query = $this->db->prepare('SELECT * FROM messages WHERE id = :id');
        $query->execute(["id" => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            $message = new Message($result['firstname'], $result['lastname'], $result['city'], $result['email'], $result['content']);
            $message->setId($result["id"]);
            return $message;
        }
        return null;
    }

    public function updateMessage(Message $message): void
    {
        $query = $this->db->prepare('UPDATE messages SET firstname = :firstname, lastname = :lastname, city = :city, email = :email, content = :content WHERE id = :id');
        $parameters = [
            "id" => $message->getId(),
            "firstname" => $message->getFirstname(),
            "lastname" => $message->getLastname(),
            "city" => $message->getCity(),
            "email" => $message->getEmail(),
            "content" => $message->getContent()
        ];
        $query->execute($parameters);
    }

    public function deleteMessage(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM messages WHERE id = :id');
        $query->execute(["id" => $id]);
    }
}