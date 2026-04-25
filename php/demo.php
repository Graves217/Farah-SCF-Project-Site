<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Anthony Farah">
        <meta name="description" content="Anthony J Farah - PHP Dynamic Calculation Demo page showing PHP variables, arithmetic, and date output.">
        <title>PHP Demo - Anthony J Farah</title>
        <link href="farah-scf.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper"> <!-- open wrapper -->

            <?php include("header.php"); ?>

            <?php include 'nav.php'; ?>

            <main>

                <hr>

                <section id="php-demo">

                    <h2>PHP Dynamic Calculation Demo</h2>

                    <p>This page demonstrates how PHP can perform dynamic server-side calculations and output results directly into a web page. The code below runs on the web server before the page is sent to your browser.</p>

                    <hr>

                    <h3>Rectangle Area Calculator</h3>
                    <p>Using two PHP variables to calculate and display the area of a rectangle:</p>

                    <div class="demo-output">
                        <?php
                            $width  = 60;
                            $height = 20;
                            echo "<p><strong>Width:</strong> $width px</p>";
                            echo "<p><strong>Height:</strong> $height px</p>";
                            echo "<p><strong>Area (Width &times; Height):</strong> " . ($width * $height) . " px&sup2;</p>";
                        ?>
                    </div>

                    <hr>

                    <h3>Today's Date</h3>
                    <p>PHP can also output dynamic information such as the current date from the server:</p>

                    <div class="demo-output">
                        <?php
                            echo "<p><strong>Today's Date:</strong> " . date("m-d-Y") . "</p>";
                        ?>
                    </div>

                    <hr>

                    <h3>How It Works</h3>
                    <p>The PHP source code that generates the output above looks like this:</p>

                    <pre class="demo-code"><code>&lt;?php
    $width  = 60;
    $height = 20;
    echo "Width: $width px";
    echo "Height: $height px";
    echo "Area: " . ($width * $height) . " px²";
?&gt;

&lt;?php
    echo "Today's Date: " . date("m-d-Y");
?&gt;</code></pre>

                    <p><em>Note: When you view the page source in your browser you will see only the resulting HTML output, not the PHP code — the web server processes PHP before sending the page.</em></p>

                </section>

            </main>

            <div id="social"> <!-- open social -->
                Facebook | Twitter | YouTube
            </div> <!-- close social -->

            <?php include("footer.php"); ?>

        </div> <!-- close wrapper -->

    </body>
</html>
