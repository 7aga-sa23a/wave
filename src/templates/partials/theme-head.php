<script>
(function () {
  try {
    var t = localStorage.getItem('session-theme');
    if (t === 'light') document.documentElement.removeAttribute('data-theme');
    else document.documentElement.setAttribute('data-theme', 'dark');
  } catch (e) {}
})();
</script>
