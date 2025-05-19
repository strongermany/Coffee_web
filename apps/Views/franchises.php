<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap');

body {
    font-family: 'Montserrat', sans-serif;
    background: #000;
    color: #fff;
}

.section-title {
    color: #D4AF37;
    font-family: "Playfair Display", serif;
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    position: relative;
    padding-bottom: 20px;
}

.section-title::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #D4AF37, transparent);
}

.section-divider {
    display: none;
}

.banner {
    background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?php echo Base_URL; ?>public/images/franchise-banner.jpg');
    background-size: cover;
    background-position: center;
    height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.banner::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 20% 20%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
        linear-gradient(45deg, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.9) 100%);
    animation: gradientPulse 8s ease-in-out infinite alternate;
}

.banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('<?php echo Base_URL; ?>public/images/background.jpg');
    background-size: 300px;
    opacity: 0.05;
    animation: backgroundMove 30s linear infinite;
    mix-blend-mode: overlay;
}

@keyframes gradientPulse {
    0% {
        opacity: 0.8;
        background-position: 0% 0%;
    }

    50% {
        opacity: 0.9;
        background-position: 100% 100%;
    }

    100% {
        opacity: 0.8;
        background-position: 0% 0%;
    }
}

@keyframes backgroundMove {
    0% {
        background-position: 0 0;
    }

    100% {
        background-position: 300px 300px;
    }
}

/* Thêm hiệu ứng shine tinh tế */
.banner::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg,
            transparent 0%,
            rgba(212, 175, 55, 0.05) 45%,
            rgba(212, 175, 55, 0.1) 50%,
            rgba(212, 175, 55, 0.05) 55%,
            transparent 100%);
    transform: rotate(45deg);
    animation: shine 8s infinite;
}

@keyframes shine {
    0% {
        transform: translateX(-100%) rotate(45deg);
    }

    20%,
    100% {
        transform: translateX(100%) rotate(45deg);
    }
}

.banner-content {
    position: relative;
    z-index: 1;
    animation: fadeInUp 1s ease-out;
    background: rgba(0, 0, 0, 0.4);
    padding: 40px;
    border-radius: 20px;
    backdrop-filter: blur(5px);
}

.banner-content::before {
    content: "";
    position: absolute;
    top: -20px;
    left: -20px;
    right: -20px;
    bottom: -20px;
    background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
        url('<?php echo Base_URL; ?>public/images/background.jpg');
    background-size: cover;
    background-position: center;
    border-radius: 30px;
    z-index: -1;
    filter: blur(10px);
    animation: backgroundPulse 4s ease-in-out infinite alternate;
}

.banner-content::after {
    content: "";
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg,
            rgba(212, 175, 55, 0.2),
            rgba(212, 175, 55, 0.1),
            rgba(212, 175, 55, 0.2));
    border-radius: 30px;
    z-index: -1;
    animation: borderPulse 4s ease-in-out infinite alternate;
}

@keyframes backgroundPulse {
    from {
        opacity: 0.7;
        transform: scale(1);
    }

    to {
        opacity: 0.9;
        transform: scale(1.02);
    }
}

@keyframes borderPulse {
    from {
        opacity: 0.3;
    }

    to {
        opacity: 0.6;
    }
}

.banner h1 {
    font-family: 'Playfair Display', serif;
    font-size: 4rem;
    color: #D4AF37;
    margin-bottom: 20px;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    position: relative;
    display: inline-block;
    padding: 20px 40px;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url('<?php echo Base_URL; ?>public/images/background.jpg');
    background-size: 200px;
    border: 2px solid rgba(212, 175, 55, 0.3);
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
    animation: titleGlow 2s ease-in-out infinite alternate;
}

.banner h1::before {
    content: "";
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #D4AF37, transparent, #D4AF37);
    border-radius: 12px;
    z-index: -1;
    animation: borderGlow 2s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    from {
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.2);
    }

    to {
        box-shadow: 0 0 40px rgba(212, 175, 55, 0.4);
    }
}

@keyframes borderGlow {
    from {
        opacity: 0.5;
    }

    to {
        opacity: 1;
    }
}

