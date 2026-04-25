(function () {
    'use strict';

    var FEED_URL      = 'https://www.wired.com/feed/rss';
    var API_URL       = 'https://api.rss2json.com/v1/api.json?rss_url=' +
                        encodeURIComponent(FEED_URL) + '&count=8';
    var MAX_DESC_LEN  = 160;

    var container = document.getElementById('rss-feed-container');
    if (!container) { return; }

    function stripHtml(html) {
        try {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body ? (doc.body.textContent || '') : '';
        } catch (e) {
            return '';
        }
    }

    fetch(API_URL)
        .then(function (response) {
            if (!response.ok) { throw new Error('Network error'); }
            return response.json();
        })
        .then(function (data) {
            if (data.status !== 'ok' || !data.items || !data.items.length) {
                showError(container);
                return;
            }

            var list = document.createElement('ul');
            list.className = 'rss-list';

            data.items.forEach(function (item) {
                var li = document.createElement('li');
                li.className = 'rss-item';

                var a = document.createElement('a');
                a.className = 'rss-item__title';
                a.href = item.link || '#';
                a.target = '_blank';
                a.rel = 'noopener noreferrer';
                a.textContent = item.title || '(no title)';
                li.appendChild(a);

                if (item.pubDate) {
                    var dateStr = new Date(item.pubDate).toLocaleDateString(
                        undefined,
                        { year: 'numeric', month: 'short', day: 'numeric' }
                    );
                    var span = document.createElement('span');
                    span.className = 'rss-item__date';
                    span.textContent = dateStr;
                    li.appendChild(span);
                }

                var rawDesc = stripHtml(item.description || '').trim();
                if (rawDesc) {
                    var p = document.createElement('p');
                    p.className = 'rss-item__desc';
                    p.textContent = rawDesc.length > MAX_DESC_LEN
                        ? rawDesc.substring(0, MAX_DESC_LEN) + '\u2026'
                        : rawDesc;
                    li.appendChild(p);
                }

                list.appendChild(li);
            });

            container.innerHTML = '';
            container.appendChild(list);
        })
        .catch(function () {
            showError(container);
        });

    function showError(el) {
        el.innerHTML = '';
        var p = document.createElement('p');
        p.className = 'rss-error';
        p.textContent = 'Unable to load feed. ';
        var a = document.createElement('a');
        a.href = 'https://www.wired.com';
        a.target = '_blank';
        a.rel = 'noopener noreferrer';
        a.textContent = 'Visit WIRED';
        p.appendChild(a);
        p.appendChild(document.createTextNode(' directly.'));
        el.appendChild(p);
    }
}());
