<h5>Connexion</h5>
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
                <button type="submit">Connexion</button>
            </div>
        </form>
        <p><?=anchor('playlist/register','Nouvel utilisateur ?');?></p>
        <error class="errorMessage"><?=$message?></error>
    </article></div>
</section>
