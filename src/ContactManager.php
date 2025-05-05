<?php
class ContactManager
{
    private $filePath;

    public function __construct($filePath = null)
    {
        $this->filePath = $filePath ?: __DIR__ . '/../data/contacts.json';


        if (!file_exists(dirname($this->filePath))) {
            mkdir(dirname($this->filePath), 0777, true);
        }


        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, '[]');
            chmod($this->filePath, 0666);
        }
    }

    private function readData()
    {
        $json = file_get_contents($this->filePath);
        return json_decode($json, true) ?: [];
    }

    private function writeData($data)
    {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function addContact($name, $email, $favorite = false)
    {
        $contacts = $this->readData();
        $contacts[] = [
            'name' => $name,
            'email' => $email,
            'favorite' => (bool)$favorite
        ];
        $this->writeData($contacts);
        return true;
    }

    public function getAllContacts()
    {
        return $this->readData();
    }

    public function getContact($id)
    {
        $contacts = $this->readData();
        return $contacts[$id] ?? null;
    }

    public function updateContact($id, $name, $email, $favorite)
    {
        $contacts = $this->readData();
        if (isset($contacts[$id])) {
            $contacts[$id] = [
                'name' => $name,
                'email' => $email,
                'favorite' => (bool)$favorite
            ];
            $this->writeData($contacts);
            return true;
        }
        return false;
    }

    public function deleteContact($id)
    {
        $contacts = $this->readData();
        if (isset($contacts[$id])) {
            array_splice($contacts, $id, 1);
            $this->writeData($contacts);
            return true;
        }
        return false;
    }
}
