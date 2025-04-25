

<?php if (!empty($banner)) : ?>
    <section id="adSection">
        <div class="sticky-ad" id="stickyAd">
            <div class="ad-container">
                <button class="close-ad" onclick="closeAd()">✖</button>
                <a href="<?php echo htmlspecialchars($banner['target_url']); ?>" target="_blank">
                    <img src="./admin/uploads/banner_ads/<?php echo htmlspecialchars($banner['image_path']); ?>" class="img-fluid" alt="Ad">
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>


<script>
    window.addEventListener("scroll", function() {
        let ad = document.getElementById("stickyAd");
        let adPosition = ad.offsetTop;

        if (window.scrollY >= adPosition) {
            ad.classList.add("fixed");
        } else {
            ad.classList.remove("fixed");
        }
    });

    function closeAd() {
        document.getElementById("adSection").style.display = "none";
    }
</script>