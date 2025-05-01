// public/template/js/admin.js
function enableSidebarHoverSubmenu() {
  const menuItems = document.querySelectorAll('.admin-menu-item');
  // Xóa event cũ để tránh lặp event khi resize
  menuItems.forEach(item => {
    item.onmouseenter = null;
    item.onmouseleave = null;
  });
  menuItems.forEach(item => {
    item.onmouseenter = function () {
      menuItems.forEach(i => i.classList.remove('show-submenu'));
      this.classList.add('show-submenu');
    };
    item.onmouseleave = function () {
      this.classList.remove('show-submenu');
    };
  });
}
window.addEventListener('DOMContentLoaded', enableSidebarHoverSubmenu);
window.addEventListener('resize', enableSidebarHoverSubmenu);