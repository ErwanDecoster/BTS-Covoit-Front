<template>
  <div id="registration" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>

      <?php 
        if(isset($_GET['registration_err'])){
          $err = htmlspecialchars($_GET['login_err']) //vérifie que l'utilisateur ne rentre pas n'importe quoi

          switch($err){
            case 'nom':

            breack;

            case 'prenom':

            breack;

            case 'email':

            breack;

            case 'password':

            breack;

            case 'already':

            breack;
          }
        }
      ?>

      <form class="flex flex-col gap-4" action="inscription_traitement.php" method="post">
        <h2 class="text-2xl font-bold m-6">Inscription</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Nom : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="nom" id="nom">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Prenom : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="prenom" id="prenom">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="email">Email : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="email" id="email">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="new_password">Mot de passe : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_password" id="new_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="new_retipe_password">Confirmation de mot de passe : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_retipe_password" id="new_retipe_password">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">S'inscription</button>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Connection</button>
      </form>
    </div>
  </div>
</template>
