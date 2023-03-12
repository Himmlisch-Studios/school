const himmlisch = localStorage.getItem('himmlisch');
const now = Date.now();
const modal = document.getElementById('himmlisch');

localStorage.setItem('himmlisch', now + 1000 * 60 * 10);
if (modal && now > (himmlisch ?? 0) && Math.random() > 0.5) {
    modal.showModal();
    modal.querySelector('[data-close]')?.addEventListener('click', () => {
        modal.close();
    });
}

document.querySelectorAll('.carousel').forEach((carousel) => {
    carousel.style.opacity = "0";
    setTimeout(() => {
        const images = carousel.querySelectorAll('.carousel__container img');
        images.forEach((img) => {
            img.style.width = `${carousel.clientWidth}px`;
        });

        carousel.scrollTo(0, 0);

        setInterval(() => {
            if (carousel.scrollLeft < carousel.clientWidth * (images.length - 1)) {
                carousel.scrollTo({
                    left: carousel.scrollLeft + carousel.clientWidth,
                    behavior: "smooth"
                });
            } else {
                carousel.scrollTo({
                    left: 0,
                    behavior: "smooth"
                });
            }
        }, 3500);
        carousel.style.opacity = "1";
    }, 500);
});