<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Anthony Farah">
        <meta name="description" content="Anthony J Farah - Media Demo page with planned audio, video, animation, slideshow, YouTube, and layered image examples.">
        <title>Media Demo - Anthony J Farah</title>
        <link href="farah-scf.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper"> <!-- open wrapper -->

            <?php include("header.php"); ?>

            <?php include 'nav.php'; ?>

            <main id="top">

                <hr>

                <section id="media-demo">

                    <h2 class="media-components-title">Media Components</h2>

                    <p>This page scaffolds the required media items for the assignment and will be expanded later with embedded elements.</p>

                    <ol class="media-demo">
                        <li>
                            <strong>Audio</strong>
                            <p class="media-note">A personally-created welcome message recorded as an MP3 audio file.</p>
                            <div class="media-audio">
                                <audio controls preload="metadata">
                                    <source src="media/audio/WebAudioIntro.mp3" type="audio/mpeg">
                                    Your browser does not support the HTML5 audio element.
                                </audio>
                            </div>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li>
                            <strong>Video</strong>
                            <p class="media-note">A personally-created casual welcome to my Website.</p>
                            <div class="media-video">
                                <video controls preload="metadata">
                                    <source src="media/video/WebVideoIntro.mp4" type="video/mp4">
                                    Your browser does not support the HTML5 video element.
                                </video>
                            </div>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li>
                            <strong>Animated GIF</strong>
                            <p class="media-note">This section contains an animated GIF I made for this project.</p>
                            <img class="media-gif" src="media/animatedPPTech.gif" alt="Animated GIF of Anthony Farah becoming One with Technology">
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li>
                            <strong>Slideshow / Carousel</strong>
                            <p class="media-note">A manual image slideshow featuring PC builds and networking equipment, driven by a custom JavaScript carousel.</p>
                            <section class="carousel" data-carousel aria-label="Tech build image slideshow" tabindex="0">
                                <div class="carousel__viewport">
                                    <div class="carousel__slide is-active" data-carousel-slide aria-hidden="false">
                                        <img class="carousel__image" src="images/carousel/AlisonPCBuild.JPEG" alt="PC build with components laid out on a desk before assembly">
                                        <p class="carousel__caption">Hands-on PC building and hardware assembly.</p>
                                    </div>
                                    <div class="carousel__slide" data-carousel-slide aria-hidden="true">
                                        <img class="carousel__image" src="images/carousel/AnthonyPCBuild.JPEG" alt="Custom desktop PC build with the case open showing installed components">
                                        <p class="carousel__caption">Custom desktop PC — every component chosen and installed by hand.</p>
                                    </div>
                                    <div class="carousel__slide" data-carousel-slide aria-hidden="true">
                                        <img class="carousel__image" src="images/carousel/NetSwitch1.JPEG" alt="Network switch with Ethernet cables connected and port indicator lights active">
                                        <p class="carousel__caption">Configuring and cabling network switching equipment.</p>
                                    </div>
                                    <div class="carousel__slide" data-carousel-slide aria-hidden="true">
                                        <img class="carousel__image" src="images/carousel/NetSwitch2.JPEG" alt="Close-up of a network switch showing labeled port connections">
                                        <p class="carousel__caption">Hands-on networking — port management and structured cabling.</p>
                                    </div>
                                </div>
                                <div class="carousel__controls" aria-label="Slideshow controls">
                                    <button type="button" class="carousel__button" data-carousel-prev aria-label="Previous slide">&#8249; Prev</button>
                                    <div class="carousel__dots" data-carousel-dots aria-label="Choose slide"></div>
                                    <button type="button" class="carousel__button" data-carousel-next aria-label="Next slide">Next &#8250;</button>
                                </div>
                            </section>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li>
                            <strong>YouTube</strong>
                            <p class="media-note">An embedded YouTube video uploaded for this project.</p>
                            <div class="video-embed">
                                <iframe
                                    src="https://www.youtube-nocookie.com/embed/0klgLsSxGsU"
                                    title="Anthony Farah – SCF project portfolio video"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen></iframe>
                            </div>
                            <p class="media-citation">Source: <a href="https://www.youtube.com/watch?v=0klgLsSxGsU" target="_blank" rel="noopener noreferrer">https://www.youtube.com/watch?v=0klgLsSxGsU</a></p>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li>
                            <strong>z-index Stacked Images</strong>
                            <p class="media-note">Two PC-build photos stacked in an angled "photo pile" using CSS <code>position</code> and <code>z-index</code> — the front image sits visibly on top of the back image with obvious overlap.</p>
                            <div class="photo-pile" aria-label="Angled photo pile: two stacked PC-build images">
                                <img class="photo-pile__img photo-pile__img--back"
                                     src="images/carousel/AnthonyPCBuild.JPEG"
                                     alt="Anthony's PC build – back layer">
                                <img class="photo-pile__img photo-pile__img--front"
                                     src="images/carousel/AlisonPCBuild.JPEG"
                                     alt="Alison's PC build – front layer">
                            </div>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li>
                            <strong>RSS Feed</strong>
                            <p class="media-note">The WIRED homepage is embedded below. If your browser or the site's security policy blocks the embed, the page automatically falls back to a live list of articles from the WIRED RSS feed.</p>
                            <p class="rss-feed-label">Tech News RSS Feed (Source: WIRED)</p>
                            <!-- RSS Feed Widget – JavaScript embed (Rubric Item #7)
                                 First attempts to embed the WIRED homepage in an iframe.
                                 If the iframe is blocked (X-Frame-Options / CSP frame-ancestors),
                                 falls back to fetching https://www.wired.com/feed/rss via a
                                 CORS-friendly proxy and rendering the article list client-side.
                                 No API key required. Implemented in scripts/media-rss.js. -->
                            <div class="rss-widget-wrap" id="rss-feed-container">

                                <!-- Primary: WIRED homepage iframe embed -->
                                <div class="wired-embed" id="wired-embed">
                                    <iframe
                                        class="wired-embed__iframe"
                                        id="wired-iframe"
                                        src="https://www.wired.com/"
                                        title="WIRED homepage"
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                    <p class="wired-embed__links">
                                        <a href="https://www.wired.com/" target="_blank" rel="noopener noreferrer">Visit WIRED</a>
                                        &middot;
                                        <a href="https://www.wired.com/feed/rss" target="_blank" rel="noopener noreferrer">RSS Feed</a>
                                    </p>
                                </div>

                                <!-- Fallback: live RSS article list (shown if iframe is blocked) -->
                                <div class="rss-fallback" id="rss-fallback" hidden>
                                    <p class="rss-loading">Loading WIRED stories&hellip;</p>
                                </div>

                            </div>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                        <li value="10">
                            <strong>Embedded Social Media</strong>
                            <p class="media-note">A LinkedIn post I created for this project, embedded directly on the page using LinkedIn's official iframe embed.</p>
                            <p class="linkedin-post-label">My LinkedIn post (Anthony Farah)</p>
                            <!-- LinkedIn Post Embed (Rubric Item #10)
                                 Source post: https://www.linkedin.com/posts/anthony-farah-a54164153_im-building-a-web-portfolio-for-one-of-my-share-7453686700272201728-Egxw
                                 Embed URL uses LinkedIn's official embed endpoint:
                                 https://www.linkedin.com/embed/feed/update/urn:li:share:<share-id> -->
                            <div class="linkedin-embed-wrap">
                                <iframe
                                    class="linkedin-embed-iframe"
                                    src="https://www.linkedin.com/embed/feed/update/urn:li:share:7453686700272201728"
                                    allowfullscreen=""
                                    title="LinkedIn post by Anthony Farah">
                                </iframe>
                            </div>
                            <p><a class="back-to-top" href="#top">Back to top</a></p>
                        </li>
                    </ol>

                </section>

            </main>

            <div id="social"> <!-- open social -->
                Facebook | Twitter | YouTube
            </div> <!-- close social -->

            <?php include("footer.php"); ?>

        </div> <!-- close wrapper -->

        <script src="media-carousel.js"></script>
        <script src="scripts/media-rss.js"></script>

    </body>
</html>
