<?php require_once 'components/_header.php' ?>
<h1>Show</h1>

<h2><?php print $contact['name'] ?></h2>
<dl>
  <dt>Company</dt>
  <dd><?php print $contact['company'] ?></dd>

  <dt>Address</dt>
  <dd><?php print $contact['address'] ?></dd>

  <dt>Phone No.</dt>
  <dd><?php print $contact['phone'] ?></dd>

  <dt>E-mail</dt>
  <dd><?php print $contact['email'] ?></dd>
</dl>

<a href="#">Delete</a>
<a href="index.php?page=edit">Edit</a>


<?php require_once 'components/_footer.php' ?>