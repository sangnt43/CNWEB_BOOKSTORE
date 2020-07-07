<aside class="sidebar <?= (isset($_full_menu) && $_full_menu) ? "" : "sidebar--hidden" ?>">
  <div class="scrollbar-inner">
    <div class="user">
      <div class="user__info" data-toggle="dropdown">
        <img class="user__img" src="<?= (isset(currentAdmin()['Avatar']) && file_exists(currentAdmin()['avatar'])) ?
                                      base_url() . currentAdmin()['Avatar'] : base_url() . "images/avatar/noImage.jpg" ?>" alt="">

        <div>
          <div class="user__name">
            <?= isset(currentAdmin()['FullName']) ? currentAdmin()['FullName'] : "" ?>
          </div>
          <div class="user__email">
            <?= isset(currentAdmin()['Email']) ? currentAdmin()['Email'] : "" ?>
          </div>
        </div>
      </div>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= base_url() ?>">Trở về</a>
        <a class="dropdown-item" href="<?= base_url() ?>Admin/Auth/logout">Đăng xuất</a>
      </div>
    </div>
    <ul class="navigation">
      <li class="<?= isCurrentController("Home") ? "navigation__active" : "" ?>">
        <a href="<?= base_url() ?>Admin"><i class="zmdi zmdi-home"></i> Tổng quan</a>
      </li>
      <li class="navigation__sub <?= isCurrentController(["Group", "User"]) ? "navigation__sub--active" : "" ?>">
        <a href="#">
          <i class="zmdi zmdi-accounts-alt zmdi-hc-fw"></i>
          Tài khoản / nhóm
        </a>
        <ul>
          <li class="<?= isCurrentController("User") ? "navigation__active" : "" ?>">
            <a href="<?= base_url() ?>Admin/User/index">
              <i class="zmdi zmdi-account zmdi-hc-fw"></i>
              Quản lý tài khoản
            </a>
          </li>
          <li class="<?= isCurrentController("Group") ? "navigation__active" : "" ?>">
            <a href="<?= base_url() ?>Admin/Group/index">
              <i class="zmdi zmdi-accounts zmdi-hc-fw"></i>
              Quản lý nhóm
            </a>
          </li>
        </ul>
      </li>
      <li class="navigation__sub <?= isCurrentController(["Book", "BookCategory"]) ? "navigation__sub--active" : "" ?>">
        <a href="#">
          <i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i>
          Sản phẩm
        </a>
        <ul>
          <li class="<?= isCurrentController("Book") ? "navigation__active" : "" ?>">
            <a href="<?= base_url() ?>Admin/Book/index">
              <i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i>
              Quản lý sản phẩm
            </a>
          </li>
          <li class="<?= isCurrentController("BookCategory") ? "navigation__active" : "" ?>">
            <a href="<?= base_url() ?>Admin/BookCategory/index">
              <i class="zmdi zmdi-menu zmdi-hc-fw"></i>
              Quản lý loại sản phẩm
            </a>
          </li>
        </ul>
      </li>
      <li class="<?= (isCurrentController("Order")) ? "navigation__active" : "" ?>">
        <a href="<?= base_url() ?>Admin/Order/index"><i class="zmdi zmdi-truck"></i>Đặt hàng</a>
      </li>
      <li class="<?= (isCurrentController("Banner")) ? "navigation__active" : "" ?>">
        <a href="<?= base_url() ?>Admin/Banner/index"><i class="zmdi zmdi-wallpaper"></i>Banner</a>
      </li>
      <li class="<?= (isCurrentController("Information")) ? "navigation__active" : "" ?>">
        <a href="<?= base_url() ?>Admin/Information/index"><i class="zmdi zmdi-info"></i>Thông tin</a>
      </li>
    </ul>
  </div>
</aside>