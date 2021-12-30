<?php include "costheader.php" ?>

<!-- shopping-cart section  -->

<!-- Profile -->

<section class="profile-cart-container">
        <div class="profile-container">
            <header>
                <h3 class="title">Profile Saya</h3>
            </header>
            <main>
                <?php 
                $result = getProfile($conn, $_SESSION['userid']);
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $email = $row['email'];                
                $hape = $row['no_telpon'];
                $kelamin = $row['jenis_kelamin'];
                $birthday = $row['tanggal_lahir'];
                ?>
                <form action="" method="POST">
                    <div class="input-group">
                        <label class="input-label" for="name">Username</label>
                        <input type="text" name="username" id="name" placeholder="costumer's username" value=<?=  $username ?> required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" for="email">Email</label>
                        <input type="email" class="form-control" readonly name="email" id="email" placeholder="costumer's email" value=<?=  $email ?> required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" class="input-label" for="phone">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" placeholder="costumer's phone number" value=<?= $hape ?>>
                    </div>

                    <div class="input-group">
                        <p class="input-label">Jenis Kelamin</p>
                        <div class="input-radio">
                            <label ><input type="radio" name="kelamin"
                                    id="laki-laki" value="L" <?php echo ($kelamin =='L')? 'checked':'' ?> >Laki-Laki</label>
                            <label ><input type="radio" name="kelamin"
                                    id="perempuan" value="P" <?php echo ($kelamin =='P')? 'checked':'' ?> >Perempuan</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label" class="input-label" for="birthday">Tanggal Lahir</label>
                        <div class="input-date">
                            <input type="date" name="birthday" id="birthday" value=<?=  $birthday ?>>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label"></label>
                        <button type="submit" name="simpanProfile" class="btn">simpan</button>
                    </div>
                    
                </form>
                <aside>
                    <div class="image-card">
                        <img src="image/image4.jpg" alt="Photo Profile" />
                        <input type="file" id="file" accept="image/*">
                        <label for="file">
                            Choose a Photo
                        </label>
                        <caption>Ukuran gambar: maks. 1 MB</caption>
                    </div>
                </aside>
                
            </main>
        </div>
    </section>

    <script src="js/sweetalert/sweetalert2.all.min.js"></script>
  