/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

require('bootstrap');

// start the Stimulus application
import './bootstrap';


let start = document.getElementById('search_car_pickUpLocation').value
let end = document.getElementById('search_car_destination').value
function handler(event) {
    event.response.headers['access-control-allow-origin'] = { value: "*" };
    return event.response;
}


let energy = document.getElementById('energy').innerHTML
let vehicle = 4
if (energy == "Electric") {
    vehicle = 5
}

let carbon = document.getElementById('carbon')

fetch('https://api.monimpacttransport.fr/beta/getEmissionsPerDistance?km=250&transportations=' + vehicle)
    .then(response => response.json())
    .then(connexion => {
        carbon.innerHTML = connexion[0]['emissions']['kgco2e']
    })