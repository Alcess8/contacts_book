<?php
class JsonContactManager
{
    private $filePath;

    public function __construct($filePath = __DIR__ . '/../../data/contacts.json')
    {
        $this->filePath = $filePath;
        $this->ensureFileExists();
    }

    private function ensureFileExists()
    {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, '[]');
        }
    }

    private function readContacts()
    {
        $content = file_get_contents($this->filePath);
        return json_decode($content, true) ?: [];
    }

    private function writeContacts($contacts)
    {
        file_put_contents($this->filePath, json_encode($contacts, JSON_PRETTY_PRINT));
    }

    public function addContact($name, $email, $favorite = false)
    {
        $contacts = $this->readContacts();
        $contacts[] = [
            'name' => $name,
            'email' => $email,
            'favorite' => $favorite
        ];
        $this->writeContacts($contacts);
        return true;
    }

    public function getAllContacts()
    {
        return $this->readContacts();
    }

    public function getContact($id)
    {
        $contacts = $this->readContacts();
        return $contacts[$id] ?? null;
    }

    public function updateContact($id, $name, $email, $favorite)
    {
        $contacts = $this->readContacts();
        if (isset($contacts[$id])) {
            $contacts[$id] = [
                'name' => $name,
                'email' => $email,
                'favorite' => $favorite
            ];
            $this->writeContacts($contacts);
            return true;
        }
        return false;
    }

    public function deleteContact($id)
    {
        $contacts = $this->readContacts();
        if (isset($contacts[$id])) {
            array_splice($contacts, $id, 1);
            $this->writeContacts($contacts);
            return true;
        }
        return false;
    }
}
