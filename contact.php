<?php
declare(strict_types=1);
session_start();

/*---------------------------------------------------
        CONTROLLER
---------------------------------------------------*/

require_once __DIR__ . '/autoload.php';
$name = '';
$company = '';
$mobile = '';
$email = '';
$message = '';
$errors = [
    'name'=>'',
    'company'=>'',
    'mobile'=>'',
    'email'=>'',
    'message'=>'',
    'special'=>'',
];

$success = $_SESSION['success-contact'] ?? '';

$db = new Database();
if (isset($_POST['submit'])) {
    $name = $db->escape($_POST['name']);
    $company = $db->escape($_POST['company']);
    $mobile = $db->escape($_POST['mobile']);
    $email = $db->escape($_POST['email']);
    $message = $db->escape($_POST['message']);

    unset($_SESSION['success-contact']);

    if(strlen($name) > 30 ) {
        $errors['name'] = 'field must be less than 30 characters';
    }

    if(strlen($company) > 20 ) {
        $errors['company'] = 'field must be less than 30 characters';
    }

    if(strlen($email) > 30 ) {
        $errors['email'] = 'field must be less than 30 characters';
    }

    if(strlen($mobile) > 20 ) {
        $errors['email'] = 'field must be less than 20 characters';
    }

    if(strlen($message) > 1000 ) {
        $errors['email'] = 'field must be less than 1000 characters';
    }



    if (strlen($name) == 0) {
        $errors['name'] = 'name field cannot be empty';
    }

    if (strlen($company) == 0) {
        $errors['company'] = 'company field cannot be empty';
    }

    if (strlen($message) == 0) {
        $errors['message'] = 'message field cannot be empty';
    }

    if (strlen($email) == 0 && strlen($mobile) == 0 ) {
        $errors['special'] = 'submit an email or mobile number';
    } 


    // Login user
    if (empty(array_filter($errors))) {
        $_SESSION['success-contact'] = 'successfully entered';

        $db->insert("INSERT INTO contact_msg (name, company, mobile, email, message) VALUES ('$name', '$company', '$mobile', '$email', '$message')");
        $name = '';
        $company = '';
        $mobile = '';
        $email = '';
        
        
        
        


    }
}

?>



<!---------------------------------------------------
-         VIEW
---------------------------------------------------->
<?php $title = "Tyreport : login page"; ?>
<?php $heading = "contact page"; ?>
<?php require_once __DIR__ . '/layout/header.php'; ?>

<div class="contact__main">

    <?php require_once __DIR__ . '/layout/navbar.php'; ?>
    
    <?php require_once __DIR__ . '/layout/heading-main.php'; ?>
    
    <div class="container">
        
        
        <form class="mt20" action="contact.php" method="post">
            <fieldset class="fieldset">
                <legend class="legend">inquiry</legend>
                <div class="form-div">
                    <input class="input-text" type="text" placeholder="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <p class="error-message"><?php echo htmlspecialchars($errors['name']); ?></p>
                </div>
                
                <div class="form-div">
                    <input class="input-text" type="text" placeholder="company" name="company" value="<?php echo htmlspecialchars($company); ?>">
                    <p class="error-message"><?php echo htmlspecialchars($errors['company']); ?></p>
                </div>
                
                <div class="form-div">
                    <input class="input-text" type="text" placeholder="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
                    <p class="error-message"><?php echo htmlspecialchars($errors['mobile']); ?></p>
                </div>
                
                <div class="form-div">
                    <input class="input-text" type="text" placeholder="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <p class="error-message"><?php echo htmlspecialchars($errors['email']); ?></p>
                </div>
                
                <div class="form-div">
                    <textarea class="textarea" type="textarea" placeholder="message..." name="message"
                    rows="4"
                    value="<?php echo htmlspecialchars($message); ?>"
                    ></textarea>
                    <p class="error-message"><?php echo htmlspecialchars($errors['message']); ?></p>
                </div>
                
                <div class="form-div">
                    <p class="error-message"><?php echo htmlspecialchars($errors['special']); ?></p>
                    
                </div>
                
                <?php if(isset($_SESSION['success-contact'])) : ?>
                    <p class="success-message">successfully sent</p>
                    <?php endif; ?>
                    
                    <div class="mt20">
                        
                        <button class="btn1 mxauto block" type="submit" name="submit">submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
        
        
</div>