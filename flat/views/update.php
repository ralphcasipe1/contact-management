<?php
require '../app/Database.php';

if (!empty($_GET['contact_id'])) {
    $contactId = $_REQUEST['contact_id'];
}
    
if ($contactId == null) {
    header("Location: index.php");
}

$data = $database->show($contactId);

$hashFileName = sha1_file($_FILES['photo']['tmp_name']);

if (!empty($_POST)) {
    try {
        if (!isset($_FILES['photo']['error']) || is_array($_FILES['photo']['error'])) {
            throw new RuntimeException('Invalid parameters');
        }

        switch ($_FILES['photo']['error']) {
            case UPLOAD_ERR_OK:
                break;

            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent');

            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit');

            default:
                throw new RuntimeException('Unknown errors.');
        }

        if ($_FILES['photo']['size'] > 1000000) {
            throw new RuntimeException('Exceeded filesize limit');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        
        if (false === $ext = array_search(
            $finfo->file($_FILES['photo']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
            ),
            true
        )) {
            throw new RuntimeException('Invalid file format');
        }
        
        if (!move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            sprintf(
                __DIR__ . '/../uploads/%s.%s',
                $hashFileName,
                $ext
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file');
        }

        echo 'File is uploaded successfully.';

    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }

    $nameError = null;
        
    $name = $_POST['name'];
    $photo = sprintf(
        '../uploads/%s.%s',
        $hashFileName,
        $ext
    );
    $company = $_POST['company'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
        
    $valid = true;

    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    }
        
    if ($valid) {
        $database->update(
            $contactId, 
            $name, 
            $photo, 
            $company, 
            $phone, 
            $address, 
            $email
        );
        
        header("Location: index.php");
    }

} else {
    $name = $data['name'];

    // $photo = $data['photo'];

    $company = $data['company'];
    
    $phone = $data['phone'];

    $address = $data['address'];
    
    $email = $data['email'];
}

?>

<?php include 'components/_header.php' ?>

<h2><?php echo $data['name'] ?></h2>

<form 
    method="POST" 
    action="update.php?contact_id=<?php echo $contactId ?>" 
    enctype="multipart/form-data"
    name="updateContactForm"
    class="form"
>
    <div>
        <label>Photo</label>
        <input 
            type="file" 
            name="photo"
            accept="image/png, image/jpeg"
        >
    </div>

    <div class="row">
        <div class="col-25">
            <label>Name</label>
        </div>
        <div class="col-75">
            <input 
                type="text" 
                name="name" 
                value="<?php echo !empty($name) ? $name : ''; ?>"
                onkeyup="checkUpdateForm()"
            >
            <?php if (!empty($nameError)): ?>
                <div class="alert">
                    <span><?php echo $nameError ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-25">
            <label>Company</label>
        </div>
        <div class="col-75">
            <input type="text" name="company" value="<?php echo !empty($company) ? $company : ''; ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-25">
            <label>Phone No.</label>
        </div>
        <div class="col-75">
            <input type="text" name="phone" value="<?php echo !empty($phone) ? $phone : ''; ?>">
        </div>
    </div>
    
    <div class="row">
        <div class="col-25">
            <label>Address</label>
        </div>
        <div class="col-75">
            <input type="text" name="address" value="<?php echo !empty($address) ? $address : ''; ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-25">
            <label>E-mail</label>
        </div>
        <div class="col-75">
            <input type="text" name="email" value="<?php echo !empty($email) ? $email : ''; ?>">
        </div>
    </div>
    
    <div class="form-action">
        <a href="index.php" class="button">Cancel</a>

        <button type="submit" class="button button-success" id="updateButton">Update</button>
    </div>
    
</form>
<?php include 'components/_footer.php' ?>