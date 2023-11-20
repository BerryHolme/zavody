<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Přihlášení</title>
 <style>
  body {
   font-family: Arial, sans-serif;
   background-color: #f2f2f2;
   text-align: center;
   margin: 0;
   padding: 0;
  }
  form {
   max-width: 400px;
   margin: 0 auto;
   padding: 30px;
   background-color: #fff;
   border-radius: 5px;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  input {
   width: 90%;
   padding: 10px;
   margin: 5px 0;
   border: 1px solid #ccc;
   border-radius: 3px;
  }
  button {
   width: 90%;
   padding: 10px;
   background-color: #007BFF;
   color: #fff;
   border: none;
   border-radius: 3px;
   cursor: pointer;
  }
  button:hover {
   background-color: #0056b3;
  }
 </style>
</head>
<body>
<form method="post">
 <h1>Přihlašte se</h1>
 <input type="text" id="name" name="name" required placeholder="Uživatelské jméno">
 <br>
 <input type="email" id="email" name="email" required placeholder="Email">
 <br>
 <input type="password" id="password" name="password" required placeholder="Heslo">
 <br>
 <button type="submit">Přihlásit</button>
</form>
</body>
</html>
