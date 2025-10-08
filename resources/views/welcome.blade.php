<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Temani Ngemil - Nikmati kopi dan cemilan khas lokal. Menu berkualitas, harga bersahabat!" />
    <meta name="keywords" content="kopi, ngemil, snack, cafe, UMKM, Temani Ngemil" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Temani Ngemil Team" />

    <title>Temani Ngemil</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />

    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="loading-screen" id="loading">
        <div class="spinner"></div>
    </div>

    <div id="overlay" class="overlay"></div>

    <nav class="navbar">
        <a href="#" class="navbar-logo">
            <img src="{{ asset('img/products/logo.png') }}" alt="Logo Temani Ngemil" class="logo-img" />
            <span>Temani</span> Ngemil
        </a>

        <div class="navbar-nav">
            <a href="#home">Dashboard</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#contact">Kontak</a>
        </div>



        <div class="navbar-extra">
            <a href="#" id="shopping-cart-button" class="cart-icon">
                <i data-feather="shopping-cart"></i>
                <span class="cart-badge" id="cart-badge" style="display: none;">0</span>
            </a>
            <a href="#" id="hamburger-menu" aria-label="Menu">
                <i data-feather="menu"></i>
            </a>
        </div>

        <div class="shopping-cart" id="shopping-cart">
            <a href="#" id="close-cart-button" class="close-cart-btn">
                <i data-feather="x"></i>
            </a>
            <div class="cart-header">
                <h3>Keranjang Belanja</h3>
                <button id="clear-cart" class="clear-cart-btn">
                    <i data-feather="trash-2"></i> Kosongkan
                </button>
            </div>
            <div class="cart-items" id="cart-items"></div>
            <div class="cart-footer">
                <div class="cart-total">
                    <strong>Total: <span id="cart-total">IDR 0</span></strong>
                </div>
                <button id="checkout-btn" class="checkout-btn">
                    <i data-feather="credit-card"></i> Reservasi Sekarang
                </button>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="mask-container">
            <main class="content">
                <h1>Selamat Datang di <br><span>Temani Ngemil</span></h1>
                <p class="rasa">
                    Rasa lezat, harga bersahabat. Temani ngemil selalu ada.
                </p>
                <a href="#menu" class="cta">Lihat Menu</a>
            </main>
        </div>
    </section>

    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>
        <div class="row">
            <div class="about-img">
                <img src="{{ asset('img/products/logo.png') }}" alt="Kedai Temani Ngemil" />
            </div>
            <div class="content">
                <h3><span>Temani Ngemil</span>, Teman Santai Terbaikmu</h3>
                <p>
                    <span>Temani Ngemil</span> adalah kedai UMKM yang hadir sejak tahun 2023 untuk menemani setiap momen santai kamu. Kami menyediakan berbagai pilihan makanan dan minuman yang dibuat dengan bahan berkualitas dan cita rasa khas rumahan. Dan tentunya aneka camilan homemade yang lezat, semuanya disajikan dengan penuh kehangatan.
                    Nikmati suasana nyaman dan bersahabat di Temani Ngemil tempat terbaik untuk ngobrol, bekerja, atau sekadar menikmati waktu luang ditemani hidangan favoritmu.
                </p>
            </div>
        </div>
    </section>

    <section id="menu" class="menu">
        <h2><span>Menu</span> Kami</h2>
        <p>Nikmati beragam pilihan lezat dari Temani Ngemil</p>

        <div class="row">
            @forelse($initialMenus as $menu)
            <div class="menu-card" data-id="{{ $menu->id }}">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="menu-card-img" />
                <h3 class="menu-card-title">- {{ $menu->name }} -</h3>
                <p class="menu-card-price">{{ $menu->formatted_price }}</p>
                <div class="menu-actions">
                    <button class="add-to-cart-btn" data-id="{{ $menu->id }}">
                        <i data-feather="shopping-cart"></i> Tambah ke Keranjang
                    </button>
                    <button class="view-detail-btn"
                            data-id="{{ $menu->id }}"
                            data-name="{{ $menu->name }}"
                            data-price="{{ $menu->formatted_price }}"
                            data-desc="{{ $menu->description }}"
                            data-img="{{ asset($menu->image) }}">
                        <i data-feather="eye"></i> Lihat Detail
                    </button>
                </div>
            </div>
            @empty
            <p>Belum ada menu tersedia.</p>
            @endforelse
        </div>

        @if($remainingMenus->count() > 0)
        <div class="row" id="remaining-menus">
            @foreach($remainingMenus as $menu)
            <div class="menu-card" data-id="{{ $menu->id }}">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="menu-card-img" />
                <h3 class="menu-card-title">- {{ $menu->name }} -</h3>
                <p class="menu-card-price">{{ $menu->formatted_price }}</p>
                <div class="menu-actions">
                    <button class="add-to-cart-btn" data-id="{{ $menu->id }}">
                        <i data-feather="shopping-cart"></i> Tambah ke Keranjang
                    </button>
                    <button class="view-detail-btn"
                            data-id="{{ $menu->id }}"
                            data-name="{{ $menu->name }}"
                            data-price="{{ $menu->formatted_price }}"
                            data-desc="{{ $menu->description }}"
                            data-img="{{ asset($menu->image) }}">
                        <i data-feather="eye"></i> Lihat Detail
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <button id="show-all-btn" class="btn btn-primary">Lihat Semua Menu</button>
        </div>
        @endif

      <div class="gofood-order-box">
    <div class="gofood-order-content">
        <img src="{{ asset('img/products/gofood-logo.png') }}" alt="GoFood Logo" class="gofood-order-logo">
        <div class="gofood-order-text">
            <h3>Pesan via GoFood</h3>
            <p>Temani Ngemil kini tersedia di GoFood, Pesan sekarang!</p>
            <a href="https://gofood.co.id/en/yogyakarta/restaurant/temani-ngemil-kweden-rt-04-trirenggo-bantul-d8210542-e606-4ae9-a0b4-5cca62d5e292"
                class="gofood-order-button"
                target="_blank"
                rel="noopener noreferrer">
                Buka di GoFood
            </a>
        </div>
    </div>
