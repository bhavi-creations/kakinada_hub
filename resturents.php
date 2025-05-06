<?php include 'navbar.php'; ?>
 

<section class="bg_section responsive_section">
    <div class="container">
        <h1 class="text-center gradient_text_color spacing_for_htag"> Best Restaurants</h1>
        <div class="row g-4">

            <?php
            $query = "SELECT id, name, main_image FROM restaurants";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
                    $id = $row['id'];
                    $name = htmlspecialchars($row['name']);
                    $images = explode(',', $row['main_image']);
                    $mainImage = !empty($images[0]) ? 'admin/uploads/restaurants/' . $images[0] : 'assets/img/placeholder.jpg';
            ?>
                <div class="col-6 col-md-3">
                    <a href="resturents_layouts.php?id=<?= $id ?>">
                        <div class="card bg-dark text-white shadow-lg d-flex flex-column align-items-center" style="height: 220px;">
                            <img src="<?= $mainImage ?>" alt="<?= $name ?>" class="img-fluid pic"
                                 style="width: 100%; height: 220px; object-fit: cover;">
                            <h3 class="mt-2 p-3 text-center list_page_test_tittle flex-grow-1 text-white"><?= $name ?></h3>
                        </div>
                    </a>
                </div>
            <?php
                endwhile;
            else:
                echo "<p class='text-center'>No restaurants found.</p>";
            endif;
            ?>
        </div>
    </div>
</section>

<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>
