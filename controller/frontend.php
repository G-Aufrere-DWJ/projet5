<?php
require('vendor/autoload.php');

use Guillaume\model\Manager;
use Guillaume\model\PostManager;
use Guillaume\model\UserManager;
use Guillaume\model\CommentManager;

function afficheHome()
{
    require('view/frontend/homeView.php');
}

function addUser($pseudo, $password)
{
    $userManager = new UserManager();

    if ($userManager->checkPseudo($pseudo))
    {
        $success = $userManager->insertUser($pseudo, $password);
        if ($success == false) {
            throw new Exception ('Erreur');
        }
        else {
            header('Location: index.php?action=home');
        }
    }
    else {
        throw new Exception ('Ce pseudo est déjà utilisé, veuillez en choisir un nouveau');
    }
}

function afficheInscription()
{
    require('view/frontend/registrationView.php');
}

function connection($pseudo, $password)
{   
    $userManager = new UserManager();
    $req = $userManager->userExists($pseudo);
    
    if ($req === false) {
        throw new Exception('Mauvais identifiant ou mot de passe 2');
    }
    else {
        $user = $req->fetch();
        $correctPassword = password_verify($password, $user['password']);

            if ($correctPassword) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?action=home');
        }
        else {
            throw new Exception('Mauvais identifiant ou mot de passe');
        }
    }
}

function afficheConnexion()
{
    require('view/frontend/connectView.php');
}

function disconnect()
{
    $_SESSION = array();
    session_destroy();
    header('Location: index.php?action=home');
}

function afficheAdmin()
{
    require('view/frontend/adminView.php');
}

function newPost($title, $content, $id_rubrique)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->addPost($title, $content, $id_rubrique);

    if ($affectedLines == false) {
        throw new Exception('Impossible d\'ajouter l\'article !');
    }
    else {
        header('Location: index.php?action=admin');
    }
}

function writeArticle()
{
    require('view/frontend/newPostView.php');
}

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts($_GET['id_rubrique']);
    
    require('view/frontend/listPostView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}

function displayModifyPost()
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);

    require('view/frontend/gestionOnePostView.php');
}

function updatePost($id, $title, $post)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->modifyPost($id, $title, $post);
    

    if ($affectedLines == false)
    {
        throw new Exception ('Impossible de modifier le contenu');
    }
    else {
        header('Location: index.php?action=admin');
    }
}

function adminPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPostsAdmin();

    require('view/frontend/gestionPostsView.php');
}

function removePost($id)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->deletePost($id);

    if ($affectedLines == false)
    {
        throw new Exception ('Impossible de supprimer cet article');
    }
    else {
        header('Location: index.php?action=admin');
    }
}

function addComment($post_id, $id_author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($post_id, $_SESSION['id'], $comment);

    if ($affectedLines == false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $post_id);
    }
}

function afficheCommentaires()
{
    $commentManager = new CommentManager();
    $comments = $commentManager->getSignalComments();
    
    require('view/frontend/listSignalCommentsView.php');
}

function uploadFile()
{
    $dossier = 'public/upload/';
    $fichier = basename($_FILES['avatar']['name']);
    $taille_maxi = 100000;
    $taille = filesize($_FILES['avatar']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['avatar']['name'], '.');
    $fichier = $_SESSION['id'] . $extension;

    if(!in_array($extension, $extensions))
    {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    }

    if($taille>$taille_maxi)
        {
            $erreur = 'Le fichier est trop gros...';
        }

    if(!isset($erreur))
    {
        $fichier = strtr($fichier, 
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier))
            {
                echo 'Upload effectué avec succès !';
                $membreid = $_SESSION['id'];
                $fichier_avatar = $dossier . $fichier;
                $userManager = new UserManager();
                $result = $userManager->addAvatar($membreid, $fichier_avatar);
                if($result == false) {
                    throw new Exception('problème survenu lors de l\'envoi');
                }
                else {
                    //redirection vers page du profil ou refresh pour afficher avatar
                }
                
            }
            else
            {
                throw new Exception ('Echec de l\'upload !');
            }
    }
}

function afficheAvatar() 
{
    
    require('view/frontend/uploadView.php');
}

function pagination()
{
    $postManager = new PostManager();
    $count = $postManager->countPosts();

    $currentPage = (int)($_GET['page']);
    if ($currentPage <= 0) {
        throw new Exception ('Numéro de page invalide');
    }

    $pages = ceil($count / 2);
    if ($currentPage > $pages) {
        throw new Exception ('Cette page n\'existe pas');
    }

    require('view/frontend/listPostView.php');
}