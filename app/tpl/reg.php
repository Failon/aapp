  <section>
    <h2>Register user section</h2>
    <div class="formreg">
                <form class="registre" name="formregister" method="post" action="<?=APP_W;?>reg/send">
                    <div id="hello"></div><!-- this is to show Hello name message -->
                    <label for="name">Name <input type="text" name="name"  placeholder="name" required></label>
                    <label for="email">email <input type="text" name="email"  placeholder="youremail@example.com" required></label>
                    <label for="password">password <input type="password" name="password" placeholder="password" required></label>
                    <label for="password">re-password <input type="password" name="repassword" placeholder="re-password" required></label>
                    <label for="city">city <input type="text" name="city" placeholder="city you live in" required/></label>
                    <input type="submit" value="Register" id="regsend">
                </form>           
              </div>
  </section>