<?php require_once 'components/_header.php' ?>

<h1>List of Contacts</h1>

<a href="index.php?page=create">Add new contacts</a>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td></td>
                <td><?php print $contact['name'] ?></td>
                <td>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php require_once 'components/_footer.php' ?>