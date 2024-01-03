document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.getElementById('sidebar');
  const mainPage = document.getElementById('mainPage');
  const imgToRotate = document.querySelector('.img-to-rotate');
  const form = document.querySelector('.form-width');
  const toggleButton = document.getElementById('toggleButton');

  toggleButton.addEventListener('click', function () {
    sidebar.classList.toggle('sidebar-shrink');
    mainPage.classList.toggle('main-page-shrink');
    imgToRotate.classList.toggle('rotate-image');
    form.classList.toggle('hide-form');
  });
});
