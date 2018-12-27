<?php

require_once '../app/Database.php';

$contactId = 0;

if (!empty($_GET['contact_id'])) {
    $contactId = $_REQUEST['contact_id'];
}

if (!empty($_POST)) {
    $contactId = $_POST['contact_id'];

    $database->delete($contactId);

    header("Location: index.php");
}

?>

<?php include 'components/_header.php' ?>
<div class="confirmation-wrapper">
    <div class="confirmation-content">
        <form method="POST" action="delete.php"> 
            <input type="hidden" name="contact_id" value="<?php echo $contactId ?>">
            <div class="text-confirmation m-b-md">
                Are you sure?
            </div>
            <div>
                <a href="index.php" class="button">No</a>
                <button type="submit" class="button button-success">Yes</button>
            </div>
        </form>
    </div>
</div>
<?php include 'components/_footer.php' ?>