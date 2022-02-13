<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['new_password']) && !empty($_POST['new_retipe_password']))
    {
        // Patch XSS
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $new_password = htmlspecialchars($_POST['new_password']);
        $new_retipe_password = htmlspecialchars($_POST['new_retipe_password']);

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT tel, password FROM users');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($nom) <= 100){ // On verifie que la longueur du nom <= 100
              if(strlen($prenom) <= 100){ // On verifie que la longueur du prenom <= 100
                if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                        if($new_password === $new_retipe_password){ // si les deux mdp saisis sont bon

                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'adresse IP
                            $ip = $_SERVER['REMOTE_ADDR'];   //A voir

                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO users(l_name, f_name, email, password) VALUES(:l_name, :f_name, :email, :password, :ip, :token)');
                            $insert->execute(array(
                                'l_name' => $pseudo,
                                'f_name' => $email,
                                'email' => $email,
                                'password' => $password
                            ));
                            // On redirige avec le message de succès
                            header('Location:inscription.php?reg_err=success');
                            die();
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
              }else{ header('Location: inscription.php?reg_err=prenom_length'); die();}
            }else{ header('Location: inscription.php?reg_err=nom_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }
?>