.banner p {
    font-size: 1.5rem;
    color: #fff;
    max-width: 800px;
    margin: 0 auto;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.advantages-section {
    padding: 100px 0;
    background: linear-gradient(to bottom, #000, #111);
    position: relative;
}

.advantages-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #D4AF37, transparent);
}

.advantage-card {
    background: rgba(212, 175, 55, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 15px;
    padding: 40px 30px;
    margin-bottom: 30px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.advantage-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(212, 175, 55, 0.1), transparent);
    transform: translateX(-100%);
    transition: 0.6s;
}

.advantage-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    border-color: #D4AF37;
}

.advantage-card:hover::before {
    transform: translateX(100%);
}

.advantage-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #D4AF37, #B8860B);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    transition: all 0.3s ease;
}

.advantage-icon i {
    font-size: 2rem;
    color: #000;
}

.advantage-card:hover .advantage-icon {
    transform: scale(1.1) rotate(5deg);
}

.advantage-card h3 {
    color: #D4AF37;
    font-family: "Playfair Display", serif;
    font-size: 1.8rem;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 15px;
}

.advantage-card h3::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: #D4AF37;
}

.advantage-list {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}

.advantage-list li {
    padding: 10px 0;
    color: #fff;
    position: relative;
    padding-left: 25px;
    font-size: 1.1rem;
    line-height: 1.6;
}

.advantage-list li::before {
    content: "✓";
    color: #D4AF37;
    position: absolute;
    left: 0;
    font-weight: bold;
}

.package-section {
    padding: 100px 0;
    background: linear-gradient(to bottom, #000, #111);
}

.package-card {
    background: rgba(212, 175, 55, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 15px;
    padding: 40px 30px;
    margin-bottom: 30px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.package-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(212, 175, 55, 0.1), transparent);
    transform: translateX(-100%);
    transition: 0.6s;
}

.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    border-color: #D4AF37;
}

.package-card:hover::before {
    transform: translateX(100%);
}

.package-card h3 {
    color: #D4AF37;
    font-family: "Playfair Display", serif;
    font-size: 2rem;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 15px;
}

.package-card h3::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: #D4AF37;
}

.package-price {
    font-size: 1.8rem;
    color: #D4AF37;
    margin-bottom: 30px;
    font-weight: 600;
}

.package-features {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}

.package-features li {
    padding: 12px 0;
    border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    color: #fff;
    position: relative;
    padding-left: 25px;
}

.package-features li::before {
    content: "•";
    color: #D4AF37;
    position: absolute;
    left: 0;
    font-size: 1.2rem;
}

.package-features li:last-child {
    border-bottom: none;
}

.process-section {
    padding: 100px 0;
    background: linear-gradient(to bottom, #111, #000);
    position: relative;
}

.process-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #D4AF37, transparent);
}

.process-step {
    text-align: center;
    padding: 40px 20px;
    position: relative;
}

.process-step::after {
    content: "";
    position: absolute;
    top: 50%;
    right: -50%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #D4AF37, transparent);
    z-index: 1;
}

.process-step:last-child::after {
    display: none;
}

.process-number {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #D4AF37, #B8860B);
    color: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    margin: 0 auto 25px;
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    transition: transform 0.3s ease;
}

.process-step:hover .process-number {
    transform: scale(1.1);
}

.process-step h3 {
    color: #D4AF37;
    font-family: "Playfair Display", serif;
    font-size: 1.8rem;
    margin-bottom: 15px;
}

