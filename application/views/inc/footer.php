</div> <!--main wrapper div closed -->
<footer>
<div class="footer-wrapper p-0 m-2 text-center p-3">
  <?php if (is_logged_in()): ?>
    <div class="p-3 text-center bg-light border rounded">
      <?=$_SESSION['name'];?> <a href="user/logout">Log Out</a>
    </div>
  <?php endif; ?>
  <small>&copy;2019 Online Test by Prakash Chandra</small>
</div>
</footer>
</body>
</html>
