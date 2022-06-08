// Crea una clase para el elemento 
class PopUpInfo extends HTMLElement {
    constructor() {
      // Se llama primero a super en el constructor
      super();
  
      // Crea un shadow root
      const shadow = this.attachShadow({mode: 'open'});
  
      // Crea spans
      const wrapper = document.createElement('span');
      wrapper.setAttribute('class', 'wrapper');
  
      const icon = document.createElement('span');
      icon.setAttribute('class', 'icon');
      icon.setAttribute('tabindex', 0);
  
      const info = document.createElement('span');
      info.setAttribute('class', 'info');
  
      // Tome el contenido de los atributos y colóquelo dentro del intervalo de información 
      const text = this.getAttribute('data-text');
      info.textContent = text;
  
      // Inserta icon
      let imgUrl;
      if(this.hasAttribute('img')) {
        imgUrl = this.getAttribute('img');
      } else {
        imgUrl = 'img/default.png';
      }
  
      const img = document.createElement('img');
      img.src = imgUrl;
      icon.appendChild(img);
  
      // Crea algo de CSS para aplicarlo al shadow dom
      const style = document.createElement('style');
      console.log(style.isConnected);
  
      style.textContent = `
        .wrapper {
          position: relative;
        }
        .info {
          font-size: 0.8rem;
          width: 200px;
          display: inline-block;
          border: 1px solid black;
          padding: 10px;
          background: grey;
          border-radius: 10px;
          opacity: 0;
          transition: 0.6s all;
          position: absolute;
          bottom: 20px;
          left: 10px;
          z-index: 3;
        }
        img {
          width: 1.2rem;
        }
        .icon:hover + .info, .icon:focus + .info {
          opacity: 1;
        }
      `;
  
      // Adjunte los elementos creados al shadow dom
      shadow.appendChild(style);
      console.log(style.isConnected);
      shadow.appendChild(wrapper);
      wrapper.appendChild(icon);
      wrapper.appendChild(info);
    }
  }
  
  // Se define el nuevo elemento
  customElements.define('popup-info', PopUpInfo);