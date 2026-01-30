
    const galeriaImagenes = [
        { src: "img/logoa.png", texto: "Logoa" },
        { src: "img/fondo.png", texto: "Fondoa" },
        { src: "img/clipart-people-running-fast-speed-__motion-run.png", texto: "" },
        { src: "img/1.png", texto: "Nike Dri-FIT ADV"},
        { src: "img/2.png", texto: "Adidas Primeblue" },
        { src: "img/3.png", texto: "The North Face Easy Tee" },
        { src: "img/4.png", texto: "Under Armour HeatGear Tank" },
        { src: "img/5.png", texto: "Reebok Workout Ready" },
        { src: "img/6.png", texto: "Puma Studio Luxe" },
        { src: "img/7.png", texto: "Columbia Omni-Heat" },
        { src: "img/8.png", texto: "Patagonia Capilene Midweight" },
        { src: "img/9.png", texto: "Adidas Adizero Prime SP 4" },
        { src: "img/10.png", texto: "Nike Zoom Superfly Elite 2" },
        { src: "img/11.png", texto: "Adidas Adizero Boston 12" },
        { src: "img/12.png", texto: "ASICS Metaspeed Sky+" },
        { src: "img/13.png", texto: "Nike AeroSwift Pro" },
        { src: "img/14.png", texto: "Adidas Adizero Split Short" },
        { src: "img/15.png", texto: "Garmin Forerunner 965" },
        { src: "img/16.png", texto: "Coros Pace 3" },
        { src: "img/17.png", texto: "Puma Steel Track Spikes 6mm" },
        { src: "img/18.png", texto: "Mondo Ceramic Spikes 5mm" },
        { src: "img/19.png", texto: "Nike Therma-FIT Elite" },
        { src: "img/20.png", texto: "Under Armour Rival Fleece" },
        { src: "img/21.png", texto: "Salomon Bonatti Waterproof Jacket" },
        { src: "img/22.png", texto: "Nike Windrunner Shield" },
        { src: "img/23.png", texto: "Oakley Encoder Strike Vented" },
        { src: "img/24.png", texto: "Nike Skylon Ace XV" }, 
        { src: "img/25.png", texto: "Long Tight Pro Endurance" },
        { src: "img/26.png", texto: "Thermal Run Long Elite" },
        { src: "img/27.png", texto: "TECHFIT Compression Training" },
        { src: "img/28.png", texto: "Elite Sprint Mallak" },
        { src: "img/29.png", texto: "New Balance FuelCell Pro Elite" },
        { src: "img/30.png", texto: "HOKA Rocket X2 Evo" },
        { src: "img/31.png", texto: "Nike Zoom Rival S 10" },
        { src: "img/32.png", texto: "Polar Vantage V3" },
        { src: "img/33.png", texto: "Suunto Race Titanium" },
        { src: "img/34.png", texto: "Pyramid Steel Spikes 6mm" }, 
        { src: "img/35.png", texto: "Pyramid Steel Spikes 9mm" },
        { src: "img/36.png", texto: "Nike Pro Thermal Advance" },
        { src: "img/37.png", texto: "Adidas Heat.RDY Runner" },
        { src: "img/38.png", texto: "The North Face Flight Futurelight" },
        { src: "img/39.png", texto: "Haglöfs Txaketa L.I.M Goretex" },
        { src: "img/40.png", texto: "Julbo Aero React" },
        { src: "img/41.png", texto: "Adidas SP0050 Pro Shield" },
        { src: "img/42.png", texto: "Pegasus 40" },
        { src: "img/43.png", texto: "Malla R100" },
    ];
    let indiceActual = 0;

    function mostrarFoto(n) {
        const imgElement = document.getElementById("imagenCarrusel");
        const captionElement = document.getElementById("textoCarrusel");
        const puntosContainer = document.getElementById("puntosContainer");

        if (!imgElement || !puntosContainer) return;

        if (n >= galeriaImagenes.length) {
            indiceActual = 0;
        } else if (n < 0) {
            indiceActual = galeriaImagenes.length - 1;
        } else {
            indiceActual = n;
        }

        imgElement.style.opacity = 0;

        setTimeout(() => {
            imgElement.src = galeriaImagenes[indiceActual].src;
            imgElement.alt = galeriaImagenes[indiceActual].texto;
            captionElement.textContent = galeriaImagenes[indiceActual].texto;

            const puntos = document.getElementsByClassName("punto");
            for (let i = 0; i < puntos.length; i++) {
                puntos[i].classList.remove("activo");
            }
            
            if (puntos[indiceActual]) {
                puntos[indiceActual].classList.add("activo");
            }

            imgElement.style.opacity = 1;
        }, 200);
    }

    window.cambiarFoto = function(n) {
        mostrarFoto(indiceActual + n);
    };

    window.irAFoto = function(n) {
        mostrarFoto(n);
    };

    function iniciarCarrusel() {
        const puntosContainer = document.getElementById("puntosContainer");
        if (!puntosContainer) return;

        puntosContainer.innerHTML = "";
        galeriaImagenes.forEach((imagen, index) => {
            const punto = document.createElement("span");
            punto.classList.add("punto");
            punto.onclick = () => irAFoto(index);
            puntosContainer.appendChild(punto);
        });

        mostrarFoto(indiceActual);
    }

    document.addEventListener("DOMContentLoaded", iniciarCarrusel);