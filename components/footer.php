<link rel="stylesheet" href="./style/footer.css" async>
<!-- na app -->
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/js/service-worker.js')
            .then(() => {
                console.log('Service Worker registered successfully.');
            })
            .catch((error) => {
                console.log('Service Worker registration failed:', error);
            });
    }
</script>
<footer>

    <div>
        <p> 2022 - 2023 <a href="./">Parking spots</a></p>


    </div>

    <ul>

        <li><a href="./index.php">Domov</a></li>
        <?php if (isset($_SESSION['user'])) : ?>
            <li><a title="Logout" onclick="return confirm('Chcete sa naozaj odhlásiť?')" href="./logout.script.php">Odhlásiť sa</li>
        <?php endif; ?>
    </ul>




</footer>