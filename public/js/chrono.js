var t;

var chrono = {

    secondsLeft: 0,
    timer: undefined,

    Start: function(secondsLeft) {
        clearInterval(this.timer);
        //Initialisation du nombre de secondes selon la valeur pass�e en param�tre
        this.secondsLeft = secondsLeft;
        //D�marrage du chrono
        this.timer = setInterval(this.Tick.bind(this), 1000);
    },

    Tick: function() {
        //On actualise la valeur affich�e du nombre de secondes
        this.secondsLeft = this.secondsLeft - 1;
        t.innerHTML = this.secondsLeft;
        //Tps �coul� -> arr�t du timer
        if (this.secondsLeft === 0)
            this.Stop();
    },

    Stop: function() {
        clearInterval(this.timer);
        click = document.getElementById("button");
        click.click();

    }

};

//chargement  de la page
window.onload = function() {
    t = document.getElementById("time");
    chrono.Start(document.getElementById("compteur").value);
    document.getElementById('confirmeur').style.visibility = 'hidden';


};

function reponse(rep) {
    r = rep;
};


function cache() {
    document.getElementById('confirmeur').style.display = 'inline';
};