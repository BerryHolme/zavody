<?php
namespace controllers;

class registrace
{
    public function getPodminky(\Base $base)
    {
        echo \Template::instance()->render("podminky.html");
    }
    public function getRegistrace(\Base $base)
    {
        $base->set('error_msg', '');
        echo \Template::instance()->render("registrace.html");
    }

    public function postRegistrace(\Base $base)
    {
        $user = new \models\User();

        // Check if the email already exists
        $existingUser = $user->findone(["email=?", $base->get('POST.email')]);

        if ($existingUser) {
            // Email already exists
            $base->set('error_msg', 'Email už existuje');
            echo \Template::instance()->render("registrace.html");
            return;
        }

        // Proceed with registration
        $user->copyfrom($base->get('POST'));

        $imageFile = $base->FILES['image'];

        // Check if the file was uploaded successfully
        if ($imageFile['size'] > 0 && $imageFile['error'] === UPLOAD_ERR_OK) {
            // Check if the image size is less than 1 MB (1 MB = 1024 * 1024 bytes)
            if ($imageFile['size'] > 1024 * 1024) {
                // Handle error for image size exceeding 1 MB
                $base->set('error_msg', 'Obrázek je moc velký Max 1MB');
                echo \Template::instance()->render("registrace.html");
                return;
            }

            // Read the contents of the uploaded file
            $user->image = file_get_contents($imageFile['tmp_name']);
        } else {
            // Handle file upload error
            $base->set('error_msg', 'Error uploading the image file');
            echo \Template::instance()->render("registrace.html");
            return;
        }

        // Save user data to the database
        $user->save();

        // Redirect to the home page
        $base->reroute("/");
    }


}