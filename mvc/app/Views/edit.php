<?php require_once 'components/_header.php' ?>

<form action="index.php?page=update" method="POST">
    <input type="hidden" name="contact_id" value="<?php print $contact['contact_id'] ?>">

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php print $contact['name'] ?>">
    </div>
    
    <div>
        <label for="company">Company</label>
        <input type="text" name="company" id="company" value="<?php print $contact['company'] ?>">
    </div>

    <div>
        <label for="phone">Phone No.</label>
        <input type="text" name="phone" id="phone" value="<?php print $contact['phone'] ?>">
    </div>

    <div>
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?php print $contact['address'] ?>">
    </div>

    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?php print $contact['email'] ?>">
    </div>

    <div>
        <button type="submit" name="update">Update</button>
    </div>
</form>

<?php require_once 'components/_footer.php' ?>