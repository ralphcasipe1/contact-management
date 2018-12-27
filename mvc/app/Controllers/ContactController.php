<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Contact;

class ContactController
{
    private $database;

    public $viewRoot = __DIR__ . '/../Views';

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($page) {
            case ($page == 'index'):
                $contacts = $this->database->fetchAll('contacts');
                
                require $this->viewRoot . '/index.php';
                
                break;

            case ($page == 'show'):

                $contactId = filter_input(INPUT_GET, 'contact_id', FILTER_SANITIZE_SPECIAL_CHARS);
                
                $contact = $this->database->getById('contacts', $contactId);

                require $this->viewRoot . '/show.php';

                break;

            case ($page == 'delete'):
                require 'Views/delete.php';

                break;

            case ($page == 'create'):
            
                if (isset($_POST['submit'])) {   
                    $contact = new Contact();
                    $contact->setName($_POST['name']);
                    $contact->setCompany($_POST['company']);
                    $contact->setPhone($_POST['phone']);
                    $contact->setAddress($_POST['address']);
                    $contact->setEmail($_POST['email']);
                    $storeContact = $this->create($contact);
                    
                    header('Location: index.php?page=show&store_contact=' . (bool) $storeContact . '&contact_id=' . $storeContact['id']);

                    exit();
                }
            
                require $this->viewRoot . '/create.php';

                break;

            default:
                $contacts = $this->database->fetchAll('contacts');

                require $this->viewRoot . '/index.php';

                break;
        }
    }

    public function update(Contact $contact)
    {
        return $this->database->update('contacts', $contact->getId(), $contact->toArray());
    }

    public function create(Contact $contact)
    {
        return $this->database->create('contacts', $contact->toArray());
    }
}