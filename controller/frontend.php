<?php
require('vendor/autoload.php');

use Guillaume\model\Manager;
use Guillaume\model\PostManager;
use Guillaume\model\UserManager;
use Guillaume\model\CommentManager;

function afficheHome()
{
    $postManager = new PostManager();
    $rubrique = $postManager->getRubriques();

    require('view/frontend/homeView.php');
}

function addUser($pseudo, $password)
{
    $userManager = new UserManager();

    if ($userManager->checkPseudo($pseudo)):
        $success = $userManager->insertUser($pseudo, $password);
        if ($success == false):
            throw new Exception ('Erreur');
        else:
            header('Location: index.php?action=home');
        endif;
    else:
        throw new Exception('Ce pseudo est déjà utilisé, veuillez en choisir un nouveau');
    endif;
}


function afficheInscription()
{
    require('view/frontend/registrationView.php');
}

function connection($pseudo, $password)
{   
    $userManager = new UserManager();
    $req = $userManager->userExists($pseudo);
    
    if ($req === false) :
        throw new Exception('Mauvais identifiant ou mot de passe 2');
    
    else :
        $user = $req->fetch();
        $correctPassword = password_verify($password, $user['password']);
    endif;
            if ($correctPassword) :
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?action=home');
        
        else :
            throw new Exception('Mauvais identifiant ou mot de passe');
        endif;
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

    if ($affectedLines == false) :
        throw new Exception('Impossible d\'ajouter l\'article !');
    
    else :
        header('Location: index.php?action=admin');
    endif;
}

function writeArticle()
{
    require('view/frontend/newPostView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $avatar = $userManager->getAvatar($_GET['id']);
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}

function reportComment($id, $post_id)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->signalComment($id);

    if ($affectedLines == false)
    :
        throw new Exception ('Impossible de signaler le commentaire');
    else:
        header('Location: index.php?action=post&id=' . $post_id);
    endif;
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
    :
        throw new Exception ('Impossible de modifier le contenu');
    else :
        header('Location: index.php?action=admin');
    endif;
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
    :
        throw new Exception ('Impossible de supprimer cet article');
    else :
        header('Location: index.php?action=admin');
    endif;
}

function addComment($post_id, $id_author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($post_id, $_SESSION['id'], $comment);

    if ($affectedLines == false) :
        throw new Exception('Impossible d\'ajouter le commentaire !');
    else :
        header('Location: index.php?action=post&id=' . $post_id);
    endif;
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
    :
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    endif;

    if($taille>$taille_maxi)
        :
            $erreur = 'Le fichier est trop gros...';
    endif;

    if(!isset($erreur)) :
        $fichier = strtr($fichier, 
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    endif;

    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) :

        $membreid = $_SESSION['id'];
        $fichier_avatar = $dossier . $fichier;
        $userManager = new UserManager();
        $result = $userManager->addAvatar($membreid, $fichier_avatar);
            if($result == false) :
                throw new Exception('problème survenu lors de l\'envoi');
            else :
                header('Location: index.php?action=displayAvatar');
            endif;
            else :
                throw new Exception ('Echec de l\'upload !');
            endif;
}

function afficheAvatar() 
{
    $userManager = new UserManager();
    $avatar = $userManager->getAvatar($_SESSION['id']);
    $name = $userManager->getName($_SESSION['id']);
    require('view/frontend/uploadView.php');
}

function listPosts()
{
    $postManager = new PostManager();
    $nbCount = $postManager->countPosts($_GET['id_rubrique']);
    $count = $nbCount->fetch()['COUNT(id)'];
    $perPage = 2;
    $countPages = ceil($count / 2);

    if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $countPages) :
        $currentPage = intval($_GET['page']);
    else :
        $currentPage = 1;
    endif;
    $start = ($currentPage - 1) * $perPage;
    $posts = $postManager->getPosts($_GET['id_rubrique'], $start, $perPage);
    
    require('view/frontend/listPostView.php');
}