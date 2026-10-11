/* PetZenAI — shared tool-page features: result actions, next steps, progress bar, recently viewed, back-to-top */
(function () {
  'use strict';

  var hero = document.querySelector('.pz-tool-hero[data-pz-slug]');
  var store = {
    get: function (k) { try { return JSON.parse(localStorage.getItem(k) || 'null'); } catch (e) { return null; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  function el(tag, cls, html) { var n = document.createElement(tag); if (cls) n.className = cls; if (html != null) n.innerHTML = html; return n; }
  function esc(s) { return String(s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }

  /* ---- Toast ---- */
  var toastTimer;
  function toast(msg) {
    var t = document.getElementById('pz-toast');
    if (!t) { t = el('div', 'pz-toast'); t.id = 'pz-toast'; t.setAttribute('role', 'status'); document.body.appendChild(t); }
    t.textContent = msg; t.classList.add('show');
    clearTimeout(toastTimer); toastTimer = setTimeout(function () { t.classList.remove('show'); }, 2200);
  }

  /* ---- Back to top (all pages) ---- */
  var top = el('button', 'pz-top-btn', '↑'); top.type = 'button'; top.setAttribute('aria-label', 'Back to top');
  top.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
  document.body.appendChild(top);

  /* ---- Reading progress (tool pages) ---- */
  var bar;
  if (hero) { bar = el('div', 'pz-progress'); bar.setAttribute('aria-hidden', 'true'); document.body.appendChild(bar); }

  var ticking = false;
  function onScroll() {
    if (ticking) return; ticking = true;
    requestAnimationFrame(function () {
      var h = document.documentElement, max = h.scrollHeight - h.clientHeight;
      if (bar) bar.style.transform = 'scaleX(' + (max > 0 ? Math.min(1, window.scrollY / max) : 0) + ')';
      top.classList.toggle('show', window.scrollY > 700);
      ticking = false;
    });
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  if (!hero) return;

  /* ---- Recently viewed ---- */
  var slug = hero.getAttribute('data-pz-slug');
  var h1 = document.querySelector('h1');
  var KEY = 'pz_recent_tools';
  var list = store.get(KEY) || [];
  var cur = { slug: slug, title: h1 ? h1.textContent.replace(/\s+/g, ' ').trim() : slug, icon: hero.getAttribute('data-pz-icon') || '🐾', url: location.pathname };
  var others = list.filter(function (x) { return x && x.slug !== slug; });
  store.set(KEY, [cur].concat(others).slice(0, 8));
  var recentBox = document.getElementById('pz-recent'), recentList = document.getElementById('pz-recent-list');
  if (recentBox && recentList && others.length) {
    recentList.innerHTML = others.slice(0, 4).map(function (x) {
      return '<a href="' + esc(x.url) + '" class="pz-sidebar-tool"><span class="pz-sidebar-tool-icon">' + esc(x.icon) + '</span><span class="pz-sidebar-tool-title">' + esc(x.title) + '</span><span class="pz-sidebar-tool-arrow">→</span></a>';
    }).join('');
    recentBox.hidden = false;
  }

  /* ---- Result actions + next steps ---- */
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  var next = [];
  try { next = JSON.parse(hero.getAttribute('data-pz-next') || '[]'); } catch (e) {}

  function summaryText() {
    var clone = result.cloneNode(true);
    var extra = clone.querySelector('.pz-result-extras'); if (extra) extra.remove();
    clone.querySelectorAll('button, a.pz-int-btn, script, style').forEach(function (n) { n.remove(); });
    var txt = clone.innerText.replace(/\n{3,}/g, '\n\n').trim();
    return (cur.title + '\n\n' + txt + '\n\n' + location.origin + location.pathname);
  }
  function copyText(txt) {
    if (navigator.clipboard && window.isSecureContext) return navigator.clipboard.writeText(txt);
    return new Promise(function (resolve, reject) {
      var ta = el('textarea'); ta.value = txt; ta.style.cssText = 'position:fixed;opacity:0'; document.body.appendChild(ta); ta.select();
      try { document.execCommand('copy') ? resolve() : reject(); } catch (e) { reject(e); } ta.remove();
    });
  }

  function inject() {
    if (result.querySelector('.pz-result-extras')) return;
    if (!result.querySelector('.pz-result-success, .pz-result-warning, .pz-result-hero')) return; // still "analyzing"
    var box = el('div', 'pz-result-extras');
    var actions = el('div', 'pz-result-actions');
    var copy = el('button', 'pz-act-btn', '📋 Copy result'); copy.type = 'button';
    copy.addEventListener('click', function () { copyText(summaryText()).then(function () { toast('Result copied to clipboard'); }, function () { toast('Copy failed — select the text manually'); }); });
    actions.appendChild(copy);
    var share = el('button', 'pz-act-btn', '🔗 Share'); share.type = 'button';
    share.addEventListener('click', function () {
      var data = { title: cur.title, text: 'My result: ' + cur.title, url: location.origin + location.pathname };
      if (navigator.share) { navigator.share(data).catch(function () {}); }
      else { copyText(data.url).then(function () { toast('Link copied — share it anywhere'); }, function () {}); }
    });
    actions.appendChild(share);
    box.appendChild(actions);
    if (next.length) {
      var ns = el('div', 'pz-next-steps');
      ns.appendChild(el('h4', null, '👉 What to check next'));
      var grid = el('div', 'pz-next-grid');
      next.forEach(function (n) {
        grid.appendChild(el('a', 'pz-next-card', '<span aria-hidden="true">' + esc(n.icon) + '</span><strong>' + esc(n.title) + '</strong><em>→</em>')).setAttribute('href', n.url);
      });
      ns.appendChild(grid); box.appendChild(ns);
    }
    // Inside the result card (white background) so text stays readable on every template.
    (result.querySelector('.pz-result-success, .pz-result-warning') || result).appendChild(box);
  }
  new MutationObserver(function () { inject(); }).observe(result, { childList: true });
})();
