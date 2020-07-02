<script>
    window.addEventListener("DOMContentLoaded", function() {
        setInterval(() => {
            document.getElementById("timer").innerHTML = document.getElementById("timer").innerHTML - 1
        }, 1000)
    })
</script>