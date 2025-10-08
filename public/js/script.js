window.addEventListener("load", function () {
    document.getElementById("loading").style.display = "none";
});

// Toggle class active untuk hamburger menu
const navbarNav = document.querySelector(".navbar-nav");
// ketika hamburger menu di klik
document.querySelector("#hamburger-menu").onclick = () => {
    navbarNav.classList.toggle("active");
};

// Toggle class active untuk search form
const searchForm = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");

document.querySelector("#search-button").onclick = (e) => {
    searchForm.classList.toggle("active");
    searchBox.focus();
    e.preventDefault();
};

// Show All Menu Button
document.addEventListener("DOMContentLoaded", function () {
    const showAllBtn = document.getElementById("show-all-btn");
    const remainingMenus = document.getElementById("remaining-menus");

    if (showAllBtn) {
        showAllBtn.addEventListener("click", function () {
            // Periksa apakah menu tersembunyi sedang ditampilkan
            const isHidden =
                remainingMenus.style.display === "none" ||
                remainingMenus.style.display === "";

            if (isHidden) {
                // Tampilkan menu yang tersembunyi
                remainingMenus.style.display = "flex";
                // Ubah teks tombol
                showAllBtn.textContent = "Sembunyikan Menu";
            } else {
                // Sembunyikan menu
                remainingMenus.style.display = "none";
                // Ubah teks tombol kembali
                showAllBtn.textContent = "Lihat Semua Menu";
            }
        });
    }
});

// Klik di luar elemen
const hm = document.querySelector("#hamburger-menu");
const sb = document.querySelector("#search-button");

document.addEventListener("click", function (e) {
    if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove("active");
    }

    if (!sb.contains(e.target) && !searchForm.contains(e.target)) {
        searchForm.classList.remove("active");
    }
});

// Modal Box
const itemDetailModal = document.querySelector("#item-detail-modal");
const itemDetailButtons = document.querySelectorAll(".item-detail-button");

itemDetailButtons.forEach((btn) => {
    btn.onclick = (e) => {
        itemDetailModal.style.display = "flex";
        e.preventDefault();
    };
});

// klik tombol close modal
document.querySelector(".modal .close-icon").onclick = (e) => {
    itemDetailModal.style.display = "none";
    e.preventDefault();
};

// klik di luar modal
window.onclick = (e) => {
    if (e.target === itemDetailModal) {
        itemDetailModal.style.display = "none";
    }
};

document.body.style.overflow = "hidden"; // saat modal/cart buka
document.body.style.overflow = ""; // saat ditutup
// Menambahkan event listener untuk mengembalikan scroll saat modal ditutup