</div>
    </section>

    <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>
        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.1930777174624!2d110.36655187498715!3d-7.904838291589139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7b01d365f57a07%3A0xc6c4f9f25a3d7e5d!2sTemani%20Ngemil!5e0!3m2!1sen!2sid!4v1699929944208!5m2!1sen!2sid"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                class="map"
            ></iframe>
            <div class="contact-info">
                <h3>MIE JEBEW NO 1 DI BANTUL!</h3>
                <p><i data-feather="map-pin"></i> Trirenggo, Bantul, Yogyakarta</p>
                <p><i data-feather="phone"></i> 0813-3242-8118</p>
                <p><i data-feather="clock"></i> Buka Setiap Hari 11.30 – 21.00</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/temaningemil/" target="_blank"><i data-feather="instagram"></i></a>
            <a href="https://wa.me/6281332428118" target="_blank"><i data-feather="message-circle"></i></a>
            <a href="https://www.tiktok.com/@elzhaapr" target="_blank"><i data-feather="music"></i></a>
        </div>
        <div class="links">
            <a href="#home">Dashboard</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#contact">Kontak</a>
        </div>
        <div class="credit">
            <p>PROJECT PKWU | © 2025.</p>
        </div>
    </footer>

    <div class="modal" id="productModal">
        <div class="modal-container">
            <a href="#" class="close-icon" id="closeModal"><i data-feather="x"></i></a>
            <div class="modal-content">
                <img id="modalImg" src="" alt="" />
                <div class="product-content">
                    <h3 id="modalTitle"></h3>
                    <p id="modalDesc"></p>
                    <div class="product-stars">
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star"></i>
                    </div>
                    <div class="product-price" id="modalPrice"></div>
                    <div class="quantity-selector">
                        <button type="button" id="decrease-qty">-</button>
                        <input type="number" id="modal-quantity" value="1" min="1">
                        <button type="button" id="increase-qty">+</button>
                    </div>
                    <button id="modal-add-to-cart" class="add-to-cart-modal-btn" data-id="">
                        <i data-feather="shopping-cart"></i>Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="reservationModal">
    <div class="modal-container">
        <a href="#" class="close-icon" id="closeReservationModal">
            <i data-feather="x"></i>
        </a>
        <div class="modal-content">
            <div class="reservation-layout">
                <div class="reservation-form-column">
                    <h4>Form Reservasi</h4>
                    <form id="reservationForm">
                        <div class="form-group">
                            <label for="customer_name">Nama Lengkap</label>
                            <input type="text" id="customer_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Nomor HP</label>
                            <input type="tel" id="customer_phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Alamat</label>
                            <textarea id="customer_address" name="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="people_count">Jumlah Orang</label>
                            <input type="number" id="people_count" name="people_count" min="1" required>
                        </div>
                        <button type="submit" class="submit-reservation-btn">
                            <i data-feather="send"></i> Kirim Reservasi
                        </button>
                    </form>
                </div>

                <div class="reservation-summary-column">
                    <h4 style="text-align: right;">Ringkasan Pesanan</h4>
                    <div id="reservation-items"></div>
                    <div class="reservation-total">
                        <strong>Total: <span id="reservation-total">IDR 0</span></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        const hamburger = document.getElementById("hamburger-menu");
