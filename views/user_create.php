<h5>Inscription</h5>
<section>
    <div><article>
        <form action="" method="post">
            <div>
                <label for="username">Identifiant:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirmer le mot de passe:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div>
                <button type="submit">Créer un compte</button>
            </div>
        </form>
        <p><?=anchor('playlist/connection','Vous avez déjà un compte ?');?></p>
        <error class="errorMessage"><?=$message?></error>
    </article></div>
</section>

