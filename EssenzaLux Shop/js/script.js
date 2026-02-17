document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.header');
    const hero = document.querySelector('.hero');
    const navbar = document.querySelector('.header .flex .navbar');
    const profile = document.querySelector('.header .flex .profile');
  
    // Mobile menu toggles
    document.querySelector('#menu-btn')?.addEventListener('click', () => {
      navbar?.classList.toggle('active');
      profile?.classList.remove('active');
    });
  
    document.querySelector('#user-btn')?.addEventListener('click', () => {
      profile?.classList.toggle('active');
      navbar?.classList.remove('active');
    });
  
    // Loader effect
    function loader() {
      const loaderElement = document.querySelector('.loader');
      if (loaderElement) {
        loaderElement.style.display = 'none';
      }
    }
  
    function fadeOut() {
      setTimeout(loader, 1000); 
    }
  
    class TxtType {
      constructor(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
      }
  
      tick() {
        const i = this.loopNum % this.toRotate.length;
        const fullTxt = this.toRotate[i];
        this.txt = this.isDeleting ? fullTxt.substring(0, this.txt.length - 1) : fullTxt.substring(0, this.txt.length + 1);
        this.el.innerHTML = `<span class="wrap">${this.txt}</span>`;
        let delta = 200 - Math.random() * 100;
        if (this.isDeleting) delta /= 2;
        if (!this.isDeleting && this.txt === fullTxt) {
          delta = this.period;
          this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
          this.isDeleting = false;
          this.loopNum++;
          delta = 500;
        }
        setTimeout(() => this.tick(), delta);
      }
    }
  
    window.onload = () => {
      fadeOut();
      const elements = document.getElementsByClassName('typewrite');
      for (let i = 0; i < elements.length; i++) {
        const toRotate = elements[i].getAttribute('data-type');
        const period = elements[i].getAttribute('data-period');
        if (toRotate) {
          new TxtType(elements[i], JSON.parse(toRotate), period);
        }
      }
    };
  }); 





  