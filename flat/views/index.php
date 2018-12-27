<?php

require_once '../app/Database.php';
    
$data = $database->index();

?>

<?php include 'components/_header.php' ?>

<main class="content">
    <a href="create.php" class="button">Create</a>
    <?php if ($data->rowCount() == 0): ?>
        
        <div class="confirmation-content">
            <div class="text-confirmation m-b-md">
                No Contacts Found!
            </div>
        </div>
        
    <?php else: ?>
        <input 
            type="search" 
            id="contactInput" 
            onkeyup="searchValue()" 
            placeholder="Search the contact by name"
        >
        <table class="table" id="contactTable">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>E-mail</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<td>
                            <img src="'.$row['photo'].'">
                        </td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['company'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>
                            <a href="show.php?contact_id='.$row['contact_id'].'" class="table-action">Show</a>
                            <a href="update.php?contact_id='.$row['contact_id'].'" class="table-action">Update</a>
                            <a href="delete.php?contact_id='.$row['contact_id'].'" class="table-action">Delete</a>
                        </td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    <?php endif ?>
</main>

<?php include 'components/_footer.php' ?>