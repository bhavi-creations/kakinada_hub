<div id="overlay" class="overlay"></div>
<button id="restaurant-icon" class="restaurant-icon">🎬</button>
<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle">Movies 🎬</h1>
    <ul id="restaurant-list" class="restaurant-list"></ul>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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

    const restaurants = [{
            name: "Devi Multiplex",
            link: "./devi.php"
        },
        {
            name: "Anand Complex",
            link: "./anand.php"
        },
        {
            name: "Sri Priya Padma Priya",
            link: "./sripadama.php"
        },
        {
            name: "C&C",
            link: "./cc.php"
        },

        {
            name: "Geeth Sangeeth",
            link: "./geeth_sangeeth.php"
        },
        {
            name: "Thirumala",
            link: "./tirumala.php"
        }, 
        {
            name: "Inox",
            link: "./inox.php"
        }, 
        {
            name: "Surya",
            link: "./surya.php"
        },
        {
            name: "Satya Gowri",
            link: "./satyagowri.php"
        }, {
            name: "Mayuri",
            link: "./mayuri.php"
        },






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