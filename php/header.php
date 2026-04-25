            <header>
                <h1>Welcome to My Portfolio</h1>

                <!-- LOGO IMAGE MAP – Hotspot 1 (left half) links to Media page (Rubric #5);
                     Hotspot 2 (right half) links to #contact section on this page -->
                <img src="images/banner.jpg"
                     usemap="#logo-map"
                     alt="Site Logo – click the left half for Media page, right half for Contact section"
                     title="Site Logo"
                     width="300"
                     height="100">

                <map name="logo-map">
                    <!-- Hotspot 1: left half → Media page -->
                    <area shape="rect"
                          coords="0,0,150,100"
                          href="media.php"
                          alt="Go to Media Page"
                          title="Go to Media Page">
                    <!-- Hotspot 2: right half → Contact section on this page -->
                    <area shape="rect"
                          coords="150,0,300,100"
                          href="contact.php#contact"
                          alt="Go to Contact section"
                          title="Go to Contact section">
                </map>
            </header>
