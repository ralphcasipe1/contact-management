<?php require_once 'components/_header.php' ?>

<form action="index.php?page=create" method="POST">
  <div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
  </div>
  
  <div>
    <label for="company">Company</label>
    <input type="text" name="company" id="company">
  </div>

  <div>
    <label for="phone">Phone No.</label>
    <input type="text" name="phone" id="phone">
  </div>

  <div>
    <label for="address">Address</label>
    <input type="text" name="address" id="address">
  </div>

  <div>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email">
  </div>

  <div>
    <button type="submit" name="submit">Save</button>
  </div>
</form>

<?php require_once 'components/_footer.php' ?>