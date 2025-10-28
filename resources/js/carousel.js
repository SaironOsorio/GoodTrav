class InfiniteCarousel {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;
        
        this.options = {
            duration: 10000, // 10 segundos
            dragSpeed: 0.6,
            ...options
        };
        
        this.isDragging = false;
        this.startX = 0;
        this.startTranslate = 0;
        this.currentTranslate = 0;
        this.animationId = null;
        this.animationStartTime = 0;
        this.totalWidth = 0;
        this.currentPosition = 0;
        
        this.init();
    }
    
    init() {
        this.calculateTotalWidth();
        this.bindEvents();
        this.startAutoAnimation();
    }
    
    calculateTotalWidth() {
        const items = this.container.querySelectorAll('div[class*="flex-shrink-0"]');
        this.totalWidth = items.length * (items[0]?.offsetWidth || 0);
    }
    
    animate() {
        const elapsed = Date.now() - this.animationStartTime;
        const progress = (elapsed % this.options.duration) / this.options.duration;
        this.currentPosition = -progress * (this.totalWidth / 2);
        this.container.style.transform = `translateX(${this.currentPosition}px)`;
        this.animationId = requestAnimationFrame(() => this.animate());
    }
    
    startAutoAnimation() {
        const progress = Math.abs(this.currentPosition) / (this.totalWidth / 2);
        const timeOffset = progress * this.options.duration;
        this.animationStartTime = Date.now() - timeOffset;
        this.animationId = requestAnimationFrame(() => this.animate());
    }
    
    stopAutoAnimation() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
            this.animationId = null;
        }
    }
    
    bindEvents() {
        // Mouse events
        this.container.addEventListener('mousedown', (e) => this.handleStart(e));
        this.container.addEventListener('mouseleave', () => this.handleEnd());
        this.container.addEventListener('mouseup', () => this.handleEnd());
        this.container.addEventListener('mousemove', (e) => this.handleMove(e));
        
        // Touch events
        this.container.addEventListener('touchstart', (e) => this.handleStart(e));
        this.container.addEventListener('touchend', () => this.handleEnd());
        this.container.addEventListener('touchmove', (e) => this.handleMove(e));
    }
    
    handleStart(e) {
        this.isDragging = true;
        this.container.classList.add('dragging');
        
        const clientX = e.type === 'touchstart' ? e.touches[0].pageX : e.pageX;
        this.startX = clientX;
        
        const transform = this.container.style.transform;
        if (transform) {
            const match = transform.match(/translateX\(([^)]+)px\)/);
            this.startTranslate = match ? parseFloat(match[1]) : 0;
        } else {
            this.startTranslate = 0;
        }
        
        this.stopAutoAnimation();
        e.preventDefault();
    }
    
    handleEnd() {
        if (this.isDragging) {
            this.isDragging = false;
            this.container.classList.remove('dragging');
            this.startAutoAnimation();
        }
    }
    
    handleMove(e) {
        if (!this.isDragging) return;
        e.preventDefault();
        
        const clientX = e.type === 'touchmove' ? e.touches[0].pageX : e.pageX;
        const walk = (clientX - this.startX) * this.options.dragSpeed;
        this.currentTranslate = this.startTranslate + walk;
        this.currentPosition = this.currentTranslate;
        this.container.style.transform = `translateX(${this.currentTranslate}px)`;
    }
    
    // Método público para destruir el carousel
    destroy() {
        this.stopAutoAnimation();
        this.container.removeEventListener('mousedown', this.handleStart);
        this.container.removeEventListener('mouseleave', this.handleEnd);
        this.container.removeEventListener('mouseup', this.handleEnd);
        this.container.removeEventListener('mousemove', this.handleMove);
        this.container.removeEventListener('touchstart', this.handleStart);
        this.container.removeEventListener('touchend', this.handleEnd);
        this.container.removeEventListener('touchmove', this.handleMove);
    }
}

// Función helper para inicializar múltiples carousels
function initCarousels() {
    const carousels = document.querySelectorAll('[data-carousel]');
    const instances = [];
    
    carousels.forEach(carousel => {
        const options = {
            duration: parseInt(carousel.dataset.duration) || 10000,
            dragSpeed: parseFloat(carousel.dataset.dragSpeed) || 0.6
        };
        
        const instance = new InfiniteCarousel(carousel.id, options);
        instances.push(instance);
    });
    
    return instances;
}

// Auto-inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', initCarousels);

// Exportar para uso manual si es necesario
export { InfiniteCarousel, initCarousels };
