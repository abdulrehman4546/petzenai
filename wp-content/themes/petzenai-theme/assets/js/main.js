/* PetZenAI — Main JS v2 */
(function () {
  'use strict';

  /* ---- Preloader ---- */
  window.addEventListener('load', function () {
    var pre = document.getElementById('preloader');
    if (pre) setTimeout(function () { pre.classList.add('hide'); }, 500);
  });

  /* ---- Navbar scroll ---- */
  var navbar = document.getElementById('navbar');
  if (navbar) {
    var lastScroll = 0;
    window.addEventListener('scroll', function () {
      var scroll = window.scrollY;
      navbar.classList.toggle('scrolled', scroll > 60);
      // hide on scroll down, show on scroll up
      if (scroll > 200) {
        navbar.style.transform = scroll > lastScroll ? 'translateY(-100%)' : 'translateY(0)';
      } else {
        navbar.style.transform = 'translateY(0)';
      }
      lastScroll = scroll;
    }, { passive: true });
  }

  /* ---- Mobile nav toggle ---- */
  var toggle = document.getElementById('navToggle');
  var menu   = document.getElementById('navMenu');
  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      var open = menu.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open);
      var spans = toggle.querySelectorAll('span');
      if (open) {
        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
        spans[1].style.opacity   = '0';
        spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
        document.body.style.overflow = 'hidden';
      } else {
        spans.forEach(function(s){ s.style.transform = ''; s.style.opacity = ''; });
        document.body.style.overflow = '';
      }
    });
    menu.querySelectorAll('a').forEach(function(a) {
      a.addEventListener('click', function() {
        menu.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.querySelectorAll('span').forEach(function(s){ s.style.transform=''; s.style.opacity=''; });
        document.body.style.overflow = '';
      });
    });
  }

  /* ---- AOS (Animate On Scroll) ---- */
  function initAOS() {
    var els = document.querySelectorAll('[data-aos]');
    if (!els.length || !window.IntersectionObserver) {
      els.forEach(function(el){ el.classList.add('aos-animate'); });
      return;
    }
    var obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var delay = parseInt(el.getAttribute('data-aos-delay') || 0);
          setTimeout(function(){ el.classList.add('aos-animate'); }, delay);
          obs.unobserve(el);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    els.forEach(function(el){ obs.observe(el); });
  }
  initAOS();

  /* ---- Counter animation ---- */
  function animateCounter(el, target, duration) {
    var start = 0;
    var step  = target / (duration / 16);
    var suffix = target >= 1000 ? '+' : '';
    var timer = setInterval(function() {
      start += step;
      if (start >= target) { start = target; clearInterval(timer); }
      el.textContent = Math.floor(start).toLocaleString() + suffix;
    }, 16);
  }
  if (window.IntersectionObserver) {
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length) {
      var cObs = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            animateCounter(entry.target, parseInt(entry.target.getAttribute('data-count')), 2000);
            cObs.unobserve(entry.target);
          }
        });
      }, { threshold: 0.5 });
      counters.forEach(function(c){ cObs.observe(c); });
    }
  }

  /* ---- Paw trail cursor (desktop only) ---- */
  if (window.innerWidth > 1024) {
    var pawContainer = document.createElement('div');
    pawContainer.style.cssText = 'position:fixed;top:0;left:0;pointer-events:none;z-index:9999;';
    document.body.appendChild(pawContainer);
    var lastPaw = 0;
    document.addEventListener('mousemove', function(e) {
      var now = Date.now();
      if (now - lastPaw < 200) return;
      lastPaw = now;
      var paw = document.createElement('span');
      paw.textContent = '🐾';
      paw.style.cssText = 'position:fixed;left:' + (e.clientX-10) + 'px;top:' + (e.clientY-10) + 'px;font-size:16px;pointer-events:none;opacity:0.6;transition:opacity 0.8s,transform 0.8s;';
      pawContainer.appendChild(paw);
      requestAnimationFrame(function() {
        paw.style.opacity = '0';
        paw.style.transform = 'translateY(-20px) rotate(15deg) scale(0.5)';
      });
      setTimeout(function(){ paw.remove(); }, 900);
    });
  }

  /* ---- Smooth anchor scroll ---- */
  document.querySelectorAll('a[href^="#"]').forEach(function(a) {
    a.addEventListener('click', function(e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* ---- Tool page: Add active state to calculate btn ---- */
  document.querySelectorAll('.pz-btn-calculate').forEach(function(btn) {
    btn.addEventListener('click', function() {
      this.textContent = '⏳ Calculating...';
      var self = this;
      setTimeout(function(){ self.textContent = self.getAttribute('data-original') || self.textContent.replace('⏳ Calculating...','Calculate'); }, 800);
    });
  });

})();
