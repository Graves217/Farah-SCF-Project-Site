(function () {
    'use strict';

    var WIRED_HOME   = 'https://www.wired.com/';
    var FEED_URL     = 'https://www.wired.com/feed/rss';
    var MAX_ITEMS    = 8;
    var MAX_DESC_LEN = 160;

    // CORS-friendly proxy – no API key required
    var PROXY_URL = 'https://api.allorigins.win/raw?url=' + encodeURIComponent(FEED_URL);

    var embedWrap = document.getElementById('wired-embed');
    var iframe    = document.getElementById('wired-iframe');
    var fallback  = document.getElementById('rss-fallback');

    /* ---- helper: strip HTML tags from a string ---- */
    function stripHtml(html) {
        try {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body ? (doc.body.textContent || '') : '';
        } catch (e) {
            return '';
        }
    }

    /* ---- helper: format a date string ---- */
    function formatDate(dateStr) {
        var d = new Date(dateStr);
        if (isNaN(d.getTime())) { return ''; }
        return d.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
    }

    /* ---- show the RSS fallback panel ---- */
    function showFallback(message) {
        if (embedWrap) { embedWrap.hidden = true; }
        if (fallback)  { fallback.hidden = false; }

        if (message && fallback) {
            var note = document.createElement('p');
            note.className = 'rss-note';
            note.textContent = message;
            fallback.innerHTML = '';
            fallback.appendChild(note);
        }

        loadRssInto(fallback);
    }

    /* ---- render RSS articles into a container ---- */
    function loadRssInto(container) {
        if (!container) { return; }

        fetch(PROXY_URL, { cache: 'no-store' })
            .then(function (response) {
                if (!response.ok) { throw new Error('Network error ' + response.status); }
                return response.text();
            })
            .then(function (xmlText) {
                var xml = new DOMParser().parseFromString(xmlText, 'text/xml');

                if (xml.getElementsByTagName('parsererror').length) {
                    throw new Error('RSS parse error');
                }

                var items = Array.prototype.slice.call(xml.getElementsByTagName('item'), 0, MAX_ITEMS);
                if (!items.length) { throw new Error('No RSS items found'); }

                var list = document.createElement('ul');
                list.className = 'rss-list';

                items.forEach(function (item) {
                    var titleEl = item.getElementsByTagName('title')[0];
                    var linkEl  = item.getElementsByTagName('link')[0];
                    var dateEl  = item.getElementsByTagName('pubDate')[0];
                    var descEl  = item.getElementsByTagName('description')[0];

                    var title = titleEl ? titleEl.textContent.trim() : '(no title)';
                    var link  = linkEl  ? linkEl.textContent.trim()  : FEED_URL;
                    var date  = dateEl  ? formatDate(dateEl.textContent.trim()) : '';
                    var desc  = descEl  ? stripHtml(descEl.textContent || '').trim() : '';

                    var li = document.createElement('li');
                    li.className = 'rss-item';

                    var a = document.createElement('a');
                    a.className = 'rss-item__title';
                    a.href = link;
                    a.target = '_blank';
                    a.rel = 'noopener noreferrer';
                    a.textContent = title;
                    li.appendChild(a);

                    if (date) {
                        var span = document.createElement('span');
                        span.className = 'rss-item__date';
                        span.textContent = date;
                        li.appendChild(span);
                    }

                    if (desc) {
                        var p = document.createElement('p');
                        p.className = 'rss-item__desc';
                        p.textContent = desc.length > MAX_DESC_LEN
                            ? desc.substring(0, MAX_DESC_LEN) + '\u2026'
                            : desc;
                        li.appendChild(p);
                    }

                    list.appendChild(li);
                });

                // Clear any loading/note message and insert the list
                container.innerHTML = '';
                container.appendChild(list);

                var cite = document.createElement('p');
                cite.className = 'rss-citation';
                cite.innerHTML =
                    'Source: <a href="' + FEED_URL + '" target="_blank" rel="noopener noreferrer">WIRED RSS</a>' +
                    ' &middot; <a href="' + WIRED_HOME + '" target="_blank" rel="noopener noreferrer">WIRED Home</a>';
                container.appendChild(cite);
            })
            .catch(function () {
                container.innerHTML = '';
                var p = document.createElement('p');
                p.className = 'rss-error';
                p.textContent = 'Unable to load WIRED right now. ';
                var a = document.createElement('a');
                a.href = WIRED_HOME;
                a.target = '_blank';
                a.rel = 'noopener noreferrer';
                a.textContent = 'Visit WIRED';
                p.appendChild(a);
                p.appendChild(document.createTextNode('.'));
                container.appendChild(p);
            });
    }

    /* ---- Iframe embed with automatic fallback ----
     *
     * Many news sites (including WIRED) set X-Frame-Options or CSP
     * frame-ancestors headers that prevent iframe embedding.  We cannot
     * read those headers from JavaScript, so we use two heuristics:
     *
     *   1. If the iframe fires an 'error' event, fall back immediately.
     *   2. After a short timeout, check the rendered height of the iframe.
     *      A blocked/empty iframe typically collapses to 0 px; if the
     *      height is below a reasonable threshold we assume it was blocked
     *      and switch to the RSS list.
     *
     * Cross-origin restrictions prevent us from reading iframe contents
     * even when it loads successfully, so we cannot distinguish "loaded
     * but blocked by X-Frame-Options" from "loaded fine" by inspecting
     * contentDocument – only the height heuristic works reliably.
     */
    if (!iframe || !fallback) {
        // Fallback markup missing – just load RSS directly into the outer container
        var outer = document.getElementById('rss-feed-container');
        if (outer) { loadRssInto(outer); }
        return;
    }

    // Minimum iframe height (px) that indicates the embed is actually rendering.
    // A blocked or empty iframe typically collapses to 0 px; anything below this
    // threshold is treated as a failed embed and triggers the RSS fallback.
    var MIN_IFRAME_HEIGHT = 80;
    var fallbackTriggered = false;

    function triggerFallback(reason) {
        if (fallbackTriggered) { return; }
        fallbackTriggered = true;
        showFallback(reason);
    }

    // Heuristic 1: immediate error event
    iframe.addEventListener('error', function () {
        triggerFallback(
            'The WIRED homepage couldn\u2019t be embedded here (blocked by browser security). ' +
            'Showing the latest articles from the WIRED RSS feed instead.'
        );
    });

    // Heuristic 2: timeout + rendered-height check
    // Give the iframe 3 seconds to render something visible.
    setTimeout(function () {
        if (fallbackTriggered) { return; }
        var rect = iframe.getBoundingClientRect();
        if (rect.height < MIN_IFRAME_HEIGHT) {
            triggerFallback(
                'The WIRED homepage embed wasn\u2019t available (frame blocked). ' +
                'Showing the latest articles from the WIRED RSS feed instead.'
            );
        }
        // If the iframe rendered with a reasonable height, leave it visible.
    }, 3000);
}());

