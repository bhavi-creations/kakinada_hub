    <?php include 'navbar.php';  ?>

        
    
        <div id="overlay" class="overlay"></div>
        <button id="restaurant-icon" class="restaurant-icon">🍽</button>
        <div id="sidebar" class="sidebar side_view">
            <h1 class="side_bar_tittle">Restaurants 🍽</h1>
            <ul id="restaurant-list" class="restaurant-list"></ul>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const restaurantIcon = document.getElementById("restaurant-icon");
                const sidebar = document.getElementById("sidebar");
                const overlay = document.getElementById("overlay");
                
                function openSidebar() {
                    sidebar.classList.add("open");
                    overlay.classList.add("active");
                }
                
                function closeSidebar() {
                    sidebar.classList.remove("open");
                    overlay.classList.remove("active");
                }
                
                restaurantIcon.addEventListener("click", openSidebar);
                overlay.addEventListener("click", closeSidebar);
            });

            const restaurants = [
                { name: "Dominos", link: "./business_layout.php" },
                { name: "PizzaHut", link: "./business_layout.php" },
                { name: "KFC", link: "./business_layout.php" },
                { name: "MC donald's", link: "./business_layout.php" },
            ];

            const restaurantList = document.getElementById("restaurant-list");
            restaurants.forEach((restaurant) => {
                const listItem = document.createElement("li");
                const link = document.createElement("a");
                link.href = restaurant.link;
                // link.target = "_blank";
                link.rel = "noopener noreferrer";
                link.textContent = restaurant.name;
                
                listItem.appendChild(link);
                restaurantList.appendChild(listItem);
            });
        </script>



    

    <section>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="container">
                        <img src="" alt="">
                    </div>

                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </section>



    

        
    <?php include 'chat_bot.php';  ?>


    <?php include 'footer.php';  ?>
