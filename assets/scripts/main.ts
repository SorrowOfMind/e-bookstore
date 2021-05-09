document.addEventListener('DOMContentLoaded', function(){
    function main(): void {
        const categories = [...document.querySelectorAll('.categories-list-item')];
        
        for (let category of categories){
            category.addEventListener('mouseover', function(){
                const subcategories = this.querySelectorAll('.subcategories-list');
                this.classList.add('active-category');
                for (let subcategory of subcategories){
                    subcategory.classList.add('active');
                }

            });
            category.addEventListener('mouseleave', function(){
                const subcategories = this.querySelectorAll('.subcategories-list');
                this.classList.remove('active-category');
                for (let subcategory of subcategories){
                    subcategory.classList.remove('active');
                }
            });
        }

        //slider
        const sliderWrapper = document.querySelector('.banner-wrapper');
        const banners = document.querySelectorAll('.banner-swiper');

        const prevBtn = document.getElementById('banner-btn-prev');
        const nextBtn = document.getElementById('banner-btn-next');

        let counter = 1;
        const sizeToSlide = banners[0].clientWidth;
        sliderWrapper.style.transform = `translateX(${-sizeToSlide}px)`;
        //btns
        nextBtn.addEventListener('click', ()=> {
            if (counter >= banners.length - 1) return;
            sliderWrapper.style.transition = 'transform 0.4s ease-in-out';
            counter++;
            sliderWrapper.style.transform = `translateX(${-sizeToSlide * counter}px)`;
        });

        //btns
        prevBtn.addEventListener('click', ()=> {
            if (counter <= 0) return;
            sliderWrapper.style.transition = 'transform 0.4s ease-in-out';
            counter--;
            sliderWrapper.style.transform = `translateX(${-sizeToSlide * counter}px)`;
        });

        sliderWrapper.addEventListener('transitionend', ()=>{
            if (banners[counter].id == 'swiper-last-clone'){
                sliderWrapper.style.transition = 'none';
                counter = banners.length - 2;
                sliderWrapper.style.transform = `translateX(${-sizeToSlide * counter}px)`;
            }
            if (banners[counter].id == 'swiper-first-clone'){
                sliderWrapper.style.transition = 'none';
                counter = banners.length - counter;
                sliderWrapper.style.transform = `translateX(${-sizeToSlide * counter}px)`;
            }
        });

    }
    main();
});