const navMenu = document.querySelector(".navbar .navbar-nav");
const overlay = document.getElementById("overlay");

// buka menu
hamburger.addEventListener("click", (e) => {
  e.preventDefault();
  navMenu.classList.add("active");
  overlay.classList.add("active");
});

// tutup kalau klik overlay
overlay.addEventListener("click", () => {
  navMenu.classList.remove("active");
  overlay.classList.remove("active");
});

// tutup kalau klik salah satu link di dalam menu
document.querySelectorAll(".navbar .navbar-nav a").forEach(link => {
  link.addEventListener("click", () => {
    navMenu.classList.remove("active");
    overlay.classList.remove("active");
  });
});

    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-custom",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            loadCart();

            $('.add-to-cart-btn').on('click', function() {
                const menuId = $(this).data('id');
                addToCart(menuId, 1);
            });

            $('.view-detail-btn').on('click', function() {
                const menuId = $(this).data('id');
                const menuName = $(this).data('name');
                const menuPrice = $(this).data('price');
                const menuDesc = $(this).data('desc');
                const menuImg = $(this).data('img');
                $('#modalTitle').text(menuName);
                $('#modalPrice').text(menuPrice);
                $('#modalDesc').text(menuDesc);
                $('#modalImg').attr('src', menuImg);
                $('#modal-add-to-cart').data('id', menuId);
                $('#modal-quantity').val(1);
                $('#productModal').css('display', 'flex');
                feather.replace();
            });

            $('#increase-qty').on('click', function() {
                const qty = parseInt($('#modal-quantity').val());
                $('#modal-quantity').val(qty + 1);
            });

            $('#decrease-qty').on('click', function() {
                const qty = parseInt($('#modal-quantity').val());
                if (qty > 1) {
                    $('#modal-quantity').val(qty - 1);
                }
            });

            $('#modal-add-to-cart').on('click', function() {
                const menuId = $(this).data('id');
                const quantity = parseInt($('#modal-quantity').val());
                addToCart(menuId, quantity);
                $('#productModal').hide();
            });

            $('#shopping-cart-button').on('click', function(e) {
                e.preventDefault();
                $('#shopping-cart').toggleClass('active');
            });

            $('#clear-cart').on('click', function() {
                if (confirm('Yakin ingin mengosongkan keranjang?')) {
                    clearCart();
                }
            });

            $('#checkout-btn').on('click', function() {
                const totalItems = $('.cart-item').length;
                if (totalItems > 0) {
                    loadReservationModal();
                    $('#reservationModal').css('display', 'flex');
                    feather.replace();
                } else {
                    toastr.error('Keranjang belanja Anda kosong!');
                }
            });

            $('#reservationForm').on('submit', function(e) {
                e.preventDefault();
                submitReservation();
            });

            $('#closeModal, #closeReservationModal').on('click', function(e) {
                e.preventDefault();
                $(this).closest('.modal').hide();
            });

            $('#close-cart-button').on('click', function(e) {
                e.preventDefault();
                $('#shopping-cart').removeClass('active');
            });

            $('.modal').on('click', function(e) {
                if ($(e.target).hasClass('modal')) {
                    $(this).hide();
                }
            });

            $(document).on('change', '.cart-quantity', function() {
                const menuId = $(this).data('id');
                const quantity = parseInt($(this).val());
                updateCartItem(menuId, quantity);
            });

            $(document).on('click', '.remove-cart-item', function() {
                const menuId = $(this).data('id');
                removeFromCart(menuId);
            });

            function addToCart(menuId, quantity = 1) {
                $.post('/cart/add', {
                    menu_id: menuId,
                    quantity: quantity
                })
                .done(function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        updateCartBadge(response.cart_count);
                        loadCartItems(response.cart);
                        updateCartTotal(response.formatted_total);
                    }
                })
                .fail(function() {
                    toastr.error('Gagal menambahkan item ke keranjang');
                });
            }

            function loadCart() {
                $.get('/cart')
                .done(function(response) {
                    updateCartBadge(response.cart_count);
                    loadCartItems(response.cart);
                    updateCartTotal(response.formatted_total);
                });
            }

            function updateCartItem(menuId, quantity) {
                $.ajax({
                    url: '/cart/update',
                    method: 'PUT',
                    data: {
                        menu_id: menuId,
                        quantity: quantity
                    }
                })
                .done(function(response) {
                    if (response.success) {
                        updateCartBadge(response.cart_count);
                        updateCartTotal(response.formatted_total);
                        toastr.success('Keranjang berhasil diupdate');
                    }
                });
            }

            function removeFromCart(menuId) {
                $.ajax({
                    url: '/cart/remove',
                    method: 'DELETE',
                    data: {
                        menu_id: menuId
                    }
                })
                .done(function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        updateCartBadge(response.cart_count);
                        updateCartTotal(response.formatted_total);
                        $(`[data-cart-item="${menuId}"]`).remove();
                        if (response.cart_count === 0) {
                            $('#cart-items').html('<p class="empty-cart">Keranjang kosong</p>');
                        }
                    }
                });
            }

            function clearCart() {
                $.ajax({
                    url: '/cart/clear',
                    method: 'DELETE'
                })
                .done(function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        updateCartBadge(0);
                        updateCartTotal('IDR 0');
                        $('#cart-items').html('<p class="empty-cart">Keranjang kosong</p>');
                    }
                });
            }

            function updateCartBadge(count) {
                const badge = $('#cart-badge');
                if (count > 0) {
                    badge.text(count).show();
                } else {
                    badge.hide();
                }
            }

            function updateCartTotal(total) {
                $('#cart-total, #reservation-total').text(total);
            }

            function loadCartItems(cart) {
                const container = $('#cart-items');
                if (Object.keys(cart).length === 0) {
                    container.html('<p class="empty-cart">Keranjang kosong</p>');
                    return;
                }
                let html = '';
                for (const [id, item] of Object.entries(cart)) {
                    html += `
                        <div class="cart-item" data-cart-item="${id}">
                            <img src="${item.image}" alt="${item.name}" />
                            <div class="item-detail">
                                <h3>${item.name}</h3>
                                <div class="item-price">IDR ${item.price.toLocaleString('id-ID')}</div>
                                <div class="item-controls">
                                    <input type="number" class="cart-quantity" data-id="${id}" value="${item.quantity}" min="1">
                                    <span class="item-subtotal">IDR ${item.subtotal.toLocaleString('id-ID')}</span>
                                </div>
                            </div>
                            <i data-feather="trash-2" class="remove-cart-item" data-id="${id}"></i>
                        </div>
                    `;
                }
                container.html(html);
                feather.replace();
            }

            function loadReservationModal() {
                $.get('/cart')
                .done(function(response) {
                    let html = '';
                    for (const [id, item] of Object.entries(response.cart)) {
                        html += `
                            <div class="reservation-item">
                                <span>${item.name} x ${item.quantity}</span>
                                <span>IDR ${item.subtotal.toLocaleString('id-ID')}</span>
                            </div>
                        `;
                    }
                    $('#reservation-items').html(html);
                    $('#reservation-total').text(response.formatted_total);
                });
            }

            function submitReservation() {
                const formData = {
                    name: $('#customer_name').val(),
                    phone: $('#customer_phone').val(),
                    address: $('#customer_address').val(),
                    people_count: $('#people_count').val()
                };

                $.post('/reservation', formData)
                .done(function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $('#reservationModal').hide();
                        updateCartBadge(0);
                        updateCartTotal('IDR 0');
                        $('#cart-items').html('<p class="empty-cart">Keranjang kosong</p>');
                        window.open(response.whatsapp_link, '_blank');
                    } else {
                        toastr.error(response.message);
                    }
                })
                .fail(function() {
                    toastr.error('Gagal mengirim reservasi');
                });
            }

            const showAllBtn = document.getElementById('show-all-btn');
            const remainingMenus = document.getElementById('remaining-menus');

            if (showAllBtn && remainingMenus) {
                showAllBtn.addEventListener('click', function() {
                    remainingMenus.classList.toggle('show-menus');
                    if (remainingMenus.classList.contains('show-menus')) {
                        showAllBtn.textContent = 'Sembunyikan Menu';
                    } else {
                        showAllBtn.textContent = 'Lihat Semua Menu';
                    }
                });
            }
        });
    </script>
</body>
</html>
