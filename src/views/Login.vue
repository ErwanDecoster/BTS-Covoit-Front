<template>
  <div id="login" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <?php 
        if(isset($_GET['login_err'])){
          $err = htmlspecialchars($_GET['login_err']) //vérifie que l'utilisateur ne rentre pas n'importe quoi

          switch($err){
            case 'password':

            breack;

            case 'tel':

            breack;

            case 'already':

            breack;
          }
        }
      ?>
      <form class="flex flex-col gap-4" action="connexion.php" method="post">
        <h2 class="text-2xl font-bold m-6">Connection</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="tel">Telephone : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="tel" name="tel" id="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="password">Mot de passe : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="password" id="password">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Se connecter</button>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Inscription</button>
      </form>
    </div>
  </div>
</template>
