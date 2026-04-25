<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Anthony Farah">
        <meta name="description" content="Anthony J Farah - Home page and introduction to the IT professional portfolio and academic progress site">
        <title>Home - Anthony J Farah</title>
        <link href="farah-scf.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper"> <!-- open wrapper -->

            <?php include("header.php"); ?>

            <?php include 'nav.php'; ?>

            <main>

                <p class="today-date">Today's Date: <?php echo date('m-d-Y'); ?></p>

                <hr>

                <section id="about">

                    <h2>About Me</h2>

                    <!-- PROFILE IMAGE -->
                    <img src="images/profile.jpg"
                         alt="Portrait photo of Anthony Farah"
                         class="profile-img"
                         usemap="#profile-hotspot"
                         aria-describedby="profile-hotspot-tip">

                    <p id="profile-hotspot-tip">Hotspot tip: Click the center area of the profile photo to go to the Contact page.</p>

                    <map name="profile-hotspot">
                        <area shape="circle"
                              coords="90,95,55"
                              href="contact.php"
                              alt="Go to Contact page">
                    </map>

                    <p>
                        My name is <b>Anthony J Farah</b>, and I am currently studying Information Technology at
                        <i>State College of Florida</i>. This website began as a class project, but I am
                        developing it into a professional portfolio that reflects my academic progress and
                        long‑term career goals.<br><br>

                        I am focusing on IT support, programming, networking, and cybersecurity,
                        and I am committed to building a strong foundation that will support a future career
                        in the IT field.
                    </p>

                </section>

                <hr>

                <section id="goals">

                    <h2>Career Goals</h2>

                    <p>
                        Over the next few weeks, this site will expand to include my <b>Resume</b>,
                        <b>Portfolio</b>, <b>Newsletter</b>, and <b>Contact</b> pages. Each section will
                        highlight my skills, projects, and professional development.<br><br>

                        My long‑term goal is to build a resilient IT career that integrates cybersecurity, networking, and strong communication skills into being an IT Professional.
                        I am motivated by the opportunity to contribute to meaningful projects and
                        continuously grow as technology evolves.
                    </p>

                </section>

                <hr>

                <section id="contact">

                    <h2>Contact</h2>

                    <p>
                        <a href="https://www.linkedin.com/in/anthony-farah-a54164153/" target="_blank" rel="noopener noreferrer">
                            <img src="images/linkedin.png" alt="LinkedIn Profile" class="linkedin-icon">
                        </a>
                        Contact Me:<br>
                        Email: <a href="mailto:a.farah2178@yahoo.com">a.farah2178@yahoo.com</a><br>
                        Phone: <a href="tel:+19083283015">+1 (908) 328-3015</a><br>

                        <!-- EXTERNAL LINKS -->
                        LinkedIn:
                        <a href="https://www.linkedin.com/in/anthony-farah-a54164153/" target="_blank" rel="noopener noreferrer">Visit My Profile</a><br>
                        Indeed:
                        <a href="https://profile.indeed.com/?hl=en_US&co=US&from=gnav-fallback" target="_blank" rel="noopener noreferrer">View My Indeed Profile</a><br>

                        <!-- RESUME LINK -->
                        Resume:
                        <a href="resume.php">Resume Page</a>
                    </p>

                </section>

            </main>

            <div id="social"> <!-- open social -->
                Facebook | Twitter | YouTube
            </div> <!-- close social -->

            <?php include("footer.php"); ?>

        </div> <!-- close wrapper -->

    </body>
</html>
