<style>
    footer {
        margin-top: 11.5rem;
        position: relative;
        background: #001;
        font-family: 'Poppins', sans-serif;
        border-top-right-radius: 5rem;
        border-top-left-radius: 5rem;
    }

    .content,.contact {
        padding-top: 5rem;
        padding-bottom: 3rem;
        font-size: 2rem;
        font-weight: 690;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
    }

    a {
        text-decoration: none;
        background-image: linear-gradient(to right,
                #fff,
                #54b3d6 50%,
                #000 50%);
        background-size: 200% 100%;
        background-position: -100%;
        display: inline-block;
        padding: 5px 0;
        position: relative;
        -webkit-background-clip: text;
        color: #fff;
        transition: all 0.3s ease-in-out;
    }

    a:before {
        content: '';
        background: #54b3d6;
        display: block;
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 3px;
        transition: all 0.3s ease-in-out;
    }

    a:hover {
        background-position: 0;
    }

    a:hover::before {
        width: 100%;
    }

    hr {
        margin-top: 1rem;
    }
</style>

<footer>
    <div class="content">
        <div><a href=""><img height="50" width="50" src="images/instagram.png" alt="">Instagram</a></div>
        <div><a href=""><img height="50" width="50" src="images/youtube.png" alt="">Youtube</a></div>
        <div><a href=""><img height="50" width="50" src="images/linkedin.png" alt="">LinkedIn</a></div>
        <div><a href=""><img height="50" width="50" src="images/telegram.png" alt="">Telegram</a></div>
    </div>
    <hr>
    <hr>
    <div class="contact">
        <div><a href="mailto:muras100m1@gmail.com"><img src="images/gmail.png" height="50" width="50">muras100m1@gmail.com </a></div>
        <div><a href=""><img src="images/copyright.png" height="50" width="50"><?php echo "@Copyright " . date('Y'); ?></a></div>
    </div>
</footer>
<script>
    function changeCategory() {
        var catId = document.getElementById('catId').value;
        window.location.href = '?catId=' + catId;
    }
</script>
</body>

</html>