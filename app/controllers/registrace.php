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

        // Save user data to the database
        $user->save();

        // Get the last inserted user ID
        $userId = $user->id;

        // Set the directory path for saving profiles
        $profileDirectory = __DIR__ . '/../profiles/';

        // Create the directory if it doesn't exist
        if (!file_exists($profileDirectory)) {
            mkdir($profileDirectory, 0777, true);
        }

        // Move the uploaded image to the profile directory with the user ID as the filename
        $destinationPath = $profileDirectory . $userId . '.jpg'; // You may need to adjust the file extension based on your needs
        move_uploaded_file($imageFile['tmp_name'], $destinationPath);

        // Redirect to the home page
        $base->reroute("/");
    }



}