<?php

require_once '../app/Database.php';

$contactId = $_REQUEST['contact_id'];

$data = $database->show($contactId);

?>

<?php include 'components/_header.php' ?>
    
<h2><?php echo $data['name'] ?></h2>

<dl>
    <dt>Company</dt>
    <dd><?php echo $data['company'] ?></dd>

    <dt>Phone</dt>
    <dd><?php echo $data['phone'] ?></dd>

    <dt>Address</dt>
    <dd><?php echo $data['address'] ?></dd>

    <dt>E-mail</dt>
    <dd><?php echo $data['email'] ?></dd>
</dl>

<a href="index.php" class="button">Back</a>

<a href="delete.php?contact_id=<?php echo $contactId ?>" class="button">Delete</a>

<a href="update.php?contact_id=<?php echo $contactId ?>" class="button">Update</a>

<?php include 'components/_footer.php' ?>