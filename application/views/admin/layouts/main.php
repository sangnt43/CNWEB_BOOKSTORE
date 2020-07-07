<!DOCTYPE html>
<html>
<?php include("header.php"); ?>

<body>
  <div class="page-loader">
    <div class="page-loader__spinner">
      <svg viewBox="25 25 50 50">
        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
      </svg>
    </div>
  </div>
  <?php include("navbar.php"); ?>
  <?php include("sideBar.php"); ?>
  <section class="content content--full">
    <div id="main-wrapper">
      <?php if (isset($_view_) && $_view_)
        $this->load->view($_view_);
      ?>
    </div>
  </section>
  <?php include("foot.php"); ?>

  <script>
    if (typeof vue_js == 'undefined') vue_js = {
      el: "#embed",
      data: {},
      methods: {}
    }
    vm = new Vue(vue_js), vue_js = undefined;
  </script>
</body>

</html>