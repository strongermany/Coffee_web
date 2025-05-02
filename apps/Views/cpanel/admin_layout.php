<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Base CSS -->
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        
        .admin-sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .admin-main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .admin-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .admin-menu-item {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .admin-menu-item a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-menu-item:hover {
            background: #34495e;
        }
        
        .admin-menu-item.active {
            background: #3498db;
        }
        
        .admin-profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .admin-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        
        .admin-name {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .admin-role {
            font-size: 0.9em;
            opacity: 0.8;
        }
        
        .admin-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #34495e;
            display: none;
        }
        
        .admin-submenu li a {
            padding: 10px 20px 10px 50px;
            display: block;
        }
        
        .admin-menu-item:hover .admin-submenu {
            display: block;
        }
        
        .dropdown-arrow {
            margin-left: auto;
            transition: transform 0.3s;
        }
        
        .admin-menu-item:hover .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Loading spinner */
        .loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        /* Alert messages */
        .alert-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.active {
                transform: translateX(0);
            }
            
            .admin-main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-profile">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin Avatar" class="admin-avatar">
                <span class="admin-name"><?php echo Session::get('admin_name') ?></span>
                <span class="admin-role">Quản trị viên</span>
            </div>
            
            <nav class="admin-nav">
                <ul class="admin-menu">
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" data-url="<?php echo Base_URL ?>LoginController/Dashboard" class="menu-link">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                            <i class="fas fa-info-circle"></i> Information
                        </a>
                    </li>
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" data-url="<?php echo Base_URL?>SliderController/add" class="menu-link">
                            <i class="fas fa-sliders-h"></i> Slider
                        </a>
                    </li>
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" data-url="<?php echo Base_URL ?>PostController/add_post" class="menu-link">
                            <i class="fas fa-blog"></i> Blogs
                        </a>
                    </li>
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" data-url="<?php echo Base_URL ?>ProductController" class="menu-link">
                            <i class="fas fa-list"></i> Category
                        </a>
                    </li>
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" data-url="<?php echo Base_URL?>ProductController/add_product" class="menu-link">
                            <i class="fas fa-box"></i> Product
                        </a>
                    </li>
                    <li class="admin-menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                            <i class="fas fa-shopping-cart"></i> Orders
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <ul class="admin-submenu">
                            <li>
                                <a href="javascript:void(0)" data-url="<?php echo Base_URL?>OrderController/addOrder" class="menu-link">List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="admin-menu-item">
                        <a href="<?php echo Base_URL?>LoginController/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main-content">
            <!-- Loading spinner -->
            <div class="loading">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Alert message container -->
            <div class="alert-message"></div>

            <!-- Content area -->
            <div id="content-area">
                <!-- Content will be loaded here -->
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Function to show loading spinner
        function showLoading() {
            $('.loading').show();
        }

        // Function to hide loading spinner
        function hideLoading() {
            $('.loading').hide();
        }

        // Function to show alert message
        function showAlert(message, type = 'success') {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('.alert-message').html(alertHtml);
            
            // Auto hide after 3 seconds
            setTimeout(function() {
                $('.alert-message .alert').alert('close');
            }, 3000);
        }

        // Function to extract content from response
        function extractContent(response) {
            // Try to find content within #content-area first
            var contentArea = $(response).find('#content-area');
            if (contentArea.length > 0) {
                return contentArea.html();
            }

            // If no #content-area, look for body content
            var bodyContent = $(response).find('body');
            if (bodyContent.length > 0) {
                // Remove any script tags to prevent re-execution
                bodyContent.find('script').remove();
                return bodyContent.html();
            }

            // If neither found, return the raw response
            return response;
        }

        // Function to load content
        function loadContent(url, pushState = true) {
            if (!url) return;

            showLoading();
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    // Extract and set content
                    var content = extractContent(response);
                    $('#content-area').html(content);
                    
                    // Initialize CKEditor if needed
                    if (typeof ClassicEditor !== 'undefined') {
                        document.querySelectorAll('.ckeditor').forEach(element => {
                            if (!element.classList.contains('ck-editor__editable')) {
                                ClassicEditor.create(element)
                                    .catch(error => {
                                        console.error(error);
                                    });
                            }
                        });
                    }

                    // Update URL and localStorage only if needed
                    if (pushState) {
                        window.history.pushState({url: url}, '', url);
                        localStorage.setItem('currentAdminUrl', url);
                    }

                    // Update active menu state
                    updateActiveMenuItem(url);

                    // Check for success message
                    const urlParams = new URLSearchParams(window.location.search);
                    const msg = urlParams.get('msg');
                    if (msg) {
                        try {
                            const message = decodeURIComponent(msg);
                            showAlert(message);
                            // Remove msg from URL without refreshing
                            window.history.replaceState({url: url}, '', url.split('?')[0]);
                        } catch (e) {
                            console.error('Error parsing message:', e);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading content:', error);
                    showAlert('Error loading content: ' + error, 'danger');
                    // If AJAX fails, reload the page
                    if (xhr.status === 403) {
                        window.location.reload();
                    }
                },
                complete: function() {
                    hideLoading();
                }
            });
        }

        // Update active menu item
        function updateActiveMenuItem(url) {
            $('.admin-menu-item').removeClass('active');
            $('.menu-link').each(function() {
                var menuUrl = $(this).data('url');
                if (menuUrl && url.includes(menuUrl)) {
                    $(this).closest('.admin-menu-item').addClass('active');
                }
            });
        }

        // Handle menu clicks
        $('.menu-link').click(function(e) {
            e.preventDefault();
            var url = $(this).data('url');
            if (url) {
                loadContent(url);
            }
        });

        // Handle browser back/forward buttons
        window.onpopstate = function(event) {
            if (event.state && event.state.url) {
                loadContent(event.state.url, false);
            }
        };

        // Initial load
        var initialUrl = window.location.href;
        if (initialUrl.includes('LoginController/Dashboard')) {
            // If we're on the dashboard, don't load content
            updateActiveMenuItem(initialUrl);
        } else {
            // Check if we're loading directly (e.g., after F5)
            var isDirectLoad = !document.referrer || document.referrer.indexOf(window.location.host) === -1;
            if (isDirectLoad && !initialUrl.includes('LoginController')) {
                // For direct loads (F5), let the page handle it normally
                window.location.reload();
            } else {
                loadContent(initialUrl, false);
            }
        }
    });
    </script>
</body>
</html> 