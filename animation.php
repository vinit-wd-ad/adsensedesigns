<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Canvas + Text Scroll Animation</title>

        <style>
            body {
                margin: 0;
                height: 600vh; /* long scroll area */
                background: #f2ece6;
                overflow-x: hidden;
                font-family: Arial, sans-serif;
            }
           #hero-section {
                height: 500vh; /* animation scroll area */
                position: relative;
            }

            #hero-container {
                position: sticky;
                top: 0;
                height: 100vh;
                width: 100%;
            }

            /* TEXT BACKGROUND */
            #text-wrapper {
                position: absolute;  /* NOT fixed */
                top: 0;
                left: 6vw;
                width: 90%;
            }

            .title1, .title2 {
                font-size: 7vw;
                font-weight: 700;
                color: #000;
            }

            .title2{
                position: absolute;
                right: 10px;
                top: 40vh;
            }

            .title1 .word:nth-of-type(3), .title2 .word:nth-of-type(2) {
                color: #ff5600;
            }


            /* Letters initially faint */
            .title1 span.letter, .title2 span.letter {
                display: inline-block;
                opacity: 0.15;
                transition: opacity 0.2s linear;
            }

            /* CANVAS FOREGROUND */
            
            #canvas {
                position: absolute; 
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
            .industries-section {
                width: 90%;
                /*max-width: 1500px;*/
                margin: 150px auto;
                font-family: "Inter", sans-serif;
                color: #000;
            }

            .section-label {
                font-size: 14px;
                font-weight: 600;
                display: inline-block;
                padding: 6px 14px;
                border: 1px solid #000;
                border-radius: 20px;
                background: #fff;
                margin-bottom: 40px;
            }

            .industry-box {
                display: flex;
                align-items: top;
                margin: 50px 0 20px;
                gap: 20px;
            }

            .industry-title {
                font-size: 4vw;
                font-weight: 600;
                margin: 0;
            }

            .product-count {
                font-size: 14px;
                font-weight: 600;
                letter-spacing: 1px;
                color: rgb(48, 47, 47);
                opacity: 0;
                transition: opacity 0.3s ease;
                overflow: hidden;
            }
            
            .industry-box:hover .product-count {
                opacity: 1;
            }


            .industries-section .industry-box:nth-of-type(1):hover .industry-title { color: #1a28d8; }
            .industries-section .industry-box:nth-of-type(2):hover .industry-title { color: #ff5600; } 
            .industries-section .industry-box:nth-of-type(3):hover .industry-title { color: #0f6a3d; } 
            .industries-section .industry-box:nth-of-type(4):hover .industry-title { color: #b80059; } 
            .industries-section .industry-box:nth-of-type(5):hover .industry-title { color: #ffcc00; } 
            .industries-section .industry-box:nth-of-type(6):hover .industry-title { color: #6a0dad; } 
            .industries-section .industry-box:nth-of-type(7):hover .industry-title { color: #00aaff; } 
            .industries-section .industry-box:nth-of-type(8):hover .industry-title { color: #ff4500; }  
            .industries-section .industry-box:nth-of-type(9):hover .industry-title { color: #55f943; }  

            .blue { color: #1a28d8; }
            .green { color: #0f6a3d; }
            .black { color: #000; }

            hr {
                border: none;
                border-top: 1px solid #cfcfcf;
            }

        </style>
    </head>
    <body>
        <section id="hero-section">

            <div id="hero-container">
                <div id="text-wrapper">
                    <h1 class="title1">
                        <span class="word">We&ensp;are</span><br>
                        <span class="word">adding</span><br>
                        <span class="word">SENSE</span><br>
                    </h1>
                    <h1 class="title2">
                        <span class="word">To &ensp;your</span><br>
                        <span class="word">BRAND</span>
                    </h1>
                </div>

                <canvas id="canvas"></canvas>
            </div>

        </section>

        <section class="industries-section">

            <div class="section-label">OUR SERVICES</div>

            <div class="industry-box">
                <h2 class="industry-title black">Graphics Design</h2>
                <p class="product-count ">23 Projects</p>
            </div>
            <hr>

            <div class="industry-box">
                <h2 class="industry-title black">Motion Graphics</h2>
                <p class="product-count ">23 Projects</p>
            </div>
            <hr>

            <div class="industry-box">
                <h2 class="industry-title black">Digital Marketing</h2>
                <p class="product-count ">23 Projects</p>
            </div>
            <hr>

            <!--<div class="industry-box">-->
            <!--    <h2 class="industry-title black">Marketing Solutions</h2>-->
            <!--    <p class="product-count ">23 Projects</p>-->
            <!--</div>-->
            <!--<hr>-->

            <!--<div class="industry-box">-->
            <!--    <h2 class="industry-title black">Exhibitions</h2>-->
            <!--    <p class="product-count ">23 Projects</p>-->
            <!--</div>-->
            <!--<hr>-->

            <!--<div class="industry-box">-->
            <!--    <h2 class="industry-title black">Corporate Gifting</h2>-->
            <!--    <p class="product-count ">23 Projects</p>-->
            <!--</div>-->
            <!--<hr>-->

            <!--<div class="industry-box">-->
            <!--    <h2 class="industry-title black">Print Solutions</h2>-->
            <!--    <p class="product-count ">23 Projects</p>-->
            <!--</div>-->
            <!--<hr>-->

            <!--<div class="industry-box">-->
            <!--    <h2 class="industry-title black">Corporate Gifting</h2>-->
            <!--    <p class="product-count ">23 Projects</p>-->
            <!--</div>-->

        </section>

    <script>

        /* ---------------------------------------- */
        /* TEXT LETTER SPLITTING & SCROLL FADE-IN  */
        /* ---------------------------------------- */

        const words = document.querySelectorAll(".word");

        words.forEach(word => {
            let html = "";
            [...word.textContent].forEach(letter => {
                html += `<span class="letter">${letter}</span>`;
            });
            word.innerHTML = html;
        });

        const letters = document.querySelectorAll(".letter");

        function syncText(progress) {
            const total = letters.length;
            const visible = Math.floor(progress * total);

            letters.forEach((letter, i) => {
                letter.style.opacity = i <= visible ? 1 : 0.15;
            });
        }



        /* ---------------------------------------- */
        /* CANVAS SCROLL-FRAME ANIMATION           */
        /* ---------------------------------------- */

        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Image sequence
        const baseURL = "https://relats.com/wp-content/uploads/canvas/medium/";
        const totalFrames = 323;
        const frameImages = [];

        function frameSrc(n) {
            return baseURL + String(n).padStart(3, "0") + ".png";
        }

        // Preload frames
        for (let i = 0; i <= totalFrames; i++) {
            const img = new Image();
            img.src = frameSrc(i);
            frameImages[i] = img;
        }

        let currentFrame = 0;

        function drawFrame(i) {
            const img = frameImages[i];
            if (!img.complete) {
                img.onload = () => drawFrame(i);
                return;
            }

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Fit image to canvas
            const scale = Math.min(
                canvas.width / img.width,
                canvas.height / img.height
            );

            const w = img.width * scale;
            const h = img.height * scale;

            const x = (canvas.width - w) / 2;
            const y = (canvas.height - h) / 2;

            ctx.drawImage(img, x, y, w, h);
        }

        // Scroll binding
        window.addEventListener("scroll", () => {
            const hero = document.getElementById("hero-section");
            const maxScroll = hero.offsetHeight - window.innerHeight;
            const progress = Math.min(1, window.scrollY / maxScroll);

            const index = Math.floor(progress * totalFrames);

            if(index !== currentFrame){
                currentFrame = index;
                drawFrame(index);
            }

            syncText(progress);
        });


        // Load first frame
        frameImages[0].onload = () => drawFrame(0);

        // Resize canvas
        window.addEventListener("resize", () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            drawFrame(currentFrame);
        });

    </script>

    </body>
</html>
