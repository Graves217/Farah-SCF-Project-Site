<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Anthony Farah">
        <meta name="description" content="Anthony J Farah - JavaScript Assignment: 8 JavaScript techniques demonstrated on a single page">
        <title>JavaScript - Anthony J Farah</title>
        <link href="farah-scf.css" rel="stylesheet" type="text/css">
        <style>
            /* Styles specific to the JavaScript demonstration page */
            .js-section {
                margin: 1.2em 0 0.5em 0;
                padding: 1em 1.2em;
                border: 1px solid #ccc;
                border-radius: 4px;
                background: #f9f9f9;
            }

            .js-section h3 {
                color: #002147;
                margin-top: 0;
                margin-bottom: 0.5em;
            }

            /* Image rotator (Item #6) */
            #rotatorImg {
                max-width: 420px;
                width: 100%;
                transition: opacity 0.5s ease;
                display: block;
                margin: 0.5em 0;
            }

            /* Slideshow container (Item #7) */
            #slideshowContainer {
                max-width: 420px;
            }

            #slideshowContainer img {
                width: 100%;
                display: block;
                margin-bottom: 0.4em;
            }

            .slideshow-btn {
                background: #002147;
                color: #fff;
                border: none;
                padding: 0.4em 1.1em;
                cursor: pointer;
                margin-right: 0.5em;
                border-radius: 3px;
                font-size: 0.95em;
            }

            .slideshow-btn:hover {
                background: #0066cc;
            }

            /* Calculation form (Item #5) */
            .calc-form label {
                display: inline-block;
                width: 180px;
                margin: 0.3em 0;
            }

            .calc-form input[type="number"] {
                width: 110px;
                padding: 0.2em 0.4em;
            }

            #buildResult {
                margin-top: 0.8em;
                color: #002147;
            }

            /* General JS demo button style */
            .js-btn {
                background: #002147;
                color: #fff;
                border: none;
                padding: 0.5em 1.3em;
                cursor: pointer;
                border-radius: 3px;
                font-size: 0.95em;
            }

            .js-btn:hover {
                background: #0066cc;
            }

            #promptResult {
                margin-top: 0.8em;
                color: #002147;
            }

            /* Ordered list spacing */
            #js-assignment > ol {
                padding-left: 1.4em;
            }

            #js-assignment > ol > li {
                margin-bottom: 0.6em;
            }
        </style>
    </head>

    <body>

        <div id="wrapper"> <!-- open wrapper -->

            <?php include("header.php"); ?>

            <?php include 'nav.php'; ?>

            <main>

                <hr>

                <section id="js-assignment">

                    <h2>JavaScript Assignment</h2>
                    <p>The following ordered list demonstrates 8 unique JavaScript techniques as part of the SCF Web Development course assignment. Each numbered item corresponds to a rubric requirement.</p>

                    <ol>

                        <!-- ============================================================
                             Item 1: Mouseover Hover Alert
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>Mouseover Hover Alert</h3>
                                <p>Hover over (or tab to and press Enter / focus) the link below to
                                   trigger a one-time JavaScript alert about this portfolio. The alert
                                   fires only once per page load so it does not repeat on minor mouse
                                   movements. Keyboard users can reach it with <kbd>Tab</kbd>.</p>

                                <script type="text/javascript">
                                /* Item #1 – Mouseover / Focus Hover Alert
                                 * One-time guard: hoverAlertShown prevents the alert from firing
                                 * repeatedly when the mouse moves across the element.
                                 * onfocus provides equivalent keyboard / accessibility access. */
                                var hoverAlertShown = false;
                                function showHoverAlert() {
                                    if (hoverAlertShown) { return; }
                                    hoverAlertShown = true;
                                    alert(
                                        "Welcome to Anthony Farah\u2019s IT Portfolio!\n\n" +
                                        "This site showcases custom PC builds, desk setups, " +
                                        "and IT projects developed during studies at " +
                                        "State College of Florida.\n\n" +
                                        "Use the navigation links at the top to explore each section."
                                    );
                                }
                                </script>

                                <a href="#"
                                   onmouseover="showHoverAlert()"
                                   onfocus="showHoverAlert()"
                                   aria-label="Hover or focus here to learn about this portfolio site">
                                    Hover (or focus) here to learn about this site
                                </a>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 2: Alert Button
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>Alert Button</h3>
                                <p>Click the button below to display a JavaScript alert summarizing
                                   Anthony Farah&#8217;s IT portfolio focus areas.</p>
                                <!-- Using <button type="button"> is the semantic choice for JS-only actions
                                     (no form submission); it is also more accessible than <input type="button"> -->
                                <button type="button" class="js-btn"
                                    onclick="alert('Anthony J. Farah\nIT Student \u2014 State College of Florida\n\nPortfolio highlights:\n\u2022 Custom PC Builds \u0026 Desk Setups\n\u2022 Networking \u0026 Cybersecurity\n\u2022 Web Development Projects\n\nNavigate to the Portfolio page for the full showcase!');">
                                    About This Portfolio
                                </button>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 3: Prompt + Display Answer
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>Prompt &#8211; Your IT Interest</h3>
                                <p>Click the button to answer a question. Your response will be displayed on this page.</p>
                                <button type="button" class="js-btn" onclick="askITFocus()">What&#8217;s Your IT Interest?</button>
                                <div id="promptResult"></div>

                                <script type="text/javascript">
                                /* Item #3 – Prompt + Display Answer
                                 * Asks the visitor about their IT interest and displays a personalized
                                 * response. User-supplied text is inserted via textContent (not
                                 * innerHTML) to prevent any raw HTML from the input from rendering,
                                 * which eliminates the risk of script/HTML injection. */
                                function askITFocus() {
                                    var techArea = prompt(
                                        "What area of IT are you most interested in?\n" +
                                        "(e.g., Networking, Cybersecurity, Programming, Cloud Computing)",
                                        ""
                                    );
                                    var resultDiv = document.getElementById("promptResult");
                                    if (techArea && techArea.trim() !== "") {
                                        /* Build the response safely: set the user's text via
                                         * textContent so special characters cannot be treated as HTML. */
                                        var chosen = document.createElement("strong");
                                        chosen.textContent = "You chose: " + techArea;

                                        var link = document.createElement("a");
                                        link.href = "portfolio.php";
                                        link.textContent = "Portfolio page";

                                        var para = document.createElement("p");
                                        para.appendChild(chosen);
                                        para.appendChild(document.createElement("br"));

                                        var suffix = document.createTextNode(
                                            "Anthony Farah is also focusing on IT at State College of Florida. " +
                                            "Browse the "
                                        );
                                        var suffix2 = document.createTextNode(" to see related projects!");

                                        para.appendChild(suffix);
                                        para.appendChild(link);
                                        para.appendChild(suffix2);

                                        resultDiv.innerHTML = "";
                                        resultDiv.appendChild(para);
                                    } else {
                                        var link2 = document.createElement("a");
                                        link2.href = "portfolio.php";
                                        link2.textContent = "explore the portfolio";

                                        var para2 = document.createElement("p");
                                        para2.appendChild(
                                            document.createTextNode("No answer entered \u2014 no problem! Feel free to ")
                                        );
                                        para2.appendChild(link2);
                                        para2.appendChild(document.createTextNode(" at your own pace."));

                                        resultDiv.innerHTML = "";
                                        resultDiv.appendChild(para2);
                                    }
                                }
                                </script>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 4: document.write Last Updated
                             (Also added to index.html and portfolio.htm per rubric)
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>Last Updated &#8211; document.write</h3>
                                <p>A <code>document.write</code> last-modified statement has been added to the bottom of the
                                   <a href="index.php">Home page</a> and the <a href="portfolio.php">Portfolio page</a>
                                   with a smaller font size. The date below reflects <em>this</em> page&#8217;s last modification:</p>

                                <script type="text/javascript">
                                /* Item #4 – document.write Last Updated
                                 * Reads document.lastModified and writes a smaller-font date stamp.
                                 * The "last-updated" CSS class (defined in farah-scf.css) keeps
                                 * the styling consistent across index.html, portfolio.htm and this page. */
                                var lastMod  = new Date(document.lastModified);
                                var modMonth = lastMod.getMonth() + 1;
                                var modDate  = lastMod.getDate();
                                var modYear  = lastMod.getFullYear();
                                document.write(
                                    "<p class='last-updated'>Last Updated: " +
                                    modMonth + "/" + modDate + "/" + modYear +
                                    "</p>"
                                );
                                </script>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 5: PC Build Budget Calculator Form
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>PC Build Budget Calculator</h3>
                                <p>Enter a budget for each component to estimate your custom PC build cost &#8212; inspired by the builds showcased in the <a href="portfolio.php">Portfolio</a>.</p>

                                <form class="calc-form" onsubmit="return false;">
                                    <label for="cpu">CPU ($):</label>
                                    <input type="number" id="cpu" value="0" min="0"><br>
                                    <label for="gpu">GPU ($):</label>
                                    <input type="number" id="gpu" value="0" min="0"><br>
                                    <label for="mobo">Motherboard ($):</label>
                                    <input type="number" id="mobo" value="0" min="0"><br>
                                    <label for="ram">RAM ($):</label>
                                    <input type="number" id="ram" value="0" min="0"><br>
                                    <label for="storage">Storage ($):</label>
                                    <input type="number" id="storage" value="0" min="0"><br>
                                    <label for="cooling">Cooling ($):</label>
                                    <input type="number" id="cooling" value="0" min="0"><br>
                                    <label for="psu">PSU ($):</label>
                                    <input type="number" id="psu" value="0" min="0"><br>
                                    <label for="pccase">Case &amp; Fans ($):</label>
                                    <input type="number" id="pccase" value="0" min="0"><br><br>
                                    <input type="button" class="js-btn" value="Calculate Build Cost" onclick="calculateBuildCost()">
                                    <input type="reset" class="js-btn" value="Reset" style="margin-left:0.5em;">
                                </form>

                                <div id="buildResult"></div>

                                <script type="text/javascript">
                                /* Item #5 – PC Build Budget Calculator
                                 * Sums user-entered component costs, shows total and GPU-to-total
                                 * percentage, and adds a tier label (budget / mid / high-end).
                                 * Input validation: rejects negative values and non-numeric entries
                                 * with a clear, user-friendly inline message. */
                                function calculateBuildCost() {
                                    var fields = ["cpu","gpu","mobo","ram","storage","cooling","psu","pccase"];
                                    var values = {};
                                    var hasError = false;

                                    for (var i = 0; i < fields.length; i++) {
                                        var raw = parseFloat(document.getElementById(fields[i]).value);
                                        if (isNaN(raw) || raw < 0) {
                                            hasError = true;
                                            break;
                                        }
                                        values[fields[i]] = raw;
                                    }

                                    var resultDiv = document.getElementById("buildResult");

                                    if (hasError) {
                                        resultDiv.innerHTML =
                                            "<p style='color:#cc0000;'>" +
                                            "<strong>Please enter valid numbers (0 or greater) " +
                                            "for all fields before calculating.</strong></p>";
                                        return;
                                    }

                                    var total = 0;
                                    for (var j = 0; j < fields.length; j++) {
                                        total += values[fields[j]];
                                    }

                                    if (total === 0) {
                                        resultDiv.innerHTML =
                                            "<p style='color:#555;'>Enter component costs above, " +
                                            "then click <em>Calculate Build Cost</em>.</p>";
                                        return;
                                    }

                                    var gpuPct = ((values["gpu"] / total) * 100).toFixed(1);

                                    var tier = "";
                                    if      (total > 3000) { tier = "High-performance build territory!"; }
                                    else if (total > 1500) { tier = "Solid mid-to-high-end build!"; }
                                    else                   { tier = "Budget-friendly build!"; }

                                    resultDiv.innerHTML =
                                        "<p><strong>Estimated Total Build Cost: $" + total.toFixed(2) + "</strong><br>" +
                                        "GPU spend: " + gpuPct + "% of total budget<br>" +
                                        "<em>" + tier + "</em>" +
                                        "</p>";
                                }
                                </script>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 6: Internal JS Image Rotator (Special Effect)
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>Image Rotator (Internal JavaScript Special Effect)</h3>
                                <p>The image below automatically rotates through portfolio photos every 3 seconds using an internal JavaScript routine with a CSS opacity fade transition.</p>

                                <img id="rotatorImg" src="images/My_PC_Build.JPEG" alt="My Custom PC Build">
                                <p id="rotatorCaption" style="font-style:italic; color:#555;"><strong>My Custom PC Build</strong></p>

                                <script type="text/javascript">
                                /* Item #6 – Internal Image Rotator with Fade Effect
                                 * Source: Adapted by Anthony Farah from general setInterval-based
                                 *   image-rotator patterns commonly documented on MDN Web Docs
                                 *   (developer.mozilla.org/en-US/docs/Web/API/setInterval) and
                                 *   general JavaScript tutorials.  The fade transition, caption
                                 *   update logic, and all images are original to this portfolio.
                                 * What it does: Preloads all portfolio images on page load, then
                                 *   calls setInterval every 3 000 ms to swap #rotatorImg through
                                 *   the array with a CSS opacity cross-fade effect.
                                 * Images are from Anthony Farah's personal IT portfolio projects. */

                                var rotatorImages = [
                                    { src: "images/My_PC_Build.JPEG",    caption: "My Custom PC Build"           },
                                    { src: "images/WIFE_PC_BUILD.jpg",   caption: "Alison\u2019s Custom PC Build"     },
                                    { src: "images/Wife_Desk_Setup.jpg", caption: "Alison\u2019s Custom Desk Setup"   },
                                    { src: "images/Jake_Desk_Setup.jpg", caption: "Jake V.\u2019s Home Desk Setup"    },
                                    { src: "images/DUMAOS.jpg",          caption: "DumaOS Network Management"    },
                                    { src: "images/SCFenter.jpg",        caption: "State College of Florida"     }
                                ];
                                var currentRotatorIndex = 0;

                                /* Preload all rotator images so swaps are instant with no flicker */
                                (function preloadRotatorImages() {
                                    for (var p = 0; p < rotatorImages.length; p++) {
                                        var pre = new Image();
                                        pre.src = rotatorImages[p].src;
                                    }
                                }());

                                function rotatePortfolioImage() {
                                    var img = document.getElementById("rotatorImg");
                                    var cap = document.getElementById("rotatorCaption");
                                    if (!img || !cap) { return; }

                                    img.style.opacity = "0";            /* begin fade-out */

                                    setTimeout(function () {
                                        currentRotatorIndex =
                                            (currentRotatorIndex + 1) % rotatorImages.length;
                                        img.src = rotatorImages[currentRotatorIndex].src;
                                        img.alt = rotatorImages[currentRotatorIndex].caption;
                                        /* Use textContent for caption to keep it XSS-safe */
                                        var strong = document.createElement("strong");
                                        strong.textContent = rotatorImages[currentRotatorIndex].caption;
                                        cap.innerHTML = "";
                                        cap.appendChild(strong);
                                        img.style.opacity = "1";        /* fade-in */
                                    }, 500);
                                }

                                setInterval(rotatePortfolioImage, 3000);
                                </script>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 7: External JS Slideshow
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>Image Slideshow (External JavaScript)</h3>
                                <p>The slideshow below is driven by an external JavaScript file
                                   (<code>scripts/slideshow.js</code>). Use the Prev / Next buttons
                                   to navigate through portfolio images.</p>

                                <div id="slideshowContainer">
                                    <img id="slideshowImg" src="images/My_PC_Build.JPEG" alt="My Custom PC Build">
                                    <p id="slideshowCaption" style="font-style:italic; color:#555;">
                                        <strong>My Custom PC Build</strong>
                                    </p>
                                    <button class="slideshow-btn" onclick="slideshowPrev()">&#10094; Prev</button>
                                    <button class="slideshow-btn" onclick="slideshowNext()">Next &#10095;</button>
                                </div>
                            </div>
                        </li>

                        <!-- ============================================================
                             Item 8: JavaScript Pop-Up Window
                             ============================================================ -->
                        <li>
                            <div class="js-section">
                                <h3>JavaScript Pop-Up Window</h3>
                                <p>Click the button below to open a JavaScript-controlled pop-up window
                                   (sized and positioned via <code>window.open()</code>) showing site
                                   contact information. <em>Note: your browser may require pop-up permissions.</em></p>
                                <button type="button" class="js-btn" onclick="openSiteInfoPopup()">Open Site Info Pop-Up</button>

                                <!-- Fallback shown inline when the pop-up is blocked (no disruptive alert) -->
                                <p id="popupFallback" style="display:none; color:#cc0000; margin-top:0.6em;">
                                    <strong>Pop-up blocked.</strong> Please allow pop-ups for this site and
                                    click the button again, or view the
                                    <a href="contact.php">Contact page</a> for site details.
                                </p>

                                <script type="text/javascript">
                                /* Item #8 – JavaScript Pop-Up Window
                                 * Opens via a user click (button onclick) to avoid browser pop-up blockers.
                                 * Uses window.open() with explicit height, width, left, and top parameters
                                 * to create a sized pop-up — NOT a regular navigation link.
                                 * If the pop-up is blocked, an inline fallback message is revealed on
                                 * the page instead of triggering a secondary (also-blockable) alert. */
                                function openSiteInfoPopup() {
                                    var popup = window.open(
                                        "",
                                        "siteInfoPopup",
                                        "height=420,width=560,left=200,top=100," +
                                        "resizable=yes,scrollbars=yes,toolbar=no,menubar=no"
                                    );
                                    if (!popup || popup.closed || typeof popup.closed === "undefined") {
                                        /* Pop-up was blocked — show inline fallback, no secondary alert */
                                        document.getElementById("popupFallback").style.display = "block";
                                        return;
                                    }
                                    /* Hide the fallback in case it was shown from a previous attempt */
                                    document.getElementById("popupFallback").style.display = "none";

                                    popup.document.write("<!DOCTYPE html><html lang=\"en\"><head>");
                                    popup.document.write("<meta charset=\"UTF-8\">");
                                    popup.document.write("<title>Anthony Farah \u2013 Site Info</title>");
                                    popup.document.write("<style>");
                                    popup.document.write(
                                        "body{font-family:Arial,sans-serif;padding:24px;" +
                                        "background:#002147;color:#ffffff;margin:0;}"
                                    );
                                    popup.document.write(
                                        "h2{color:#ffffff;border-bottom:2px solid #0066cc;" +
                                        "padding-bottom:8px;}"
                                    );
                                    popup.document.write("a{color:#66aaff;}");
                                    popup.document.write("ul{line-height:1.9;}");
                                    popup.document.write(
                                        ".close-btn{background:#0066cc;color:#fff;border:none;" +
                                        "padding:8px 20px;cursor:pointer;border-radius:4px;" +
                                        "font-size:1em;margin-top:16px;}"
                                    );
                                    popup.document.write(".close-btn:hover{background:#004499;}");
                                    popup.document.write("</style></head><body>");
                                    popup.document.write("<h2>Anthony J. Farah</h2>");
                                    popup.document.write(
                                        "<p><strong>IT Student &ndash; State College of Florida</strong></p>"
                                    );
                                    popup.document.write("<ul>");
                                    popup.document.write(
                                        "<li>Email: <a href=\"mailto:a.farah2178@yahoo.com\">" +
                                        "a.farah2178@yahoo.com</a></li>"
                                    );
                                    popup.document.write(
                                        "<li>Phone: <a href=\"tel:+19083283015\" style=\"color:#66aaff;\">" +
                                        "+1 (908) 328-3015</a></li>"
                                    );
                                    popup.document.write(
                                        "<li>Focus Areas: Networking, Cybersecurity &amp; Programming</li>"
                                    );
                                    popup.document.write(
                                        "<li>LinkedIn: <a href=\"https://www.linkedin.com/in/" +
                                        "anthony-farah-a54164153/\" target=\"_blank\">View Profile</a></li>"
                                    );
                                    popup.document.write("</ul>");
                                    popup.document.write(
                                        "<button class=\"close-btn\" onclick=\"window.close()\">" +
                                        "Close Window</button>"
                                    );
                                    popup.document.write("</body></html>");
                                    popup.document.close();
                                }
                                </script>
                            </div>
                        </li>

                    </ol>

                </section>

            </main>

            <div id="social"> <!-- open social -->
                Facebook | Twitter | YouTube
            </div> <!-- close social -->

            <?php include("footer.php"); ?>

        </div> <!-- close wrapper -->

        <!-- Item 7: Attach external JavaScript slideshow file -->
        <script src="scripts/slideshow.js" type="text/javascript"></script>

    </body>
</html>
