(function () {
    'use strict';

    var FEED_URL     = 'https://www.wired.com/feed/rss';
    var MAX_ITEMS    = 8;
    var MAX_DESC_LEN = 160;

    var container = document.getElementById('rss-feed-container');
    if (!container) { return; }

    // Fetch the raw RSS XML via a CORS-friendly proxy so GitHub Pages can
    // render a live list of stories without requiring an API key.
    var PROXY_URL = 'https://api.allorigins.win/raw?url=' + encodeURIComponent(FEED_URL);

    function stripHtml(html) {
        try {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body ? (doc.body.textContent || '') : '';
        } catch (e) {
            return '';
        }
    }

    function formatDate(dateStr) {
        var d = new Date(dateStr);
        if (isNaN(d.getTime())) { return ''; }
        return d.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
    }

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

            container.innerHTML = '';
            container.appendChild(list);

            var cite = document.createElement('p');
            cite.className = 'rss-citation';
            cite.innerHTML = 'Source: <a href="' + FEED_URL + '" target="_blank" rel="noopener noreferrer">' + FEED_URL + '</a>';
            container.appendChild(cite);
        })
        .catch(function () {
            showError(container);
        });

    function showError(el) {
        el.innerHTML = '';
        var p = document.createElement('p');
        p.className = 'rss-error';
        p.textContent = 'Unable to load WIRED RSS feed right now. ';
        var a = document.createElement('a');
        a.href = FEED_URL;
        a.target = '_blank';
        a.rel = 'noopener noreferrer';
        a.textContent = 'Open the RSS feed';
        p.appendChild(a);
        p.appendChild(document.createTextNode('.'));
        el.appendChild(p);
    }
}());
