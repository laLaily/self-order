<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Cafe</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/ss/boxicons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            font-family: 'Playfair Display', serif;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-padding-top: 4rem;
            scroll-behavior: smooth;
            list-style: none;
            text-decoration: none;
        }

        :root {
            --main-color: #bc9667;
            --second-color: #edeae3;
            --text-color: #1b1b1b;
            --bg-color: #fff;
        }

        section {
            padding: 50px 100px;
        }

        img {
            width: 100%;
        }

        body {
            color: var(--text-color);
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 100px;
            transition: 0.5s linear;
            background: var(--text-color);
        }

        .logo img {
            width: 60px;
        }

        .navbar {
            display: flex;
        }

        .navbar a {
            padding: 8px 8px;
            color: var(--bg-color);
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: 500;
        }

        .navbar a:hover {
            background: var(--main-color);
            border-radius: 0.2rem;
            transition: 0.2s all linear;
        }

        .home {
            width: 100%;
            min-height: 100vh;
            background: url(bg.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(17rem, auto));
            align-items: center;
            gap: 1.5rem;
        }

        .home-text h1 {
            font-size: 3.4rem;
            color: var(--main-color);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .home-text p {
            font-size: 0.938rem;
            color: var(--bg-color);
            margin: 0.5rem 0 1.4rem;
        }

        .btn {
            padding: 10px 40px;
            border-radius: 003rem;
            background: var(--main-color);
            color: var(--bg-color);
            font-weight: 500;
        }

        .btn:hover {
            background: #8a6f4d;
        }

        .owner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(17rem, auto));
            align-items: center;
            gap: 1.5rem;
        }

        .owner-img img {
            border-radius: 0.5rem;
        }

        .owner-text h2 {
            font-size: 1.8rem;
            text-transform: uppercase;
        }

        .owner-text p {
            font-size: 0.938rem;
            margin: 0.5rem 0.11rem;
        }

        @media screen and (max-width: 1000px) {
            header{
                display: none;
            }
        }
    </style>
</head>

<body>
<header>
    <a href="#" class="logo">
        <img src="logo.jpg" alt="">
    </a>
    <i class="bx bx-menu" id="menu-icon"></i>
    <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#owner">About Us</a></li>
    </ul>
</header>
<section class="home" id="home">
    <div class="home-text">
        <h1>Start Your Day <br>With Coffee <br> By Flower Cafe</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti iste voluptatibus soluta adipisci
            quaerat laboriosam ducimus suscipit harum eum ex quisquam maxime dignissimos sapiente nam quidem, cumque
            doloremque, aspernatur itaque.</p>
        <a href="/dinein/registration" class="btn">Order Now</a>
    </div>
    <div class="home-img">
        <img src="main.jpeg" alt="">
    </div>
</section>
<section class="owner" id="owner">
    <div class="owner-img">
        <img src="owner.jpeg" alt="">
    </div>
    <div class="owner-text">
        <h1>Our Owner</h1>
        <h2>Jisoo Kim</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut molestias deleniti aliquid quas ex eius
            consequatur perferendis eveniet tempora quasi, amet quia consectetur dicta maxime nostrum magni
            voluptatibus eum adipisci?</p>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro voluptatem aliquam officia dicta
            excepturi, a impedit. Hic enim perferendis repellat corporis assumenda, recusandae quo molestias
            deserunt architecto officia doloremque ratione?</p>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore quos nulla quibusdam exercitationem
            et. Consequuntur suscipit, voluptas, hic soluta quo cum molestias ducimus tenetur quam, necessitatibus
            totam dolores consequatur adipisci!</p>
    </div>
</section>

<script src="main.js"></script>
</body>

</html>