.testimonial-section {
    padding: 100px 0;
    background: linear-gradient(to bottom, #000, #111);
}

.testimonial-card {
    background: rgba(212, 175, 55, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 15px;
    padding: 40px 30px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
    border-color: #D4AF37;
}

.testimonial-text {
    font-style: italic;
    margin-bottom: 25px;
    color: #fff;
    font-size: 1.1rem;
    line-height: 1.8;
}

.testimonial-author {
    color: #D4AF37;
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.testimonial-location {
    color: #fff;
    opacity: 0.8;
    font-size: 0.9rem;
}

.form-container {
    background: rgba(212, 175, 55, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 15px;
    padding: 50px;
    margin-top: 40px;
    transition: all 0.3s ease;
}

.form-container:hover {
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
    border-color: #D4AF37;
}

.form-control {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(212, 175, 55, 0.3);
    color: #fff;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: rgba(0, 0, 0, 0.4);
    border-color: #D4AF37;
    color: #fff;
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.btn-primary {
    background: linear-gradient(135deg, #D4AF37, #B8860B);
    color: #000;
    border: none;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    padding: 15px 40px;
    font-size: 1.1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #B8860B, #D4AF37);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
}

.btn-primary:active {
    transform: translateY(0);
}

/* Animation cho các phần tử */
.package-card,
.process-step,
.testimonial-card {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s ease-out forwards;
}

.package-card:nth-child(2) {
    animation-delay: 0.2s;
}

.package-card:nth-child(3) {
    animation-delay: 0.4s;
}

.process-step:nth-child(2) {
    animation-delay: 0.2s;
}

.process-step:nth-child(3) {
    animation-delay: 0.4s;
}

.process-step:nth-child(4) {
    animation-delay: 0.6s;
}

.testimonial-card:nth-child(2) {
    animation-delay: 0.2s;
}

.testimonial-card:nth-child(3) {
    animation-delay: 0.4s;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .banner {
        height: 500px;
    }

    .banner::after {
        background-size: 150px;
    }

    .banner::before {
        background-size: 200% 200%;
    }

    .banner h1 {
        font-size: 2.5rem;
        padding: 15px 25px;
    }

    .banner-content {
        padding: 20px;
    }

    .banner-content::before {
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
    }

    .banner p {
        font-size: 1.2rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .package-card,
    .process-step,
    .testimonial-card {
        margin-bottom: 20px;
    }

    .process-step::after {
        display: none;
    }

    .form-container {
        padding: 30px;
    }

    .advantage-card {
        margin-bottom: 20px;
    }

    .advantage-icon {
        width: 60px;
        height: 60px;
    }

    .advantage-icon i {
        font-size: 1.5rem;
    }

    .advantage-card h3 {
        font-size: 1.5rem;
    }

    .advantage-list li {
        font-size: 1rem;
    }
}

.contact-info {
    padding: 20px;
}

.contact-item {
    background: rgba(212, 175, 55, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
    border-color: #D4AF37;
}

.contact-item i {
    font-size: 2.5rem;
    color: #D4AF37;
    margin-bottom: 20px;
}

.contact-item h3 {
    color: #D4AF37;
    font-family: "Playfair Display", serif;
    font-size: 1.5rem;
    margin-bottom: 15px;
}

.contact-item p {
    color: #fff;
    font-size: 1.2rem;
    margin: 0;
}

@media (max-width: 768px) {
    .contact-item {
        margin-bottom: 20px;
    }
}
</style>

<body>
    <div class="banner">
        <div class="banner-content">
            <h1>Nhượng Quyền Hippo Coffee</h1>
            <p>Mang hương vị cà phê đặc trưng đến với mọi người</p>
        </div>
    </div>

    <div class="container">
        <div class="advantages-section">
            <h2 class="section-title">Lợi Thế Mô Hình</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Mô Hình Kinh Doanh</h3>
                        <ul class="advantage-list">
                            <li>Chi phí đầu tư hợp lý</li>
                            <li>Thời gian hoàn vốn nhanh</li>
                            <li>Lợi nhuận ổn định</li>
                            <li>Rủi ro thấp</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <h3>Chất Lượng Sản Phẩm</h3>
                        <ul class="advantage-list">
                            <li>Nguyên liệu cao cấp</li>
                            <li>Quy trình chuẩn hóa</li>
                            <li>Menu đa dạng</li>
                            <li>Hương vị độc đáo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="advantage-card">
                        <div class="advantage-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3>Hỗ Trợ Toàn Diện</h3>
                        <ul class="advantage-list">
                            <li>Đào tạo chuyên sâu</li>
                            <li>Hỗ trợ marketing</li>
                            <li>Quản lý vận hành</li>
                            <li>Phát triển bền vững</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="package-section">
            <h2 class="section-title">Gói Hợp Tác</h2>
            <div class="section-divider"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="package-card">
                        <h3>Gói Thịnh Vượng</h3>
                        <div class="package-price">Từ 175 triệu</div>
                        <ul class="package-features">
                            <li>Phí hợp tác và Quản lý (0 đồng)</li>
                            <li>Hỗ trợ khai trương</li>
                            <li>Nhận diện, bảng hiệu</li>
                            <li>Đồng phục nhân viên</li>
                            <li>Máy pha, máy xay cà phê</li>
                            <li>Nguyên liệu và bao bì</li>
                            <li>Quầy pha chế 3.2m</li>
                            <li>Đào tạo chuyên sâu</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="package-card">
                        <h3>Gói Khởi Nghiệp</h3>
                        <div class="package-price">Từ 125 triệu</div>
                        <ul class="package-features">
                            <li>Phí hợp tác và Quản lý (0 đồng)</li>
                            <li>Hỗ trợ khai trương</li>
                            <li>Nhận diện, bảng hiệu</li>
                            <li>Đồng phục nhân viên</li>
                            <li>Máy pha, máy xay cà phê</li>
                            <li>Nguyên liệu và bao bì</li>
                            <li>Quầy pha chế 2.5m</li>
                            <li>Đào tạo cơ bản</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="package-card">
                        <h3>Gói Kết Nối</h3>
                        <div class="package-price">Từ 95 triệu</div>
                        <ul class="package-features">
                            <li>Phí hợp tác và Quản lý (0 đồng)</li>
                            <li>Hỗ trợ khai trương</li>
                            <li>Nhận diện, bảng hiệu</li>
                            <li>Đồng phục nhân viên</li>
                            <li>Máy pha, máy xay cà phê</li>
                            <li>Nguyên liệu và bao bì</li>
                            <li>Quầy pha chế 2m</li>
                            <li>Đào tạo cơ bản</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="process-section">
            <h2 class="section-title">Quy Trình Hợp Tác</h2>
            <div class="section-divider"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-number">1</div>
                        <h3>Đăng Ký Tư Vấn</h3>
                        <p>Liên hệ và đăng ký nhận tư vấn chi tiết</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-number">2</div>
                        <h3>Khảo Sát</h3>
                        <p>Khảo sát địa điểm và đánh giá tiềm năng</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-number">3</div>
                        <h3>Ký Kết</h3>
                        <p>Ký kết hợp đồng và lên kế hoạch triển khai</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-number">4</div>
                        <h3>Khởi Động</h3>
                        <p>Đào tạo và khai trương cửa hàng</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial-section">
            <h2 class="section-title">Chia Sẻ Từ Đối Tác</h2>
            <div class="section-divider"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Hippo Coffee đã giúp tôi xây dựng một cửa hàng cà phê thành công
                            với mô hình kinh doanh hiệu quả."</p>
                        <div class="testimonial-author">Anh Nguyễn Văn A</div>
                        <div class="testimonial-location">Quận 1, TP.HCM</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Sự hỗ trợ từ Hippo Coffee rất chuyên nghiệp, từ đào tạo đến vận
                            hành đều rất tốt."</p>
                        <div class="testimonial-author">Chị Trần Thị B</div>
                        <div class="testimonial-location">Quận 7, TP.HCM</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Mô hình nhượng quyền của Hippo Coffee rất phù hợp với thị trường và
                            mang lại lợi nhuận tốt."</p>
                        <div class="testimonial-author">Anh Lê Văn C</div>
                        <div class="testimonial-location">Quận 2, TP.HCM</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-container">
            <h2 class="section-title">Liên Hệ Tư Vấn</h2>
            <div class="section-divider"></div>
            <div class="contact-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <h3>Hotline</h3>
                            <p>0909 123 456</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-item">
                            <i class="fab fa-facebook"></i>
                            <h3>Facebook</h3>
                            <p>Hippo Coffee Official</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="contact-item">
                            <i class="fab fa-whatsapp"></i>
                            <h3>Zalo</h3>
                            <p>0909 123 456</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <h3>Email</h3>
                            <p>franchise@hippocoffee.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>