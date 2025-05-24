<style>
.slider-card-section {
    background: linear-gradient(to bottom, rgb(29, 17, 10) 100%, #5c270c 0%);
    padding: 40px 0 30px 0;
    width: 100%;
    position: relative;
}
.slider-card-list {
    position: relative;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    min-height: 340px;
    overflow: hidden;
    display: block;
}
.slider-card {
    background: rgba(255,255,255,0.07);
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.12);
    overflow: hidden;
    width: 100%;
    min-width: 220px;
    max-width: 100%;
    text-align: center;
    transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), box-shadow 0.18s, transform 0.18s;
    color: #fff;
    font-family: 'Quicksand', sans-serif;
    opacity: 0;
    pointer-events: none;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}
.slider-card.active {
    opacity: 1;
    pointer-events: auto;
    z-index: 2;
    transform: scale(1);
    position: absolute;
    animation: fadeInSlider 0.7s cubic-bezier(0.4,0,0.2,1);
}
.slider-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 18px 18px 0 0;
    background: #222;
}
.slider-card-title {
    font-family: 'Cinzel', serif;
    font-size: 1.1rem;
    color: #ffe4a1;
    margin: 14px 0 8px 0;
    font-weight: 600;
    letter-spacing: 1px;
}
.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #7a3a1d;
    color: #ffe4a1;
    border: none;
    border-radius: 50%;
    width: 48px;
    height: 48px;
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    transition: background 0.2s, color 0.2s, transform 0.18s;
    outline: none;
}
.slider-arrow:hover {
    background: #ffe4a1;
    color: #7a3a1d;
    transform: translateY(-50%) scale(1.08);
}
.slider-arrow.prev {
    left: 2vw;
}
.slider-arrow.next {
    right: 2vw;
}
@media (max-width: 900px) {
    .slider-card {
        width: 98vw;
        min-width: 0;
    }
    .slider-arrow {
        width: 38px;
        height: 38px;
        font-size: 1.3rem;
    }
}
@media (max-width: 700px) {
    .slider-card img {
        height: 120px;
    }
}
@keyframes fadeInSlider {
    from {
        opacity: 0.2;
        filter: blur(6px);
    }
    to {
        opacity: 1;
        filter: blur(0);
    }
}
</style>

<div class="slider-card-section">
    <button class="slider-arrow prev" aria-label="Trước">&lt;</button>
    <div class="slider-card-list">
        <?php
        $sliders = !empty($data['sliders']) ? $data['sliders'] : [
            ['image' => 'public/images/BANNER1 (3).jpg', 'title' => 'Slider mẫu']
        ];
        $idx = 0;
        foreach ($sliders as $slider):
        ?>
            <div class="slider-card<?php echo $idx === 0 ? ' active' : ''; ?>">
                <img src="<?php echo Base_URL . (strpos($slider['image'], 'public/') === 0 ? '' : 'public/uploads/slider/') . $slider['image']; ?>" alt="">
                <?php if (!empty($slider['title'])): ?>
                    <div class="slider-card-title"><?php echo $slider['title']; ?></div>
                <?php endif; ?>
            </div>
        <?php $idx++; endforeach; ?>
    </div>
    <button class="slider-arrow next" aria-label="Sau">&gt;</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.slider-card');
    const prevBtn = document.querySelector('.slider-arrow.prev');
    const nextBtn = document.querySelector('.slider-arrow.next');
    let current = 0;
    let timer = null;

    function showCard(idx) {
        cards.forEach((card, i) => {
            card.classList.toggle('active', i === idx);
        });
    }

    function nextCard() {
        current = (current + 1) % cards.length;
        showCard(current);
        resetTimer();
    }

    function prevCard() {
        current = (current - 1 + cards.length) % cards.length;
        showCard(current);
        resetTimer();
    }

    function resetTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(nextCard, 5000);
    }

    prevBtn.addEventListener('click', prevCard);
    nextBtn.addEventListener('click', nextCard);

    // Start auto slide
    timer = setInterval(nextCard, 5000);
});
</script>