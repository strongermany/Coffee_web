<style>
.carousel {
    width: 100%;
    height: 60vh;
    overflow: hidden;
    margin-bottom: 20px;
}

.carousel-inner {
    height: 100%;
}

.carousel-item {
    height: 100%;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    background: #000;
}

.image-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

@media (max-width: 768px) {
    .carousel {
        height: 40vh;
    }
}
</style>

<body>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php if (!empty($data['sliders'])): ?>
                <?php foreach ($data['sliders'] as $key => $slider): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" 
                            data-bs-slide-to="<?php echo $key; ?>" 
                            <?php echo $key == 0 ? 'class="active" aria-current="true"' : ''; ?> 
                            aria-label="Slide <?php echo $key + 1; ?>">
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="carousel-inner">
            <?php if (!empty($data['sliders'])): ?>
                <?php foreach ($data['sliders'] as $key => $slider): ?>
                    <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                        <div class="image-container">
                            <img src="<?php echo Base_URL; ?>public/uploads/slider/<?php echo $slider['image']; ?>" 
                                 alt="<?php echo $slider['title']; ?>">
                            <div class="carousel-caption">
                                <button class="mt-3 p-4 px-5 btn font-weight-bold button-1 animate__animated animate__zoomIn">
                                    Xem thêm
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Default slider if no data -->
                <div class="carousel-item active">
                    <div class="image-container">
                        <img src="<?php echo Base_URL; ?>public/images/BANNER1 (3).jpg" alt="Default Slider">
                        <div class="carousel-caption">
                            <button class="mt-3 p-4 px-5 btn font-weight-bold button-1 animate__animated animate__zoomIn">
                                Xem thêm
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</body>